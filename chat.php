<!DOCTYPE html>
<html lang="en">


<?php
require("start.php");

if (!isset($_GET['user'])) {
  header("Location: login.php");
}


if(!isset($_GET["friend"])) {
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
            <a href="friends.html"> &lt; Back </a> <span> | </span>
            <a href="profile.html">Profile </a> <span> | </span>
            <a class="red-link" href="friends.html"> Remove Friend </a>
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
              placeholder="Send Message"
            />
            <button
              class="friend-add-button nicebutton rounded-corners justbluebkgrd"
              id="sendButton"
              type="submit" disabled
              
            >Send</button>
          </form>
        </div>
      </div>
    </div>
    <script src="chat.js"></script>
  </body>
</html>
