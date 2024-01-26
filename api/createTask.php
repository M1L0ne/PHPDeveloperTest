<?php
require "db.php";

$t_name = $_POST['t_name'];
$t_desc = $_POST['t_desc'];
$t_date = $_POST['t_date'];
$t_id = $_POST['t_id'];
$token = $_POST['token'];
$result = $conn->query("SELECT u_id from users where u_token = '$token'");
if ($result)
{
    $row = $result->fetch_row();
    if($row)
        $u_id = $row[0];

    if ($t_id == 0) {
        $result = $conn->query("INSERT INTO tasks (t_id, t_name, t_desc, t_date, t_isComplete, u_id) VALUES (t_id, '$t_name', '$t_desc', '$t_date', 0, '$u_id')");
    }
        else
        $result = $conn->query("UPDATE tasks SET t_id = '$t_id', t_name = '$t_name', t_desc = '$t_desc', t_date = '$t_date' WHERE t_id = '$t_id'");

    if ($result)
        echoJSON(["message" => "Успешное сохранение задачи"]);
    else
        echoJSON(["message" => "Ошибка добавления задачи"]);
}

$conn->close();