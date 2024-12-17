<!DOCTYPE html>
<html lang="en">
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

<head>
    <meta charset="UTF-8">
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet'
        crossorigin='anonymous'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>

<body class="bg-light">
    <div class="container h-100 min-vh-100 d-flex justify-content-center align-items-center">
        <div class="row text-center justify-content-center align-items-center">
            <img class="rounded-circle" style="max-width: 150px" src="./images/chat.png" alt="Login page">


            <div class="row p-5 mt-5 border text-center bg-white">
                <form id="registerForm" action="register.php" method="get"></form>
                <form id="loginForm" action="login2.php" method="post">

                    
                        <h3 class="text-center pb-2">Please sign in</h3>
                   



                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username"
                            required>
                        <label for="username">Username</label>
                    </div>


                    <div class="form-floating mb-3">
                        <input type="password" class="form-control mt-3" id="password" name="password"
                            placeholder="Password" required>
                        <label for="username">Password</label>
                    </div>
<br>
                    <div class="btn-group w-100" role="group">
                        <button class="btn btn-secondary" type="submit" form="registerForm">Register</button>
                        <button class="btn btn-primary" type="submit" form="loginForm">Login</button>
                    </div>


                </form>

            </div>
        </div>


    </div>
    <script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js'
        crossorigin='anonymous'></script>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js'
        crossorigin='anonymous'></script>
</body>

</html>