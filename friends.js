// ["Tom", "Jerry", "Tick", "Trick", "Truck", "Micky", "Donald", "Marvin"]

// Read the token from the text file
let currentUser = "";
let token = "";

window.setInterval(function () {
  loadFriends();
}, 1000);

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
      loadFriends();

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
      loadFriends();

}

function loadFriends() {
  let xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      let data = JSON.parse(xmlhttp.responseText);

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
          li.classList.add("list-group-item", "list-group-item-action", "d-flex", "justify-content-between", "align-items-start")
          let link = document.createElement("a");
          link.classList.add("list-group-item-action");
          link.setAttribute("style", "text-decoration: none;");
          link.href = "chat.php?friend=" + friend.username;
          link.textContent = friend.username;
          li.append(link);


          // If the friend has unread messages, add a notification
          if (friend.unread > 0) {
            let span = document.createElement("span");
            span.className = "badge text-bg-primary rounded-pill";
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
          let li = document.createElement("a");
          li.classList.add("list-group-item", "list-group-item-action");
          li.innerHTML = `Friend request from <strong>${friend.username}</strong>`;
          li.addEventListener("click", () => {
            li.setAttribute("data-bs-toggle", "modal");
            li.setAttribute("data-bs-target", "#friendrequest-modal");
            document.getElementById("friend_request_header").innerText = `Request from ${friend.username}`;
            document.getElementById("friend_request_reject").onclick = () => {
              fetch(`friends.php?action=reject&name=${friend.username}`, {"method": "POST"});
            }
            document.getElementById("friend_request_accept").onclick = () => {
              fetch(`friends.php?action=accept&name=${friend.username}`, {"method": "POST"});
            }
          });
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
          inputField.style.border = "1px solid black";
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
          inputField.style.boxShadow = "inset 0 0 2px green"; // No shadow for valid input
          inputField.style.border = "1px solid black";
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
    console.log("Token XML State: " + xmlhttp.readyState);
    console.log("Token XML Status: " + xmlhttp.status);
  if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
    let data = JSON.parse(xmlhttp.responseText); // User list from backend
    token = data.user;
    return token;
    }
  }
  xmlhttp.open("GET", "ajax_get_current_token.php", true);
  xmlhttp.send();
}

function addUser(event) {
  event.preventDefault(); // Prevent page refresh
  
  let xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    console.log("AddFriend XML State: " + xmlhttp.readyState);
    console.log("AddFriend XML Status: " + xmlhttp.status);
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      console.log(xmlhttp.responseText);
    }
  };

  let data = {
    username: document.getElementById("addFriend").value,
  };
  
  let jsonString = JSON.stringify(data);
  xmlhttp.open("POST", "ajax_send_friendrequest.php", true);
  xmlhttp.setRequestHeader("Content-type", "application/json");
  xmlhttp.send(jsonString);
}
