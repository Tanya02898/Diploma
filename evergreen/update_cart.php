<?php
session_start();
header('Content-Type: application/json');

// Перевірка входу
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Потрібно увійти в систему']);
    exit;
}

$user_id = $_SESSION['user_id'];

// Підключення до бази
$host = 'sql205.infinityfree.com';
$dbname = 'if0_38989420_myshopdb';
$user = 'if0_38989420';
$password = 'qmrOCCljIZW29iw';

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Помилка з\'єднання з базою']);
    exit;
}

// Отримання даних з запиту
$data = json_decode(file_get_contents('php://input'), true);
$product_id = isset($data['productId']) ? (int)$data['productId'] : null;
$new_quantity = isset($data['quantity']) ? (int)$data['quantity'] : null;

if (!$product_id || !$new_quantity || $product_id < 1 || $new_quantity < 1) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Некоректні дані',
        'debug' => $data
    ]);
    exit;
}

// Оновлення кількості
$stmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?");
$stmt->bind_param("iii", $new_quantity, $user_id, $product_id);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'new_quantity' => $new_quantity]);
} else {
    echo json_encode(['success' => false, 'message' => 'Помилка оновлення кількості']);
}

$stmt->close();
$conn->close();
?>
