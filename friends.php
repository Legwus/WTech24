<?php
require("start.php");
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Friends Page</title>
</head>

<body>
    <div class="flex-container arialfont">
        <div class="center">
            <h2 class="align-to-the-left">Friends</h2>
            <div class="megaklasa">
                <p class="align-to-the-left"><a class="megaklasa" href="logout.php">
                        &lt; Logout </a><span> | </span> <a class="megaklasa" href="settings.php">Settings</a></p>
                <hr class="dotted-border">
                <ul class="friendlist" id="friendList">
                    <?php include "ajax_load_friends.php"; ?>
                </ul>
                <hr class="dotted-border">
                <h2 class="align-to-the-left"> New Requests </h2>
                <?php include "ajax_load_friends_requests.php"; ?>
                <ol id="friendRequestList">
                </ol>
                <hr class="dotted-border">
                <?php include "ajax_list_no_friends.php"; ?>
            </div>
        </div>
    </div>
</body>


</html>