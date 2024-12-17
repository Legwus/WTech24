<?php
require("start.php");


if (!isset($_SESSION)) {
    header('Location: login.html');
    exit;
}

if (isset($_GET) && ($_SERVER['REQUEST_METHOD'] === 'GET')) {
    //var_dump($_GET['user']);
    $user = $service->loadUser($_GET['user']);
    //exit();

}
$usern=$_GET['user'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
</head>


<body class="bg-light container-lg d-flex justify-content-center p-5">
    <div class="flex-container arialfont profile">
        <div class="center">
            <h2 class="align-to-the-left">Profile of <span id="usern"> <?= $_GET["user"] ?></span></h2>

            <div class="container-lg">
                <div class="btn-group mb-3 mt-4" role="group" aria-label="Basic example">

                    <a class="btn btn-secondary"
                        href="chat.php?friend=<?= htmlspecialchars($_GET['user'], ENT_QUOTES, 'UTF-8') ?>">
                        &lt; Back to Chat </a>
                    <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal1"
                        onclick="showModal()">Remove
                        Friend</a>

                </div>
                <div class="d-flex align-items-start">
                    <img class="rounded img-fluid w-25 me-2" src="./images/profile.png" alt="Login page"
                        style="object-fit: cover;">
                    <div class="border rounded p-3 w-75 text-wrap">
                        <p class="text-break"><?php echo $user->getBio(); ?></p>

                        <span class="fw-bold"> Coffee or Tea?</span><br>
                        <span class="setting-choice-padding"><?php echo $user->getCoffeeTea() ?></span><br>
                        <span class="fw-bold">Name</span><br>
                        <span
                            class="setting-choice-padding"><?php echo $user->getFirstName() . ' ' . $user->getSurName(); ?></span><br>
                    </div>
                </div>


                <!-- Modal -->
                <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Freund entfernen</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Nein</button>
                                <a type="button" href="ajax_delete_friend.php?user=<?= htmlspecialchars($_GET['user'], ENT_QUOTES, 'UTF-8') ?>" class="btn btn-danger">Ja</a>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
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
    <script src="profile.js"></script>

</body>

</html>