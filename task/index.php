<!DOCTYPE html>
<html lang="en">
<head>
    <title>Задача</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            width: 50%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            display: block;
            margin-top: 10px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
        }

        button:hover {
            background-color: #45a049;
        }

        button.delete-btn {
            display: block;
            margin-top: 10px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            background-color: #e74c3c; /* Красный цвет */
            color: white;
            border: none;
            border-radius: 4px;
        }

        button.delete-btn:hover {
            background-color: #c0392b; /* Темно-красный при наведении */
        }

        button.comp-btn {
            display: block;
            margin-top: 10px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            background-color: #3498db; /* Синий цвет */
            color: white;
            border: none;
            border-radius: 4px;
        }

        button.comp-btn:hover {
            background-color: #2980b9; /* Темно-синий при наведении */
        }
    </style>
</head>
<body>

<h2>Добавление/изменение задачи</h2>

<form id="taskForm">
    <label for="taskName">Название задачи:</label>
    <input type="text" id="taskName" name="taskName" required>

    <label for="taskDescription">Описание задачи:</label>
    <input type="text" id="taskDescription" name="taskDescription" required>

    <label for="taskDate">Дата задачи:</label>
    <input type="date" id="taskDate" name="taskDate" required>

    <button type="button" onclick="submitTask()">Сохранить</button>
    <button type="button" onclick="completeTask()" class="comp-btn">Пометить как выполненое</button>
    <button type="button" onclick="deleteTask()" class="delete-btn">Удалить</button>
</form>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script>
    let t_id = 0;
    const urlParams = new URLSearchParams(location.search);

    if (urlParams.has('t_id')) {
        t_id = urlParams.get('t_id');
        getTaskData();
    }
    else
    {
        $('.comp-btn').hide();
        $('.delete-btn').hide();
    }

    function getTaskData()
    {
        $.ajax({
            url:"../api/getTaskData.php",
            method: "GET",
            data: {
                t_id:t_id
            },
            success: response => {
                console.log(response)
                response = JSON.parse(response)
                document.getElementById('taskName').value = response.t_name;
                document.getElementById('taskDescription').value = response.t_desc;
                document.getElementById('taskDate').value = response.t_date;
            }
        })
    }

    function submitTask()
    {
        t_name = $('input[name="taskName"]').val();
        t_desc = $('input[name="taskDescription"]').val();
        t_date = $('input[name="taskDate"]').val();

        $.ajax({
            url:"../api/createTask.php",
            method: "POST",
            data: {
                t_name: t_name, t_desc: t_desc, t_date: t_date, token:localStorage.getItem("token")
            },
            success: response=>{
                console.log(response);
                response = JSON.parse(response);
                if (response["message"] === "Успех") {
                    alert("Задача успешно добавлена!");
                    location.href = "../main";
                }
                else
                    alert("Ошибка");

            }
        })
    }

    function completeTask()
    {
        $.ajax({
            url: '../api/confirmTask.php',
            method: 'POST',
            data: {
                t_id:t_id
            },
            success: response=>{
                console.log(response);
                response = JSON.parse(response);
                if (response["message"] === "Успех")
                {
                    alert("Задача отмечена как выполненная");
                    location.href = "../main";
                }
                else
                {
                    alert("Ошибка");
                }
            }
        })
    }

    function deleteTask()
    {
        const confirmDelete = confirm("Вы уверены, что хотите удалить задачу?");

        if (confirmDelete) {
            // Если пользователь подтвердил удаление, выполняем удаление
            $.ajax({
                url: '../api/deleteTask.php?t_id='+encodeURIComponent(t_id),
                method: "DELETE",
                success: response=>{
                    console.log(response);
                    response = JSON.parse(response);
                    if (response["message"] === "Успешное удаление")
                    {
                        alert("Задача успешно удалена");
                        location.href = "../main";
                    } else
                        alert("Ошибка");

                }
            })
        } else
            console.log("Отмена удаления");
    }
</script>

</body>
</html>