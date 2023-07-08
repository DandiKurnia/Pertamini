<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <style>
        /* Styling for the form */
        body {
            font-family: Arial, sans-serif;
            background-color: #4A55A2;
        }
        .login-form {
            max-width: 300px;
            margin: 16px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="login-form">
        <h2>Login Form</h2>
        <form id="loginForm" action="Controller/LoginController.php" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Login">
            </div>
        </form>
        <div id="error-msg" class="error"></div>
    </div>
    <script src="js/script.js"></script>
</body>
</html> 