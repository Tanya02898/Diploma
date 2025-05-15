<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$host = 'sql205.infinityfree.com';
$dbname = 'if0_38989420_myshopdb';
$user = 'if0_38989420';
$password = 'qmrOCCljIZW29iw';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Ошибка подключения к базе данных: " . $conn->connect_error]);
    exit;
}

$conn->set_charset("utf8mb4");

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$items_per_page = 9;
$offset = ($page - 1) * $items_per_page;

$sql = "SELECT id, name, price, image FROM products LIMIT $items_per_page OFFSET $offset";
$result = $conn->query($sql);

if (!$result) {
    http_response_code(500);
    echo json_encode(["error" => "Ошибка запроса: " . $conn->error]);
    exit;
}

$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

$sql_count = "SELECT COUNT(*) AS total FROM products";
$result_count = $conn->query($sql_count);
$row_count = $result_count->fetch_assoc();
$total_items = $row_count['total'];
$total_pages = ceil($total_items / $items_per_page);

$conn->close();

header('Content-Type: application/json');
echo json_encode([
    'products' => $products,
    'total_pages' => $total_pages
], JSON_UNESCAPED_UNICODE);
?>
