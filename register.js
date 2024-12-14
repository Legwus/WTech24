
const form = document.getElementById("register_form");
const registerButton = document.getElementById("register_button");



userChecker();
passwordFieldChecker();
confirmPasswordFieldChecker();


function checkIfUserExists(userName) {

 
  var xmlhttp = new XMLHttpRequest();
  var userExists = false;

  // Asynchrone Anfrage statt synchron (true statt false)
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4) { // Anfrage abgeschlossen
      if (xmlhttp.status == 204) {
        console.log("Username already exists.");
        userExists = true; // Benutzername existiert
      } else if (xmlhttp.status == 404) {
        console.log("Username available.");
        userExists = false; // Benutzername verfügbar
      } else {
        console.error("Error with the request.");
      }
    }
  };

  // Anfrage an das PHP-Skript 'ajax_check_user.php' mit dem Benutzername als URL-Parameter
  var requestUser = "ajax_check_user.php?user=" + userName;

  // Asynchrone HTTP-GET-Anfrage an das PHP-Skript
  xmlhttp.open("GET", requestUser, false); // true = asynchron
  xmlhttp.send();

  return userExists; // Gibt zurück, ob der Benutzername existiert oder nicht
}



function passwordFieldChecker() {

  var passwordField = document.getElementById("password");
  var pw = passwordField.value;
  
  if (pw.length === 0) {
    // Neutral state

    passwordField.classList.remove("is-valid");
    passwordField.classList.remove("is-invalid");
  } else if (pw.length < 8) {
    // Invalid state

    passwordField.classList.remove("is-valid");
    passwordField.classList.add("is-invalid");
  } else {
    // Valid state

    passwordField.classList.remove("is-invalid");
    passwordField.classList.add("is-valid");
  }
}

function confirmPasswordFieldChecker() {
  var confirmPasswordField = document.getElementById("confirm_password");
  var passwordField = document.getElementById("password");

  var pw = passwordField.value;
  var pwc = confirmPasswordField.value


  if (pwc.length == 0) {
    confirmPasswordField.classList.remove("is-invalid");
    confirmPasswordField.classList.remove("is-valid");
  } else {

    if (pwc.length < 8 || pwc != pw) {
      confirmPasswordField.classList.remove("is-valid");
      confirmPasswordField.classList.add("is-invalid");
    } else {
      confirmPasswordField.classList.remove("is-invalid");
      confirmPasswordField.classList.add("is-valid");
    }

  }
}


function userChecker() {
  console.log("checking user");
  var usernameField = document.getElementById("username");
  var feedback= document.getElementById("invalidFeedbackUsername");
  var userExists = checkIfUserExists(usernameField.value);

  if (usernameField.value.length == 0) {
    usernameField.classList.remove("is-valid");
    usernameField.classList.remove("is-invalid");


  } else {


    if (usernameField.value.length >= 3) {

      if (userExists) {

        //passwordField.style.borderColor = "green";
        usernameField.classList.remove("is-valid");
        usernameField.classList.add("is-invalid");
        feedback.innerHTML="Nutzername bereits vergeben.";
        return false;
      } else {

        usernameField.classList.remove("is-invalid");
        usernameField.classList.add("is-valid");
        // passwordField.style.borderColor = "red";
        return true;
      }
    } else {

      //passwordField.style.borderColor = "green";
      usernameField.classList.remove("is-valid");
      usernameField.classList.add("is-invalid");
      feedback.innerHTML="Der Nutzername muss mindestens 3 Zeichen lang sein.";
      return false;
    }
  }
}