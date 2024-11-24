// ["Tom", "Jerry", "Tick", "Trick", "Truck", "Micky", "Donald", "Marvin"]


var backendUrl = "https://online-lectures-cs.thi.de/chat/fe8c514e-c64a-4283-8b26-fee9ce7c70b5";
var tom = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjoiVG9tIiwiaWF0IjoxNzMyNDU2NTMyfQ.hzuLqwOEsdImd3mkH2YHEYbo6c68F7JoIfiG7HvBGsg";
var jerry = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjoiSmVycnkiLCJpYXQiOjE3MzI0NTY1MzJ9.L_N8uCDkg1D-ODQCvePqZ-n3rNO0cuH3dOviwsX_ul0";

var token = tom;


window.setInterval(function () {
    loadFriends();
}, 1000);


loadFriends();



function loadFriends() {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            let data = JSON.parse(xmlhttp.responseText);
            console.log(data);

            // Get the friend list containers
            let friendList = document.getElementById("friendList");
            let friendRequestList = document.getElementById("friendRequestList");

            // Clear existing list items
            friendList.innerHTML = "";
            friendRequestList.innerHTML = "";

            // Create a set to track already accepted friends
            let acceptedFriends = new Set();

            // Populate the accepted friends list
            data.forEach(function (friend) {
                if (friend.status === "accepted") {
                    // Add to the accepted friends list
                    let li = document.createElement("li");
                    let link = document.createElement("a");
                    link.href = "chat.html?friend=" + friend.username;
                    link.textContent = friend.username;

                    li.appendChild(link);

                    // If the friend has unread messages, add a notification
                    if (friend.unread > 0) {
                        let span = document.createElement("span");
                        span.className = "notification-border";
                        span.textContent = friend.unread;
                        li.appendChild(span);
                    }

                    friendList.appendChild(li);

                    // Add the username to the set of accepted friends
                    acceptedFriends.add(friend.username);
                }
            });

            // Populate the friend requests list, ignoring duplicates
            data.forEach(function (friend) {
                if (friend.status === "requested" && !acceptedFriends.has(friend.username)) {
                    let li = document.createElement("li");
                    li.className = "align-to-the-left";

                    li.innerHTML = `
                        Friend Request from <strong>${friend.username}</strong>
                        <button class="nicebutton rounded-corners justbluebkgrd" onclick="acceptFriend('${friend.username}')">Accept</button>
                        <button class="nicebutton rounded-corners" onclick="rejectFriend('${friend.username}')">Reject</button>
                    `;

                    friendRequestList.appendChild(li);
                }
            });
        }
    };
    xmlhttp.open("GET", backendUrl + "/friend", true);
    xmlhttp.setRequestHeader("Content-type", "application/json");
    xmlhttp.setRequestHeader("Authorization", "Bearer " + token);
    xmlhttp.send();
}







function listUsers() {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            let data = JSON.parse(xmlhttp.responseText); // User list from backend
            console.log(data);

            // Get the datalist element
            let dataList = document.getElementById("friend-selector");

            // Clear existing options
            dataList.innerHTML = "";

            // Get the friend list for validation
            let friendList = Array.from(document.getElementById("friendList").getElementsByTagName("a"))
                .map(friend => friend.textContent); // Extract usernames from friend list

            // Current username (derived from the token)
            let currentUser = "";
            if (token == tom) {
                currentUser = "Tom";
            }
            if (token == jerry) {
                currentUser = "Jerry";
            }

            // Add options to the datalist and handle validation
            data.forEach(function (user) {
                // Skip if the user is "me" or already in the friend list
                if (user === currentUser || friendList.includes(user)) return;

                let option = document.createElement("option");
                option.value = user; // Set the option's value to the username
                dataList.appendChild(option);
            });

            // Handle Add Friend button state based on input
            let inputField = document.getElementById("addFriend");
            let addButton = document.getElementById("addButton");

            inputField.addEventListener("input", function () {
                let inputValue = inputField.value;
                if (!data.includes(inputValue) || inputValue === currentUser || friendList.includes(inputValue)) {
                    addButton.disabled = true; // Disable button if invalid
                    inputField.style.boxShadow = "inset 0 0 0 5px red";
                } else {
                    addButton.disabled = false; // Enable button if valid
                    inputField.style.boxShadow = "inset 0 0 0 5px none";
                }
            });
        }
    };

    xmlhttp.open("GET", backendUrl + "/user", true);
    xmlhttp.setRequestHeader("Authorization", "Bearer " + token);
    xmlhttp.send();
}



function addUser() {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 204) {
            console.log("Requested...");
        }
    };
    xmlhttp.open("POST", backendUrl + "/friend", true);
    xmlhttp.setRequestHeader('Content-type', 'application/json');
    xmlhttp.setRequestHeader('Authorization', 'Bearer ' + token);
    let data = {
        username: document.getElementById("addFriend").value
    };
    let jsonString = JSON.stringify(data);
    console.log(jsonString);
    xmlhttp.send(jsonString);


};



