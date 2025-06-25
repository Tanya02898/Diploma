<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$host = 'sql205.infinityfree.com';
$dbname = 'if0_38989420_myshopdb';
$user = 'if0_38989420';
$password = 'qmrOCCljIZW29iw';

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Помилка підключення: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");

$first_name = $_POST['first_name'] ?? '';
$last_name = $_POST['last_name'] ?? '';
$phone = $_POST['phone'] ?? '';
$city = $_POST['city'] ?? '';
$delivery = $_POST['delivery'] ?? '';
$branch = $_POST['branch'] ?? '';
$card = $_POST['card'] ?? '';
$exp_date = $_POST['exp_date'] ?? '';
$cvv = $_POST['cvv'] ?? '';
$agree = isset($_POST['agree']) ? 1 : 0;

$product_count = $_POST['product_count'] ?? 0;
$total_price = $_POST['total_price'] ?? 0.00;

$stmt = $conn->prepare("INSERT INTO orders (first_name, last_name, phone, city, delivery, branch, card, exp_date, cvv, agree, product_count, total_price) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssssssii", $first_name, $last_name, $phone, $city, $delivery, $branch, $card, $exp_date, $cvv, $agree, $product_count, $total_price);

if ($stmt->execute()) {
    echo "<script>alert('Замовлення успішно збережено!'); window.location.href = 'index.html';</script>";
} else {
    $error = htmlspecialchars($stmt->error, ENT_QUOTES);
    echo "<script>alert('Помилка при збереженні: $error'); window.history.back();</script>";
}

$stmt->close();
$conn->close();
?>