<?php
$bd_servername = "localhost";
$bd_username = "root";
$bd_password = "";
$bd_dbname = "tasksBD";

$conn = mysqli_connect($bd_servername, $bd_username, $bd_password, $bd_dbname);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

function echoJSON ($arr) {
    echo json_encode($arr, JSON_UNESCAPED_UNICODE);
    exit();
}
