<?php
require 'db.php';

$t_id = $_POST['t_id'];

$result = $conn->query("UPDATE tasks SET t_isComplete = 1 where t_id = '$t_id'");

if ($result)
{
    echoJSON(["message"=>"Успех"]);
}
else
{
    echoJSON(["message"=>"Ошибка"]);
}