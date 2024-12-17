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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="styles.css" /> -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Settings Page</title>
  <style>
      .custom-height {
            height: 50px; /* Set desired height */
            font-size: 1rem; /* Keep font size normal */
        }
    </style>
</head>

<body class="bg-light container-lg d-flex  justify-content-center">
<div class="flex-container w-50 arialfont">
<div class="center">
<!-- <div class="border p-5 mt-5 bg-white">       -->
<br/><br/>
<h2>Profile Settings</h2>
<hr></hr>
      <form id="settingsForm" method="POST" action="settings.php">
        
          <h4>Base Data</h4>
          
          <div class="floating-form mb-3">
          
          <input  name="fname" value="<?php echo $user->getFirstName(); ?>" type="name" class="form-control custom-height" id="fname" placeholder="Your First Name">
          </div>


          <!-- <input value="<?php echo $user->getFirstName(); ?>"
            type="text"
            id="fname"
            name="fname"
            placeholder="Your name"></input><br /><br /> -->

          <div class="mb-3">
          <input value="<?php echo $user->getSurName() ?>" name="surname" value="<?php echo $user->getFirstName(); ?>" type="name" class="form-control custom-height" id="surname" placeholder="Your Surname">
          </div>
          <!-- <input value="<?php echo $user->getSurName() ?>"
            type="text"
            id="surname"
            name="surname"
            placeholder="Your surname">
          </input><br /><br /> -->
          <div class="form-floating">
          <select id="floatingSelect" name="choice" class="form-select" aria-label="Default select example">
          <option <?php if ($user->getCoffeeTea() == 'Neither nor') echo 'selected=selected' ?> value="Neither nor">Neither nor</option>
          <option <?php if ($user->getCoffeeTea() == 'Coffee') echo 'selected=selected' ?> value="Coffee">Coffee</option>
          <option <?php if ($user->getCoffeeTea() == 'Tea') echo 'selected=selected' ?> value="Tea">Tea</option>
           </select>
           <label for="floatingSelect">Coffee or Tea?</label>
           </div>
          <!-- <select name="choice" id="coffeeTea">

            <option <?php if ($user->getCoffeeTea() == 'Neither nor') echo 'selected=selected' ?>value="Neither Nor">Neither nor</option>
            <option <?php if ($user->getCoffeeTea() == 'Coffee') echo 'selected=selected' ?> value="Coffee">Coffee </option>
            <option <?php if ($user->getCoffeeTea() == 'Tea') echo 'selected=selected' ?> value="Tea">Tea </option>

          </select><br /> -->
        <hr>
        
          <h5>Tell Something About You</h5>
         
          <div class="mb-3">
          <textarea name="bio" class="form-control" id="bio" rows="3"><?php echo $user->getBio(); ?></textarea>
          </div>
          <!-- <textarea

            id="bio"
            name="bio"
            placeholder="something idk"><?php //echo $user->getBio(); ?></textarea> -->
        
       <hr>
        
          <h5>Preferred Chat Layout</h5>
          <div class="form-check">
          <input class="form-check-input" type="radio" name="radio" id="oneline" value="1" <?php if ($user->getRadio() == true) echo 'checked'; ?>>
          <label class="form-check-label" for="flexRadioDefault1">
          Username and message in one line
          </label>
           </div>
           <div class="form-check">
          <input class="form-check-input" type="radio" name="radio" id="sepline" value="0" <?php if ($user->getRadio() == false) echo 'checked'; ?>>
          <label class="form-check-label" for="flexRadioDefault1">
          Username and message in separated lines
          </label>
           </div>
          <!-- 'oneline' radio button mapped to true -->
          <!-- <input type="radio" id="oneline" name="radio" value="1" <?php if ($user->getRadio() == true) echo 'checked'; ?> />Username and message in one line<br /><br /> -->

          <!-- 'sepline' radio button mapped to false -->
          <!-- <input type="radio" id="sepline" name="radio" value="0" <?php if ($user->getRadio() == false) echo 'checked'; ?> />Username and message in separated lines -->
    
      <hr>
      <div class="btn-group w-100" role="group" aria-label="Basic example">


      <a class="btn btn-secondary" button href="friends.php" type="button">Cancel</a>
      <button value="Save" class="btn btn-primary" type="submit" form="settingsForm" id="register_button">
        Save
      </button>

      </div>

<!-- </div> -->
  </div>
    </div>
</body>

</html>