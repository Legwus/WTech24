const passwordField = document.getElementById("password");
const confirmPasswordField = document.getElementById("confirm_password");
const usernameField = document.getElementById("username");
const form = document.getElementById("register_form");
const registerButton = document.getElementById("register_button");

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

const passwordFieldValidator = (value) => value.length >= 8;
const confirmPasswordFieldValidator = (value, passwordValue) =>
  value == passwordValue;
const usernameFieldValidator = (value) => value.length >= 3;

passwordField.addEventListener("input", (event) => {
  checkField(event.target, passwordFieldValidator(event.target.value));
  checkField(
    confirmPasswordField,
    confirmPasswordFieldValidator(usernameField.value, event.target.value)
  );
});

confirmPasswordField.addEventListener("input", (event) => {
  checkField(
    event.target,
    confirmPasswordFieldValidator(event.target.value, passwordField.value)
  );
});

usernameField.addEventListener("input", (event) => {
  checkField(event.target, usernameFieldValidator(event.target.value));
});

form.addEventListener("input", (event) => {
  const passwordFieldValid = passwordFieldValidator(passwordField.value);
  const confirmPasswordFieldValid = confirmPasswordFieldValidator(
    confirmPasswordField.value,
    passwordField.value
  );
  const usernameFieldValid = usernameFieldValidator(usernameField.value);

  registerButton.disabled = !(
    passwordFieldValid &&
    confirmPasswordFieldValid &&
    usernameFieldValid
  );
});

form.addEventListener("submit", (event) => {
  event.preventDefault();
  const userExists = checkIfUserExists(usernameField.value);
  checkField(usernameField, !userExists);

  if (userExists) {
    alert("Username already exists.");
  } else {
    window.location.href = "friends.html";
  }
});

const checkField = (event, validator) => {
  if (validator) {
    event.style.borderColor = "green";
    //passwordField.style.borderColor = "green";
    return true;
  } else {
    event.style.borderColor = "red";
    // passwordField.style.borderColor = "red";
    return false;
  }
};
