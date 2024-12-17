<!DOCTYPE html>
<html lang="en">

    <?php
        require("start.php");

        if(!isset($_SESSION['user'])) {
            header("Location: login.html");
        }

        if (isset($_GET['action']) && isset($_GET['name'])) {
            $action = $_GET['action'];
            $name = $_GET['name'];
        
            if ($action == 'reject') {
                if ($service->friendDismiss($name)) {
                    echo "Friend request rejected successfully";
                } else {
                    echo "Friend request rejection failed";
                }
            } else if ($action == 'accept') {
                if ($service->friendAccept($name)) {
                    echo "Friend request accepted successfully";
                } else {
                    echo "Friend request acception failed";
                }
            } else {
                echo "Something went really wrong in acception the friendrequest";
            }
        }
    ?>

    <head>
        <meta charset="UTF-8">
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet' crossorigin='anonymous'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Friends Page</title>
    </head>

    <body>
        <div class="container h-100 min-vh-100 d-flex justify-content-center align-items-center">
            <div class="row">
                <!-- Header Row -->
                <div class="row">
                    <h2>Friends</h2>
                </div>

                <!-- Buttons Row -->
                <div class="row" style="max-width: 250px">
                    <form id="backToLogout" action="logout.html"></form>
                    <form id="goToProfile" action="settings.php"></form>
                    <div class="btn-group" style="width: 100%" role="group">
                        <button class="btn btn-secondary" type="submit" form="backToLogout">< Logout</button>
                        <button class="btn btn-secondary" type="submit" form="goToProfile">Edit Profile</button>
                    </div>
                </div>

                <!-- Horizontal Rule Row -->
                <div class="row">
                    <hr class="mt-3 mb-3">
                </div>

                <!-- Friend List Row -->
                <div class="row">
                    <ol class="list-group" id="friendList">
                        <!-- Friendlist is being loaded here -->
                    </ol>
                </div>

                <!-- Horizontal Rule Row -->
                <div class="row">
                    <hr class="mt-3 mb-3">
                </div>

                <!-- New Requests Header Row -->
                <div class="row">
                    <h2 class="align-to-the-left">New Requests</h2>
                </div>

                <!-- Friend Request List Row -->
                <div class="row">
                    <ol class="list-group" id="friendRequestList">
                        <!-- Friendrequests are loaded here -->
                    </ol>
                </div>

                <!-- Horizontal Rule Row -->
                <div class="row">
                    <hr class="mt-3 mb-3">
                </div>

                <!-- Add Friend Form Row -->
                <div class="row">
                    <form method="post" action="friends.html">
                        <div class="input-group">
                            <input class="form-control" type="text" id="addFriend" name="addFriend" oninput="listUsers()" onclick="listUsers()" placeholder="Add a new friend to your list!" list="friend-selector">
                            <datalist id="friend-selector">
                                <!-- Possible available friends are being loaded here -->
                            </datalist>
                            <button class="btn btn-primary" type="submit" id="addButton" onclick="addUser(event)" disabled>Add Friends</button>
                        </div>
                    </form>
                </div>
            </div> <!-- End of .row -->
        </div> <!-- End of .container -->

        <!-- Start of modal definition -->
        <div class="modal fade" id="friendrequest-modal" aria-labelledby="model-title" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" id="friend_request_header">
                    </div>
                    <div class="modal-body">
                        <p>Accept request?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="friend_request_reject" data-bs-dismiss="modal">Dismiss</button>
                        <button type="button" class="btn btn-primary" id="friend_request_accept" data-bs-dismiss="modal">Accept</button>
                    </div>
                </div>
            </div>
        </div>


        <script src="friends.js"></script>
        <script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js' crossorigin='anonymous'></script>
        <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js' crossorigin='anonymous'></script>
    </body>

</html>



