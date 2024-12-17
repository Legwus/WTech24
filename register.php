<!DOCTYPE html>
<html lang="en">

<?php
require("start.php");




// Überprüfen, ob das Formular gesendet wurde
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Validierungen
  $errors = [];
  // Daten aus dem POST-Array abrufen
  $username = isset($_POST['username']) ? trim($_POST['username']) : '';
  $password = isset($_POST['password']) ? $_POST['password'] : '';
  $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';
  //var_dump($username, $password, $confirm_password);


  // Prüfung: Nutzername nicht leer und min. 3 Zeichen
  if (empty($username)) {
    $errors[] = "Der Nutzername darf nicht leer sein.";
  } elseif (strlen($username) < 3) {
    $errors[] = "Der Nutzername muss mindestens 3 Zeichen lang sein.";
  }

  // Prüfung: Nutzername  vergeben (BackendService-Aufruf)
  if (!empty($username) && $service->userExists($username)) {
    $errors[] = "Der Nutzername ist bereits vergeben.";
  }

  // Prüfung: Passwort nicht leer
  if (empty($password)) {
    $errors[] = "Das Passwort darf nicht leer sein.";
  }

  // Prüfung: Passwort min. 8 Zeichen
  if (!empty($password) && strlen($password) < 8) {
    $errors[] = "Das Passwort muss mindestens 8 Zeichen lang sein.";
  }

  // Prüfung: Passwort-Wiederholung stimmt überein
  if ($password !== $confirm_password) {
    $errors[] = "Das Passwort und die Wiederholung stimmen nicht überein.";
  }

  if (count($errors) == 0) {
    $res = $service->register($username, $password);

    if ($res) {
      $_SESSION['user'] = $username;
      header("Location: friends.php");
    } else {
      $errors[] = "Error with registering. Try again.";
    }
  }
}

?>

<head>
  <meta charset="UTF-8" />
  <!-- <link rel="stylesheet" href="styles.css" />  -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registration Page</title>
</head>

<body class="bg-light container-lg d-flex justify-content-center">
  <br>
  <div class="bg-white flex-container arialfont">
    <div class="center">
      <img class="rounded-circle mx-auto d-block w-25 m-3" src="./images/user.png" class="img-rounded"
        alt="Login page" />


      <?php
      // Fehler anzeigen, falls vorhanden
      if (!empty($errors)) {
        echo '<div style="color: red; font-size: 19px;">';
        foreach ($errors as $error) {
          echo "<p>$error</p>";
        }
        echo '</div>';
      }
      ?>



      <div class="border p-5 mt-5 bg-white">

        <h3 class="text-center pb-2">Register yourself</h3>

        <form id="register_form" action="register.php" method="POST">

          <div class="form-floating mb-3">

            <input type="username" name="username" class="form-control" id="username" placeholder="Username"
              value="<?php echo htmlspecialchars($username ?? '', ENT_QUOTES, 'UTF-8'); ?>" onkeyup="userChecker()"
              required />


            <label for="username">Username</label>
            <div class="valid-feedback">
              Verfügbar!
            </div>
            <div class="invalid-feedback" id="invalidFeedbackUsername">
              Der Nutzername muss mindestens 3 Zeichen lang sein.
            </div>



          </div>



          <div class="form-floating mb-3">
            <input type="password" name="password" class="form-control" id="password" placeholder="Password"
              value="<?php echo htmlspecialchars($password ?? '', ENT_QUOTES, 'UTF-8'); ?>"
              oninput="passwordFieldChecker()" required />
            <label for="password">Password</label>
            <div class="invalid-feedback">
              Das Passwort muss mindestens 8 Zeichen lang sein.
            </div>
          </div>

          <div class="form-floating mb-5">
            <input type="password" name="confirm_password" class="form-control" id="confirm_password"
              placeholder="Confirm Password"
              value="<?php echo htmlspecialchars($confirm_password ?? '', ENT_QUOTES, 'UTF-8'); ?>"
              oninput="confirmPasswordFieldChecker()" required />
            <label for="confirm_password">Confirm Password</label>
            <div class="invalid-feedback">
              Die Passwörter stimmen nicht überein.
            </div>
          </div>

        </form>





        <div class="btn-group w-100" role="group" aria-label="Basic example">


          <a class="btn btn-secondary" button href="login.html" type="button">Cancel</a>
          <button class="btn btn-primary" type="submit" form="register_form" id="register_button">
            Create Account
          </button>

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
  <script src="register.js"></script>
</body>

</html>