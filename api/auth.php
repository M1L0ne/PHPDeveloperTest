<?php
require "db.php";

$enteredUsername = $_POST['username'];
$enteredPassword = $_POST['password'];

$result = $conn->query("SELECT u_password FROM users where u_login = '$enteredUsername'");
if ($result->num_rows>0) {
    $row = $result->fetch_row();
    if ($row) {
        if (password_verify($enteredPassword, $row[0])) {
            $token = bin2hex(random_bytes(32));
            $conn->query("UPDATE users SET u_token='$token' WHERE u_login='$enteredUsername'");

            setcookie("token", $token, time() + 3600, "/");

            echoJSON(['message' => 'Успешный вход', 'token' => $token]);

            exit();
        }
        else
            echoJSON(['message'=>'Неверный логин или пароль']);
    }
} else
    echoJSON(['message' => 'Неверный логин или пароль']);


$conn->close();
