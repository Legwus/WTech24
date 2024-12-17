
<!DOCTYPE html>
<html lang="en">


<?php
require("start.php");

if (!isset($_SESSION['user'])) {
  header("Location: login.php");
}


if (!isset($_GET["friend"])) {
  header("Location: friends.php");


} else {
  $friend = $_GET["friend"];
}
?>


<head>
  <meta charset="UTF-8" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Chat Page</title>
  <style>
    #chat-container {
      max-height: 500px;
      /* Adjust the height as needed */
    }
  </style>
</head>

<body class="bg-light container-lg d-flex justify-content-center">

  <div class="flex-container w-50 arialfont">
    <div class="center">
      <h2>Chat with <span id="friendName"><?= $_GET["friend"] ?>.</span></h2>
      <br />


      <div class="btn-group" role="group" aria-label="Basic example">


        <a class="btn btn-secondary" button href="friends.php" type="button">
          < Back</a>
            <a class="btn btn-secondary" button
              href="profile.php?user=<?= htmlspecialchars($friend, ENT_QUOTES, 'UTF-8') ?>" type="button">Profile</a>
            <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal1"
              onclick="showModal()">Remove
              Friend</a>
      </div>


      <div class="border pt-2 mt-4 mb-4 bg-white">

        <ul id="chat-container" class="list-group overflow-scroll p-2">

        </ul>

      </div>
      <form id="chatSendForm">

        <div class="input-group">
          <!-- Input Field -->
          <input type="text" class="form-control" id="sendMessage" name="sendMessage" placeholder="Send Message"
            aria-label="New Message">
          <!-- Button with Custom Border -->
          <button class="btn btn-primary rounded-end" type="submit"
            style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
            Send
          </button>
        </div>
        <!-- <button>Send</button> -->
      </form>

      <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Remove
                <?= htmlspecialchars($_GET['friend'], ENT_QUOTES, 'UTF-8') ?> as Friend
              </h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              Do you really want to end your friendship?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <a type="button"
                href="ajax_delete_friend.php?user=<?= htmlspecialchars($_GET['friend'], ENT_QUOTES, 'UTF-8') ?>"
                class="btn btn-danger">Yes, Please!</a>
            </div>
          </div>

        </div>
      </div>
    </div>

  </div>
  <script src="chat.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>

</body>

</html>

