<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Главная страница</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1, h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        button {
            display: block;
            margin: 20px auto;
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
    </style>
</head>
<body>

<h1>Добро пожаловать на главную страницу!</h1>
<h2>Список задач</h2>

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Задача</th>
        <th>Описание</th>
        <th>Дата добавления</th>
    </tr>
    </thead>
    <tbody id="taskTableBody"></tbody>
</table>

<button type="button" id="task-button">Добавить задачу</button>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script>
    checkToken();
    showTable();

    $('#task-button').click(function ()
    {
        console.log("Переход в createtask");
        location.href = "../createTask";
    });

    function checkToken()
    {
        $.ajax({
            url: "../api/checkToken.php",
            method: "POST",
            data: {
                token:localStorage.getItem("token")
            },
            success: (response) => {
                console.log(response)
                response = JSON.parse(response);
                if (response["message"] != "Токен верный"){
                    console.log("победа :)");
                    location.href = "../auth";
                }
            }
        })
    }

    function showTable()
    {
        let tbody = document.getElementById('taskTableBody');
        let row, idCell, titleCell, descriptionCell, dateCell;

        $.ajax({
            url: "../api/showTable.php",
            method: "GET",
            success: (response) => {
                console.log(response)
                response = JSON.parse(response);
                response.forEach(task => {
                    row = tbody.insertRow();
                    idCell = row.insertCell(0);
                    titleCell = row.insertCell(1);
                    descriptionCell = row.insertCell(2);
                    dateCell = row.insertCell(3);

                    idCell.innerHTML = task.t_id;
                    titleCell.innerHTML = task.t_name;
                    descriptionCell.innerHTML = task.t_desc;
                    dateCell.innerHTML = task.t_date;

                    row.ondblclick = function() {
                        location.href = '../createTask/?t_id=' + encodeURIComponent(task.t_id);
                    }
                });
            }
        })
    }

</script>
</body>
</html>