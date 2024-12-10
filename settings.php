<?php
// require_once 'Model/User.php'; // Include the file containing the class

require("start.php");

// $user = new User(true); // Create an instance of the class
// echo $example->getRadio() ? 'Radio is on' : 'Radio is off'; // Call the getter
// //
//$user = new Model\User("Test123");

$service = new Utils\BackendService(CHAT_SERVER_URL, CHAT_SERVER_ID);

$service->login("Test123", "12345678");

$user = $service->loadUser("Test123");
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
  var_dump($_POST);
  $user->setBio($bio);
  $user->setFirstName($fname);
  $user->setSurName($surname);
  $user->setCoffeeTea($coffeeTea);
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

      <form id="settingsForm" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
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
            <option <?php if ($user->getCoffeeTea() == 'neither') echo 'selected=selected' ?>value="neither">Neither nor</option>
            <option <?php if ($user->getCoffeeTea() == 'coffee') echo 'selected=selected' ?> value="coffee">Coffee </option>
            <option <?php if ($user->getCoffeeTea() == 'tea') echo 'selected=selected' ?> value="tea">Tea </option>
          </select><br />
        </fieldset>
        <fieldset class="dotted-border fieldsetstyling">
          <legend>Tell Something About You</legend>

          <textarea

            class="about-you-textfield custom-placeholder"
            id="bio"
            name="bio"
            placeholder="something idk"><?php echo $user->getBio(); ?></textarea>
          <br />
        </fieldset>
        <fieldset class="dotted-border fieldsetstyling align-to-the-left">
          <legend>Preferred Chat Layout</legend>
          <input type="radio" id="oneline" name="radio1" />Username and
          message in one link<br /><br />
          <input type="radio" id="sepline" name="radio2" />Username and
          message in separated lines
        </fieldset>
        <a class="a-button" href="friends.html">
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