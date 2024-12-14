<?php
require("start.php");

if (!isset($_SESSION)) {
    header('Location: login.html');
    exit;
}

if(isset($_GET) && ($_SERVER['REQUEST_METHOD'] === 'GET')) {
    //var_dump($_GET['user']);
    $user=$service->loadUser($_GET['user']);
    //exit();
    
} 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
</head>

<body>
    <div class="flex-container arialfont profile">
        <div class="center">
            <h2 class="align-to-the-left">Profile of <?= $_GET["user"] ?></h2>
            <div class="megaklasa">

                <p class="align-to-the-left"><a href="chat.php?friend=<?= htmlspecialchars($_GET['user'], ENT_QUOTES, 'UTF-8') ?>">
                        &lt; Back to Chat </a> <span> | </span> <a class="red-link" href="ajax_delete_friend.php?user=<?= htmlspecialchars($_GET['user'], ENT_QUOTES, 'UTF-8') ?>" >Remove Friend</a></p>
                <div class="horizontal-flex">
                    <img class="profile-image-size item-align-to-the-left" src="./images/profile.png" alt="Login page"><br><br>
                    <div class="infobox align-to-the-left">
                        <p><?php echo $user->getBio(); ?></p>

                        <span class="strongtext"> Coffee or Tea?</span><br>
                        <span class="setting-choice-padding"><?php echo $user->getCoffeeTea() ?></span><br>
                        <span class="strongtext">Name</span><br>
                        <span class="setting-choice-padding"><?php echo $user->getFirstName() . ' ' . $user->getSurName(); ?></span><br>
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>