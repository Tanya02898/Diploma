<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$host = 'sql205.infinityfree.com';
$dbname = 'if0_38989420_myshopdb';
$user = 'if0_38989420';
$password = 'qmrOCCljIZW29iw';

// Підключення до бази
$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Помилка з'єднання з базою: " . $conn->connect_error]);
    exit;
}
$conn->set_charset("utf8mb4");

// Отримання GET-параметрів
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$sort = $_GET['sort'] ?? 'default';
$category = $_GET['category'] ?? '';
$filter = $_GET['filter'] ?? 'all';
$sale_filter = $_GET['sale_filter'] ?? '';
$search = $_GET['search'] ?? '';

// Сортування
$order_sql = '';
if ($sort === 'asc') {
    $order_sql = 'ORDER BY price ASC';
} elseif ($sort === 'desc') {
    $order_sql = 'ORDER BY price DESC';
}

// Кількість товарів на сторінці
$items_per_page = ($category === 'Кімнатні') ? 12 : 9;
$offset = ($page - 1) * $items_per_page;

// Побудова WHERE умов
$where_clauses = [];

// Категорії по ID
switch ($category) {
    case 'Кімнатні':
        $where_clauses[] = 'id BETWEEN 1 AND 12';
        break;
    case 'Добрива':
        $where_clauses[] = 'id BETWEEN 13 AND 18';
        break;
    case 'Насіння':
        $where_clauses[] = 'id BETWEEN 19 AND 27';
        break;
    case 'Саженці':
        $where_clauses[] = 'id BETWEEN 28 AND 36';
        break;
    case 'Горщики':
        $where_clauses[] = 'id BETWEEN 37 AND 45';
        break;
}

// Фільтр "Новинки" і "Акції"
if ($filter === 'new') {
    $where_clauses[] = 'is_new = 1';
} elseif ($filter === 'sale') {
    $where_clauses[] = 'sale_percent > 0';
}

// Фільтр по знижці (sale_filter)
if (!empty($sale_filter) && preg_match('/^\d{1,2}-\d{1,2}$/', $sale_filter)) {
    list($min, $max) = explode('-', $sale_filter);
    $min = (int)$min;
    $max = (int)$max;
    $where_clauses[] = "sale_percent BETWEEN $min AND $max";
}

// Пошук по назві
if (!empty($search)) {
    $safeSearch = $conn->real_escape_string($search);
    $where_clauses[] = "LOWER(name) LIKE LOWER('%$safeSearch%')";
}

// Збірка WHERE
$where_sql = '';
if (count($where_clauses) > 0) {
    $where_sql = 'WHERE ' . implode(' AND ', $where_clauses);
}

// Основний запит на товари
$sql = "SELECT id, name, price, old_price, image, is_new, sale_percent 
        FROM products 
        $where_sql 
        $order_sql 
        LIMIT $items_per_page OFFSET $offset";

$result = $conn->query($sql);
if (!$result) {
    http_response_code(500);
    echo json_encode(["error" => "Помилка запиту: " . $conn->error]);
    exit;
}

// Збір товарів
$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

// Підрахунок загальної кількості для пагінації
$sql_count = "SELECT COUNT(*) AS total FROM products $where_sql";
$result_count = $conn->query($sql_count);
$row_count = $result_count->fetch_assoc();
$total_items = $row_count['total'];
$total_pages = ceil($total_items / $items_per_page);

$conn->close();

// Вивід JSON
header('Content-Type: application/json');
echo json_encode([
    'products' => $products,
    'total_pages' => $total_pages
], JSON_UNESCAPED_UNICODE);