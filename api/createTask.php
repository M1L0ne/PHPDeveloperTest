<?php
require "db.php";

$t_name = $_POST['t_name'];
$t_desc = $_POST['t_desc'];
$t_date = $_POST['t_date'];
$t_id = $_POST['t_id'];
$token = $_POST['token'];

$request = $conn->query("SELECT u_id from users where u_token = '$token'");
if ($request)
{
    $row = $request->fetch_row();
    if($row)
        $u_id = $row[0];
}

$t_id = 11;
if ($t_id == 0)
    $request = $conn->query("INSERT INTO tasks (t_id, t_name, t_desc, t_date, t_isComplete, u_id) VALUES (t_id, '$t_name', '$t_desc', '$t_date', 0, '$u_id')");

else {
    $request = $conn->query("UPDATE tasks SET t_id = '$t_id', t_name = '$t_name', t_desc = '$t_desc', t_date = '$t_date' WHERE t_id = '$t_id'");
}
if ($request) {
    echoJSON(["message" => "Успех"]);
} else {
    echoJSON(["message" => "Ошибка!"]);
}

$conn->close();