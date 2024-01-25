<?php
require 'db.php';

$t_id = $_GET['t_id'];

if ($t_id == null)
{
    echoJSON(["message"=>"Не указан id для удаления"]);
    exit;
}

$result = $conn->query("DELETE from tasks where t_id = '$t_id'");

if($result === True)
{
    echoJSON(["message"=>"Успешное удаление"]);
}
else
{
    echoJSON(["message"=>"Ошибка " . $t_id]);
}
