<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Користувач не авторизований']);
    exit;
}

$userId = $_SESSION['user_id'];

$data = json_decode(file_get_contents("php://input"), true);
$productId = intval($data['productId'] ?? 0);

if ($productId <= 0) {
    echo json_encode(['success' => false, 'message' => 'Некоректний ID товару']);
    exit;
}

$conn = new mysqli("sql205.infinityfree.com", "if0_38989420", "qmrOCCljIZW29iw", "if0_38989420_myshopdb");
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Помилка підключення до БД: ' . $conn->connect_error]);
    exit;
}

$stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ? AND product_id = ?");
if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Помилка підготовки запиту: ' . $conn->error]);
    exit;
}

$stmt->bind_param("ii", $userId, $productId);

if ($stmt->execute()) {

    if ($stmt->affected_rows > 0) {
        echo json_encode(['success' => true, 'message' => 'Товар видалено']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Товар не знайдений у кошику']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Не вдалося видалити товар: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
exit;
