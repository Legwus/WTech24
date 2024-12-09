const passwordField = document.getElementById("password");
const confirmPasswordField = document.getElementById("confirm_password");
const usernameField = document.getElementById("username");
const form = document.getElementById("register_form");
const registerButton = document.getElementById("register_button");



userChecker();
passwordFieldChecker();
confirmPasswordFieldChecker();


function checkIfUserExists(userName) {
  var xmlhttp = new XMLHttpRequest();
  var userExists = false;
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4) {
      if (xmlhttp.status == 204) {
        console.log("Username already exists.");
        userExists = true;
      } else if (xmlhttp.status == 404) {
        console.log("Username available.");
        userExists = false;
      }
    }
  };

  var requestUser =
    "https://online-lectures-cs.thi.de/chat/7c6a5231-9a5a-445c-bc84-6d2bc99600b1/user/" +
    userName;
  xmlhttp.open("GET", requestUser, false);
  xmlhttp.send();

  return userExists;
}


function passwordFieldChecker() {

  const pw = passwordField.value;
  if (pw.length == 0) {
    passwordField.style.borderColor = "black";
    passwordField.style.backgroundColor = "white"
  } else {
    if (pw.length < 8) {
      passwordField.style.borderColor = "red";
      passwordField.style.backgroundColor = "rgba(255, 0, 0, 0.2)"
    } else {
      passwordField.style.borderColor = "green";
      passwordField.style.backgroundColor = "rgba(144, 238, 144, 0.5)";
    }

  }
}

function confirmPasswordFieldChecker() {

  const pw = passwordField.value;
  const pwc = confirmPasswordField.value


  if (pwc.length == 0) {
    confirmPasswordField.style.borderColor = "black";
    confirmPasswordField.style.backgroundColor = "white"
  } else {

    if (pwc.length < 8 || pwc != pw) {
      confirmPasswordField.style.borderColor = "red";
      confirmPasswordField.style.backgroundColor = "rgba(255, 0, 0, 0.2)"
    } else {
      confirmPasswordField.style.borderColor = "green";
      confirmPasswordField.style.backgroundColor = "rgba(144, 238, 144, 0.5)";
    }

  }
}


/*
registerButton.disabled = !(
  passwordFieldChecker() &&
  confirmPasswordFieldChecker() &&
  userChecker()
);
*/



function userChecker() {
  const userExists = checkIfUserExists(usernameField.value);

  if (usernameField.value.length == 0) {
    usernameField.style.borderColor = "black";
    usernameField.style.backgroundColor = "white"
  } else {


    if (usernameField.value.length >= 3) {

      if (userExists) {
        usernameField.style.borderColor = "red";
        usernameField.style.backgroundColor = "rgba(255, 0, 0, 0.2)"
        //passwordField.style.borderColor = "green";
        return false;
      } else {
        usernameField.style.borderColor = "green";
        usernameField.style.backgroundColor = "rgba(144, 238, 144, 0.5)"; // Light green with 50% transparency

        // passwordField.style.borderColor = "red";
        return true;
      }
    } else {
      usernameField.style.borderColor = "red";
      usernameField.style.backgroundColor = "rgba(255, 0, 0, 0.2)"
      //passwordField.style.borderColor = "green";
      return false;
    }
  }
}