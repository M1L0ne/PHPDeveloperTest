<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Форма авторизации</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
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

        #reg-button {
            background-color: #3498db;
        }

        #reg-button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

<form action="../api/auth.php">
    <label for="username">Логин:</label>
    <input type="text" id="username" name="username" required>

    <label for="password">Пароль:</label>
    <input type="password" id="password" name="password" required>

    <button type="button" id="reg-button">Регистрация</button>
</form>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script>
    $('#reg-button').click(function ()
    {
        registration();
    });


    function registration()
    {

        username = $('input[name="username"]').val();
        password = $('input[name="password"]').val();

        $.ajax({
            url: "../api/reg.php",
            method: "POST",
            data: {
                username:username, password:password
            },
            success: response => {
                response = JSON.parse(response);
                if (response["message"] === "Успешная регистрация")
                    location.href = "../auth";
            }
        })
    }

</script>
</body>
</html>