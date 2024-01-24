<?php
require "db.php";

$t_id = $_GET['t_id'];

$result = $conn->query("SELECT * from tasks where t_id = '$t_id'");

if($result->num_rows>0){
    $row = $result->fetch_assoc();
    echoJSON(["t_name" => $row["t_name"], "t_desc" => $row["t_desc"], "t_date" => $row["t_date"]]);
} else {
    echoJSON(["message" => "Нет такой задачи"]);
}

$conn->close();