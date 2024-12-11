<?php
// require_once 'Model/User.php'; // Include the file containing the class

require("start.php");
if (!isset($_SESSION)) {
  header('Location: login.html');
  exit;
}
// $user = new User(true); // Create an instance of the class
// echo $example->getRadio() ? 'Radio is on' : 'Radio is off'; // Call the getter
// //
//$user = new Model\User("Test123");

$service = new Utils\BackendService(CHAT_SERVER_URL, CHAT_SERVER_ID);

// $service->login("Test1234", "12345678");

$user = $service->loadUser($_SESSION['user']);
$json = json_encode($user);
//var_dump($user->getCoffeeTea());
?>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // $name = $_POST['bio']; 
  $bio = $_POST['bio'];
  $fname = $_POST['fname'];
  $surname = $_POST['surname'];
  $coffeeTea = $_POST['choice'];

  if (isset($_POST['radio'])) {
    // Convert the string value to a boolean
    $radio = $_POST['radio'] == '1'; // '1' becomes true, '0' becomes false
  } else {
    $radio = false; // No selection defaults to false
  }


  // Set the value in the user object

  $user->setBio($bio);
  $user->setFirstName($fname);
  $user->setSurName($surname);
  $user->setCoffeeTea($coffeeTea);
  $user->setRadio($radio);
  $versions = $user->getVersions();
  $versions[] = date('Y-m-d H:i:s');
  $user->setVersions($versions);
  $service->saveUser($user);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="styles.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Settings Page</title>
</head>

<body>
  <div class="flex-container arialfont settings">
    <div class="center">
      <h2 class="align-to-the-left">Profile Settings</h2>

      <form id="settingsForm" method="POST" action="settings.php">
        <fieldset class="dotted-border fieldsetstyling">
          <legend>Base Data</legend>
          <label for="fname"> First Name </label>
          <input value="<?php echo $user->getFirstName(); ?>"
            type="text"
            id="fname"
            name="fname"
            placeholder="Your name"></input><br /><br />

          <label for="surname">Last Name</label>

          <input value="<?php echo $user->getSurName() ?>"
            type="text"
            id="surname"
            name="surname"
            placeholder="Your surname">
          </input><br /><br />
          <label for="choice"> Coffee or Tea? </label>
          <select name="choice" id="coffeeTea">

            <option <?php if ($user->getCoffeeTea() == 'Neither nor') echo 'selected=selected' ?>value="Neither Nor">Neither nor</option>
            <option <?php if ($user->getCoffeeTea() == 'Coffee') echo 'selected=selected' ?> value="Coffee">Coffee </option>
            <option <?php if ($user->getCoffeeTea() == 'Tea') echo 'selected=selected' ?> value="Tea">Tea </option>
          </select><br />
        </fieldset>
        <fieldset class="dotted-border fieldsetstyling">
          <legend>Tell Something About You</legend>

          <?php //var_dump($user) 
          ?>
          <textarea

            class="about-you-textfield custom-placeholder"
            id="bio"
            name="bio"
            placeholder="something idk"><?php echo $user->getBio(); ?></textarea>
          <br />
        </fieldset>
        <fieldset class="dotted-border fieldsetstyling align-to-the-left">
          <legend>Preferred Chat Layout</legend>

          <!-- 'oneline' radio button mapped to true -->
          <input type="radio" id="oneline" name="radio" value="1" <?php if ($user->getRadio() == true) echo 'checked'; ?> />Username and message in one line<br /><br />

          <!-- 'sepline' radio button mapped to false -->
          <input type="radio" id="sepline" name="radio" value="0" <?php if ($user->getRadio() == false) echo 'checked'; ?> />Username and message in separated lines
        </fieldset>

        <a class="a-button" href="friends.php">
          <button class="nicebutton" type="button">Cancel</button>
        </a>

        <input
          class="nicebutton justbluebkgrd"
          type="submit"
          value="Save"
          form="settingsForm" />
      </form>

    </div>
  </div>
</body>

</html>