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
    http_response_code(500);
    echo json_encode(["error" => "Ошибка подключения к базе данных: " . $conn->connect_error]);
    exit;
}

if (isset($_POST['username']) && !isset($_POST['email'])) {
    $login = trim($_POST['username']);

    $stmt = $conn->prepare("SELECT id FROM users WHERE login = ?");
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $result = $stmt->get_result();

    echo ($result->num_rows > 0) ? 'taken' : 'available';
    exit();
}
if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirmpass'])) {
    $login = trim($_POST['username']);
    $gmail = trim($_POST['email']);
    $pass = $_POST['password'];
    $confirmPass = $_POST['confirmpass'];

    if ($pass !== $confirmPass) {
        echo "<script>alert('Паролі не співпадають!'); window.history.back();</script>";
        exit();
    }

    $stmt = $conn->prepare("SELECT id FROM users WHERE login = ?");
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Імʼя користувача вже зайняте'); window.history.back();</script>";
        exit();
    }

    $hashedPass = password_hash($pass, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (login, gmail, pass) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $login, $gmail, $hashedPass);

    if ($stmt->execute()) {
        $_SESSION['user_registered'] = true;

        echo "<script>
                sessionStorage.setItem('user_registered', 'true');
                window.location.href = 'https://evergreen.infinityfreeapp.com/index.html';
              </script>";
    } else {
        echo "<script>alert('Помилка при реєстрації'); window.history.back();</script>";
    }
}

$conn->close();
