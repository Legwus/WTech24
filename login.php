<?php
    require("start.php");

    if(isset($_SESSION['user'])) {
        header("Location: friends.html");
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['username'];
        $password = $_POST['password'];
        if($service->login($name, $password)) {
            $_SESSION['user'] = $name;
            header("Location: friends.php");
        } else {
            echo "<script type='text/javascript'>alert('Invalid username or password');</script>";
            header("Location: login.html");
        }
    }
?>