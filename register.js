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

function checkUsernameInputLength() {
  var inputField = document.getElementById("username");
  if (inputField.value.length < 3) {
    inputField.style.borderColor = "red";
  } else {
    inputField.style.borderColor = "green";
  }
}

function checkPasswordInputLength() {
  var passwordField = document.getElementById("password");
  if (passwordField.value.length < 8) {
    passwordField.style.borderColor = "red";
  } else {
    passwordField.style.borderColor = "green";
  }
}

function checkPasswordConfirmInputLength() {
  var inputField = document.getElementById("confirm_password");
  if (inputField.value.length < 8) {
    inputField.style.borderColor = "red";
  } else {
    inputField.style.borderColor = "green";
  }
}

function checkInputValidity() {
  var usernameField = document.getElementById("username");
  var passwordField = document.getElementById("password");
  var confirmPasswordField = document.getElementById("confirm_password");
  if (usernameField.value.length < 3) {
    return false;
  }
  if (passwordField.value.length < 8 && confirmPasswordField.value.length < 8) {
    passwordField.style.borderColor = "red";
    return false;
  }
  if (passwordField.value != confirmPasswordField.value) {
    confirmPasswordField.style.borderColor = "red";
    passwordField.style.borderColor = "red";
    return false;
  }
  if (checkIfUserExists(usernameField.value)) {
    usernameField.style.borderColor = "red";
    return false;
  } else if (!checkIfUserExists(usernameField.value)) {
    usernameField.style.borderColor = "green";
  }
  return true;
}
