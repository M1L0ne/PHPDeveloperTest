<?php
require "db.php";

if (isset($_POST["token"])){
    $token = $_POST["token"];
    $result = $conn->query("SELECT * FROM users where u_token = '$token'");
    if ($result->num_rows > 0)
    {
        echoJSON(["message" => "Токен верный"]);
    }
}

echoJSON(["message" => "Токен не верный"]);

$conn->close();