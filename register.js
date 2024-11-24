function checkIfUserExists(userName) {
    var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        let data = JSON.parse(xmlhttp.responseText);
        console.log(data);
    }
};

    var requestUser = "https://online-lectures-cs.thi.de/chat/7c6a5231-9a5a-445c-bc84-6d2bc99600b1/user/" + userName;
    xmlhttp.open("GET", requestUser, true);
    xmlhttp.setRequestHeader('Authorization', 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjoiVG9tIiwiaWF0IjoxNzMyNDQ3MTI4fQ.7ZPiucbT3OJSxtWYKqxBCpkKsxPfjgHMr4LUS06Ef4Y');
    xmlhttp.send();

    return userExists;
};

function checkUsernameInputLength() {
    var inputField = document.getElementById("username");
    if(inputField.value.length < 3) {
        inputField.style.boxShadow = "inset 0 0 0 2px red";
    } else {
        inputField.style.boxShadow = "inset 0 0 0 2px green";
    };
};

function checkPasswordInputLength() {
    var inputField = document.getElementById("password");
    if(inputField.value.length < 8) {
        inputField.style.boxShadow = "inset 0 0 0 2px red";
        return false;
    } else {
        inputField.style.boxShadow = "inset 0 0 0 2px green";
        return true;
    };
};

function checkPasswordConfirmInputLength() {
    var inputField = document.getElementById("confirm_password");
    if(inputField.value.length < 8) {
        inputField.style.boxShadow = "inset 0 0 0 2px red";
    } else {
        inputField.style.boxShadow = "inset 0 0 0 2px green";
    };
};

function checkInputValidity() {
    var usernameField = document.getElementById("username");
    var passwordField = document.getElementById("password");
    var confirmPasswordField = document.getElementById("confirm_password");
    if(usernameField.value.length < 3) {
        return false;
    }
    if((passwordField.value.length < 8) && (confirmPasswordField.value.length < 8)) {
        return false;
    }
    if(passwordField.value != confirmPasswordField.value) {
        return false;
    }
    if(checkIfUserExists(usernameField.value)) {
        return false;
    }
    return true;
}
