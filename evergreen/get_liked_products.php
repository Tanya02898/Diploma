<?php
session_start();
header('Content-Type: application/json');

// Проверка авторизации
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Потрібно увійти в систему']);
    exit;
}

$user_id = $_SESSION['user_id'];

// Подключение к базе
$host = 'sql205.infinityfree.com';
$dbname = 'if0_38989420_myshopdb';
$user = 'if0_38989420';
$password = 'qmrOCCljIZW29iw';

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(['error' => 'Помилка з\'єднання з базою']);
    exit;
}

// Получаем ID всех лайкнутых товаров
$stmt = $conn->prepare("SELECT product_id FROM likes WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$product_ids = [];
while ($row = $result->fetch_assoc()) {
    $product_ids[] = $row['product_id'];
}
$stmt->close();

if (empty($product_ids)) {
    echo json_encode([]); // нет лайков
    exit;
}

// Готовим SQL-запрос с IN (...)
$placeholders = implode(',', array_fill(0, count($product_ids), '?'));
$types = str_repeat('i', count($product_ids));

$stmt = $conn->prepare("SELECT id, name, price, old_price, image FROM products WHERE id IN ($placeholders)");
$stmt->bind_param($types, ...$product_ids);
$stmt->execute();
$result = $stmt->get_result();

$liked_products = [];
while ($row = $result->fetch_assoc()) {
    $liked_products[] = $row;
}

echo json_encode($liked_products);

$stmt->close();
$conn->close();
