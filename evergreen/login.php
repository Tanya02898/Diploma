<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

$host = 'sql205.infinityfree.com';
$dbname = 'if0_38989420_myshopdb';
$user = 'if0_38989420';
$password = 'qmrOCCljIZW29iw';

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    echo "db_error";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['username']) && isset($_POST['password'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE login = ?");
    if (!$stmt) {
        echo "db_error";
        exit;
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo "login_not_found";
    } else {
        $user = $result->fetch_assoc();
        $storedHash = $user['pass'];

        if (password_verify($password, $storedHash)) {
            // Успішний вхід — зберігаємо логін та ID
            $_SESSION['user'] = $username;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['logged_in'] = true;

            echo "success";
        } else {
            echo "password_incorrect";
        }
    }

    $stmt->close();
    $conn->close();
}
?>
