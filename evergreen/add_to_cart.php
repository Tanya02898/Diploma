<?php
session_start();
header('Content-Type: application/json');


if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Потрібно увійти в систему']);
    exit;
}


$host = 'sql205.infinityfree.com';
$dbname = 'if0_38989420_myshopdb';
$user = 'if0_38989420';
$password = 'qmrOCCljIZW29iw';

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode(['error' => 'Помилка зʼєднання з базою даних']);
    exit;
}


$data = json_decode(file_get_contents('php://input'), true);
$productId = isset($data['product_id']) ? intval($data['product_id']) : 0;

if (!$productId) {
    echo json_encode(['error' => 'Некоректний ID товару']);
    exit;
}

$userId = $_SESSION['user_id'];


$check = $conn->prepare("SELECT id, quantity FROM cart WHERE user_id = ? AND product_id = ?");
$check->bind_param("ii", $userId, $productId);
$check->execute();
$result = $check->get_result();

if ($result->num_rows > 0) {
    
    $row = $result->fetch_assoc();
    $newQty = $row['quantity'] + 1;
    $update = $conn->prepare("UPDATE cart SET quantity = ? WHERE id = ?");
    $update->bind_param("ii", $newQty, $row['id']);
    $update->execute();
} else {
   
    $insert = $conn->prepare("INSERT INTO cart (user_id, product_id) VALUES (?, ?)");
    $insert->bind_param("ii", $userId, $productId);
    $insert->execute();
}

echo json_encode(['success' => true, 'message' => 'Товар додано в кошик']);
?>
