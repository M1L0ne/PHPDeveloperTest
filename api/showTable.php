<?php
require "db.php";

$token = $_POST['token'];

$result = $conn->query("SELECT u_id FROM users where u_token = '$token'");

if ($result)
{
    $row = $result->fetch_row();
    $u_id=$row[0];
}

$result = $conn->query("SELECT * FROM tasks where u_id = '$u_id'");

if ($result->num_rows > 0) {
    $tasks = array();

    while($row = $result->fetch_assoc()) {
        $tasks[] = $row;
    }

    echoJSON($tasks);
} else {
    echoJSON(["message"=>"Нет данных в БД"]);
}

$conn->close();