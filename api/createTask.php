<?php
require "db.php";

$t_name = $_POST['t_name'];
$t_desc = $_POST['t_desc'];
$t_date = $_POST['t_date'];
$t_id = $_POST['t_id'];
$check = 0;
if ($t_id == 0)
    $result = $conn->query("INSERT INTO tasks (t_id, t_name, t_desc, t_date, t_iscomplete) VALUES (t_id, '$t_name', '$t_desc', '$t_date', 0)");
else
    $check = 1;
    $result = $conn->query("UPDATE tasks SET t_id='$t_id', t_name = '$t_name', t_desc = '$t_desc', t_date = '$t_date', t_isComplete = 0 WHERE t_id = '$t_id'");

if ($result === TRUE) {
    echoJSON(["message" => "Успех"]);
} else {
    echoJSON(["message" => "Ошибка!", "Дебаг" => $check]);
}

$conn->close();