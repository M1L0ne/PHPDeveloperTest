<?php
require "db.php";

$result = $conn->query("SELECT * FROM tasks");

if ($result->num_rows > 0) {
    // Создаем массив для хранения строк
    $tasks = array();

    // Преобразуем результаты в ассоциативный массив
    while($row = $result->fetch_assoc()) {
        $tasks[] = $row;
    }

    echo json_encode($tasks, JSON_UNESCAPED_UNICODE);
} else {
    echo "Нет данных в базе данных";
}

$conn->close();