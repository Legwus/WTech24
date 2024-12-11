<?php
require("start.php");

$service = new Utils\BackendService(CHAT_SERVER_URL, CHAT_SERVER_ID);
if (!isset($_SESSION['user'])) {
    header('Location: login.html');
    exit;
}
if (isset($_GET['friend'])) {
    $user = $service->loadUser($_GET['friend']);
} else {
    $user = $service->loadUser($_SESSION['user']);
}

$json = json_encode($user);
//var_dump($user->getCoffeeTea());
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
            <h2 class="align-to-the-left">Profile of <?= $_GET["friend"] ?></h2>
            <div class="megaklasa">

                <p class="align-to-the-left"><a href="chat.php">
                        &lt; Back to Chat </a> <span> | </span> <?php if (isset($_GET['friend'])) { ?><button class="btn-remove red-link" onclick="removeFriend('<?php echo $_GET['friend'] ?>')">Remove Friend</button> <?php } ?></p>
                <div class="horizontal-flex">
                    <img class="profile-image-size item-align-to-the-left" src="./images/profile.png" alt="Login page"><br><br>
                    <div class="infobox align-to-the-left">
                        <p><?php echo $user->getBio(); ?></p>

                        <span class="strongtext"> Coffee or Tea?</span><br>
                        <span class="setting-choice-padding"><?php echo $user->getCoffeeTea() ?></span><br>
                        <span class="strongtext">Name</span><br>
                        <span class="setting-choice-padding"><?php echo $user->getFirstName() . ' ' . $user->getSurName(); ?></span><br>
                        <span class="strongtext"> Versions</span><br>
                        <span><?php foreach ($user->getVersions() as $version) {
                                    echo $version . '<br>';
                                } ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    $token = $_SESSION['chat_token'];
    echo <<<EOL
<script>

function removeFriend(username) {
console.log(username);
                                    let xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 204) {
        console.log("Removed...");
        setTimeout(() => {
            window.location = "friends.php";
        }, 1000);
    }
};

xmlhttp.open("DELETE", "https://online-lectures-cs.thi.de/chat/132d33f2-44cf-45e1-9e85-e9da1b64102b/friend/" + username, true);
        xmlhttp.setRequestHeader("Content-type", "application/json");
        xmlhttp.setRequestHeader("Authorization", "Bearer {$token}");
xmlhttp.send();
                            }

</script> 
EOL;
    ?>

</body>

</html>