<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Дані для підключення
$host = 'sql205.infinityfree.com';
$dbname = 'if0_38989420_myshopdb';
$user = 'if0_38989420';
$password = 'qmrOCCljIZW29iw';

// Підключення до бази даних
$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Помилка підключення до бази даних: " . $conn->connect_error]);
    exit;
}

$conn->set_charset("utf8mb4");

// Отримуємо ID товару з параметру запиту
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Якщо ID некоректний
if ($id <= 0) {
    http_response_code(400);
    echo json_encode(["error" => "Невірний ID товару"]);
    exit;
}

// Підготовлений запит
$sql = "SELECT id, name, price, description, image, type, diameter, temperature, light, watering, origin, package_type, package_detail FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    http_response_code(500);
    echo json_encode(["error" => "Помилка підготовки запиту: " . $conn->error]);
    exit;
}

$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    http_response_code(404);
    echo json_encode(["error" => "Товар не знайдено"]);
} else {
    $product = $result->fetch_assoc();
    echo json_encode($product, JSON_UNESCAPED_UNICODE);
}

$stmt->close();
$conn->close();
