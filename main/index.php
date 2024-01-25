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
        <th>Статус</th>
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
        location.href = "../task";
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
        let row, idCell, titleCell, descriptionCell, dateCell, statusCell;

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
                    statusCell = row.insertCell(4);

                    idCell.innerHTML = task.t_id;
                    titleCell.innerHTML = task.t_name;
                    descriptionCell.innerHTML = task.t_desc;
                    dateCell.innerHTML = task.t_date;
                    if(task.t_isComplete == 1)
                    {
                        row.style.backgroundColor = '#c0e2c0';
                        statusCell.innerHTML = "Выполнено";
                    }
                    else
                        statusCell.innerHTML = "В процессе";

                    row.ondblclick = function() {
                        location.href = '../task/?t_id=' + encodeURIComponent(task.t_id);
                    }
                });
            }
        })
    }

    //Сортировка
    $(document).ready(function() {
        $('th').click(function() {
            let table = $(this).parents('table').eq(0);
            let rows = table.find('tr:gt(0)').toArray().sort(comparer($(this).index()));
            this.asc = !this.asc;
            if (!this.asc) {
                rows = rows.reverse();
            }
            for (let i = 0; i < rows.length; i++) {
                table.append(rows[i]);
            }
        });

        function comparer(index) {
            return function(a, b) {
                let valA = getCellValue(a, index);
                let valB = getCellValue(b, index);
                return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.toString().localeCompare(valB);
            };
        }

        function getCellValue(row, index) {
            return $(row).children('td').eq(index).text();
        }
    });

</script>
</body>
</html>