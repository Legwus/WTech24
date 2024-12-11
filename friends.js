// ["Tom", "Jerry", "Tick", "Trick", "Truck", "Micky", "Donald", "Marvin"]

// Read the token from the text file
let currentUser = "";
let token = "";

window.setInterval(function () {
  loadFriends();
}, 10000);

loadFriends();
getCurrentUser();

function acceptFriend(userName) {
  console.log("Accepting friend request from " + userName);
  let xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      let data = JSON.parse(xmlhttp.responseText);
      console.log("response: ");
      console.log(data);

     
      console.log("sending request"); 
       }
  }; 
      var requestUser = "ajax_accept_friend.php?friendname=" + userName;
      xmlhttp.open("GET", requestUser, true);
      xmlhttp.setRequestHeader("Content-type", "application/json");
      xmlhttp.send();

}

function rejectFriend(userName) {
  console.log("Reject friend request from " + userName);
  let xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      let data = JSON.parse(xmlhttp.responseText);
      console.log("response: ");
      console.log(data);

     
      console.log("sending request"); 
       }
  }; 
      var requestUser = "ajax_decline_friend.php?friendname=" + userName;
      xmlhttp.open("GET", requestUser, true);
      xmlhttp.setRequestHeader("Content-type", "application/json");
      xmlhttp.send();

}


function loadFriends() {
  let xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      let data = JSON.parse(xmlhttp.responseText);
      console.log("loadFriends: ");
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
          link.href = "chat.php?friend=" + friend.username;
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

  xmlhttp.open("GET", "ajax_load_friends.php", true);
  xmlhttp.setRequestHeader("Content-type", "application/json");
  xmlhttp.send();
}

function listUsers() {
  let xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      let data = JSON.parse(xmlhttp.responseText); // User list from backend
      console.log("listUsers: ");
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
      /*if (token == tom) {
        currentUser = "Tom";
      }
      if (token == jerry) {
        currentUser = "Jerry";
      }*/

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

  xmlhttp.open("GET", "ajax_load_users.php", true);
  xmlhttp.send();
}

function getCurrentUser() {
  let xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      let data = JSON.parse(xmlhttp.responseText); // User list from backend
      currentUser = data.user;
      console.log(currentUser);
    }
  }
  xmlhttp.open("GET", "ajax_get_current_user.php", true);
  xmlhttp.send();
}

function getCurrentToken() {
  let xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      let data = JSON.parse(xmlhttp.responseText); // User list from backend
      token = data.chat_token;
      console.log(token);
    }
  }
  xmlhttp.open("GET", "ajax_get_current_token.php", true);
  xmlhttp.send();
}

function addUser(event) {
  event.preventDefault(); // Prevent page refresh

  let xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    console.log("State: " + xmlhttp.readyState);
    console.log("Status: " + xmlhttp.status);
    if (xmlhttp.readyState == 4 && xmlhttp.status == 204) {
      console.log("Requested...");
    }
  };
  xmlhttp.open("POST", "ajax_send_friendrequest.php", false);
  xmlhttp.setRequestHeader("Content-type", "application/json");
  let data = {
    username: document.getElementById("addFriend").value,
  };

  let jsonString = JSON.stringify(data);
  console.log(jsonString);
  xmlhttp.send(jsonString);
}
