// ["Tom", "Jerry", "Tick", "Trick", "Truck", "Micky", "Donald", "Marvin"]

// Read the token from the text file

let backendUrl =
  "https://online-lectures-cs.thi.de/chat/132d33f2-44cf-45e1-9e85-e9da1b64102b";
let tom =
  "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjoiVG9tIiwiaWF0IjoxNzMyNjMwMjgyfQ.R4fqhDBoT011itGxilKlo2JTK0Dj69ugs8YiJoR_DqI";
let jerry =
  "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjoiSmVycnkiLCJpYXQiOjE3MzI2MzAyODJ9.pA9-AuP-DEuuRcYOf6Xv9oD8O3AqiFwjLh239oIJACI";

let token = jerry;
window.setInterval(function () {
  loadFriends();
}, 1000);

loadFriends();

function acceptFriend(userName) {
  console.log("Accepting friend request from " + userName);
}

function rejectFriend(userName) {
  console.log("Reject friend request from " + userName);
}

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
        if (
          friend.status === "requested" &&
          !acceptedFriends.has(friend.username)
        ) {
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
      let friendList = Array.from(
        document.getElementById("friendList").getElementsByTagName("a")
      ).map((friend) => friend.textContent); // Extract usernames from friend list

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
        if (user == currentUser || friendList.includes(user)) return;

        let option = document.createElement("option");
        option.value = user; // Set the option's value to the username
        dataList.appendChild(option);
      });

      // Handle Add Friend button state based on input
      let inputField = document.getElementById("addFriend");
      let addButton = document.getElementById("addButton");

      inputField.addEventListener("input", function () {
        let inputValue = inputField.value;
        console.log(inputValue.length);
        // Check if input is empty or invalid
        if (inputValue.length == 0) {
          addButton.disabled = true; // Enable button
          inputField.style.boxShadow = "none"; // No shadow for no input
          inputField.style.border = "none";
        } else if (
          !data.includes(inputValue) || // Not in user list
          inputValue == currentUser || // Current user
          friendList.includes(inputValue) // Already a friend
        ) {
          addButton.disabled = true; // Disable button
          inputField.style.boxShadow = "inset 0 0 2px red"; // Red shadow for invalid input
          inputField.style.border = "1px solid red";
        } else {
          addButton.disabled = false; // Enable button
          inputField.style.boxShadow = "none"; // No shadow for valid input
          inputField.style.border = "none";
        }
      });
    }
  };

  xmlhttp.open("GET", backendUrl + "/user", true);
  xmlhttp.setRequestHeader("Authorization", "Bearer " + token);
  xmlhttp.send();
}

function addUser(event) {
  event.preventDefault(); // Prevent page refresh

  let xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 204) {
      console.log("Requested...");
    }
  };
  xmlhttp.open("POST", backendUrl + "/friend", true);
  xmlhttp.setRequestHeader("Content-type", "application/json");
  xmlhttp.setRequestHeader("Authorization", "Bearer " + token);
  let data = {
    username: document.getElementById("addFriend").value,
  };

  console.log(data);
  let jsonString = JSON.stringify(data);
  console.log(jsonString);
  xmlhttp.send(jsonString);
}
