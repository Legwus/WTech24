<?php
require("start.php");

if (isset($_SESSION['user'])) {
    header("Location: friends.html");
}

$service = new Utils\BackendService(CHAT_SERVER_URL, CHAT_SERVER_ID);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['username'];
    $password = $_POST['password'];
    if ($service->login($name, $password)) {
        $_SESSION['user'] = $service->loadUser($name);

        header("Location: friends.php");
    } else {
        echo "<script type='text/javascript'>alert('Invalid username or password');</script>";
        header("Location: login.html");
    }
}
