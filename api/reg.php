<?php
require "db.php";

$enteredUsername = $_POST['username'];
$enteredPassword = $_POST['password'];
$token = bin2hex(random_bytes(32));

$result = $conn->query("INSERT INTO users values (u_id, '$enteredUsername', '$enteredPassword', '$token')");
if ($result === True)
    echoJSON(["message" => "Успешная регистрация"]);

$conn->close();