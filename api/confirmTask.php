<?php
require 'db.php';

$t_id = $_POST['t_id'];

$request = $conn->query("UPDATE tasks SET t_isComplete = 1 where t_id = '$t_id'");

if ($request)
{
    echoJSON(["message"=>"Успех"]);
}
else
{
    echoJSON(["message"=>"Ошибка"]);
}