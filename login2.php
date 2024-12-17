<?php
require("start.php");

if (isset($_SESSION['user'])) {

    header("Location: friends.php");
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['username'];
    $password = $_POST['password'];
    if ($service->login($name, $password)) {

        $_SESSION['user'] = $name;
        header("Location: friends.php");
    } else {
        echo "<script type='text/javascript'>alert('Invalid username or password');</script>";
        header("Location: login.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

</head>

<body>
    <div class="flex-container arialfont">
        <div class="center">
            <img class="img-rounded default-image-size" src="./images/chat.png" alt="Login page">
            <h3>Please sign in</h2>
                <fieldset class="dotted-border fieldsetstyling">
                    <legend>Login</legend>
                    <form id="loginForm" action="login.php" method="post">
                        <br><label for="username">Username </label>
                        <input type="text" id="username" name="username" required placeholder="Username"><br><br>

                        <label for="password">Password </label>
                        <input type="password" id="password" name="password" required placeholder="Password"><br><br>
                </fieldset>
                <a class="nicebutton registerButton" href="register.html" type="button">Register </a>
                <input class="nicebutton justbluebkgrd" type="submit" form="loginForm" value="Login">
                </form>
        </div>
    </div>
</body>

</html>

