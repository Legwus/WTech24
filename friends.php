<!DOCTYPE html>
<html lang="en">


<?php
    require("start.php");
    if(!isset($_SESSION['user'])) {
        header("Location: login.html");
    }

    /*if($_GET["action"] === "accept-friend" && isset($_GET["name"])) {
        var_dump("Ja moin");
        $service->friendDismiss($_GET["name"]);
        exit();
    } else if($_GET["action"] === "reject-friend") {
        var_dump("Ja moin");
        $service->friendAccept($_GET["name"]);
        exit();
    }*/

    if(isset($_POST) && ($_SERVER['REQUEST_METHOD'] === 'POST')) {
        
        $service->friendRequest(array("username" => $_POST["addFriend"]));
        //exit();
        
    } 



?>


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
                <p class="align-to-the-left"><a class="megaklasa" href="logout.html">
                        &lt; Logout </a><span> | </span> <a class="megaklasa" href="settings.php">Settings</a></p>
                <hr class="dotted-border">
                <ul class="friendlist" id="friendList">
                    
                </ul>
                <hr class="dotted-border">
                <h2 class="align-to-the-left"> New Requests </h2>
                <ol id="friendRequestList">
                </ol>
                <hr class="dotted-border">
                <form class="align-to-the-left" method="post" action="friends.php">
                    <input class="big-textfield" type="text" id="addFriend" name="addFriend" oninput="listUsers()" onclick="listUsers()" placeholder="Add a Friend to List" list="friend-selector">
                    <datalist id="friend-selector">
                        <option>Tom</option>
                        <option>Jerry</option>
                        <!-- weitere Einträge    onclick="addUser(event)" -->
                        </datalist>
                        
                    <input class="friend-add-button nicebutton rounded-corners justbluebkgrd " disabled type="submit" value="Add" id="addButton">
                </form>
            </div>
        </div>
    </div>
    <script src="friends.js"></script>
</body>

</html>