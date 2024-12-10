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
  <link rel="stylesheet" href="styles.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registration Page</title>
</head>

<body>
  <div class="flex-container arialfont">
    <div class="center">
      <img class="default-image-size img-rounded" src="./images/user.png" class="img-rounded" alt="Login page" />
      <h3>Register yourself</h3>

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



      <fieldset class="dotted-border fieldsetstyling">
        <legend>Register</legend>
        <form id="register_form" action="register.php" method="POST">
          <label for="username">Username:</label>
          <input type="text" id="username" name="username"
            value="<?php echo htmlspecialchars($username ?? '', ENT_QUOTES, 'UTF-8'); ?>" onchange="userChecker()"
            required /><br />
          <br />
          <label for="password">Password:</label>
          <input type="password" id="password" name="password"
            value="<?php echo htmlspecialchars($password ?? '', ENT_QUOTES, 'UTF-8'); ?>"
            oninput="passwordFieldChecker()" required />
          <br />
          <br />
          <label for="confirm_password">Confirm Password:</label>
          <input type="password" id="confirm_password" name="confirm_password"
            value="<?php echo htmlspecialchars($confirm_password ?? '', ENT_QUOTES, 'UTF-8'); ?>"
            oninput="confirmPasswordFieldChecker()" required /><br /><br />
        </form>
      </fieldset>
      <a class="nicebutton" button href="login.html" type="button">Cancel</a>
      <button class="nicebutton justbluebkgrd" type="submit" form="register_form" id="register_button">
        Register
      </button>
    </div>
  </div>
  <script src="register.js"></script>
</body>

</html>