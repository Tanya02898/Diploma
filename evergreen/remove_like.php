<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo "Користувач не авторизований";
    exit();
}

if (!isset($_POST['product_id'])) {
    http_response_code(400);
    echo "Невірний запит";
    exit();
}

$user_id = $_SESSION['user_id'];
$product_id = intval($_POST['product_id']);


$host = 'sql205.infinityfree.com';
$dbname = 'if0_38989420_myshopdb';
$user = 'if0_38989420';
$password = 'qmrOCCljIZW29iw';

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    http_response_code(500);
    echo "Помилка підключення до бази: " . $conn->connect_error;
    exit();
}

$stmt = $conn->prepare("DELETE FROM likes WHERE user_id = ? AND product_id = ?");
if (!$stmt) {
    http_response_code(500);
    echo "Помилка підготовки запиту: " . $conn->error;
    exit();
}
$stmt->bind_param("ii", $user_id, $product_id);

if ($stmt->execute()) {
    echo "Товар успішно видалено з обраного";
} else {
    http_response_code(500);
    echo "Помилка видалення: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
