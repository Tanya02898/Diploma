<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Потрібно увійти в систему']);
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['product_id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Некоректний запит']);
    exit;
}

$product_id = intval($_POST['product_id']);

$host = 'sql205.infinityfree.com';
$dbname = 'if0_38989420_myshopdb';
$user = 'if0_38989420';
$password = 'qmrOCCljIZW29iw';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(['error' => 'Помилка підключення до БД']);
    exit;
}

$stmt = $conn->prepare("SELECT id FROM likes WHERE user_id = ? AND product_id = ?");
$stmt->bind_param("ii", $user_id, $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Лайк уже есть — можно вернуть успех или сообщение
    echo json_encode(['message' => 'Вже додано до улюблених']);
    $stmt->close();
    $conn->close();
    exit;
}
$stmt->close();

$stmt = $conn->prepare("INSERT INTO likes (user_id, product_id, created_at) VALUES (?, ?, NOW())");
$stmt->bind_param("ii", $user_id, $product_id);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Додано до улюблених']);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Помилка при додаванні лайка']);
}

$stmt->close();
$conn->close();
?>
