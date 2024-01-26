<?php
require 'config.php';

$conn = mysqli_connect($db_connect['db_servername'], $db_connect['db_username'], $db_connect['db_password'], $db_connect['db_dbname']);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

function echoJSON ($arr) {
    echo json_encode($arr, JSON_UNESCAPED_UNICODE);
    exit();
}
