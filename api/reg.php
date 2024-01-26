<?php
require "db.php";

$enteredUsername = $_POST['username'];
$enteredPassword = $_POST['password'];

$hashedPassword = password_hash($enteredPassword, PASSWORD_DEFAULT);
$token = bin2hex(random_bytes(32));

$result = $conn->query("SELECT * from users where u_login = '$enteredUsername'");

if($result->num_rows==0) {
    $result = $conn->query("INSERT INTO users values (u_id, '$enteredUsername', '$hashedPassword', '$token')");
    if ($result)
        echoJSON(["message" => "Успешная регистрация"]);
    else
        echoJSON(["message" => "Ошибка"]);
}
else
{
    echoJSON(["message"=>"Пользователь есть"]);
}
$conn->close();