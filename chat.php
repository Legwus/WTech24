<!DOCTYPE html>
<html lang="en">


<?php
require("start.php");

if (!isset($_SESSION['user'])) {
  header("Location: login.php");
}


if (!isset($_GET["friend"])) {
  header("Location: friends.php");
}




?>

<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="styles.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Chat Page</title>
</head>

<body>

  <div class="flex-container arialfont chat">
    <div class="center">
      <h2 class="align-to-the-left">Chat with <span id="friendName"><?= $_GET["friend"] ?>.</span></h2>
      <div class="megaklasa">
        <p class="align-to-the-left">
          <a href="friends.php"> &lt; Back </a> <span> | </span>
          <a href="profile.php?friend=<?php echo $_GET['friend'] ?>">Profile </a> <span> | </span>
          <button class="btn-remove red-link" onclick="removeFriend('<?php echo $_GET['friend'] ?>')">Remove Friend</button>
        </p>
        <hr class="dotted-border" />
        <ul class="chatbox" id="chat-container">
        </ul>
        <hr class="dotted-border" />
        <form class="item-align-to-the-left" id="chatSendForm">
          <input
            class="big-textfield"
            type="text"
            id="sendMessage"
            name="sendMessage"
            placeholder="Send Message" />
          <button
            class="friend-add-button nicebutton rounded-corners justbluebkgrd"
            id="sendButton"
            type="submit" disabled>Send</button>
        </form>
      </div>
    </div>
  </div>
  <script src="chat.js"></script>
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