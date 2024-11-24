// https://online-lectures-cs.thi.de/chat/7c6a5231-9a5a-445c-bc84-6d2bc99600b1/user


function listUsers() {
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