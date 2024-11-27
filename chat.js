let backendUrl =
  "https://online-lectures-cs.thi.de/chat/132d33f2-44cf-45e1-9e85-e9da1b64102b";
let tom =
  "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjoiVG9tIiwiaWF0IjoxNzMyNjMwMjgyfQ.R4fqhDBoT011itGxilKlo2JTK0Dj69ugs8YiJoR_DqI";
let jerry =
  "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjoiSmVycnkiLCJpYXQiOjE3MzI2MzAyODJ9.pA9-AuP-DEuuRcYOf6Xv9oD8O3AqiFwjLh239oIJACI";
let token = tom;

const friendName = document.getElementById("friendName");

document.addEventListener("DOMContentLoaded", () => {
  const nameFromQuery = getChatpartner();
  if (nameFromQuery) {
    friendName.innerText = nameFromQuery;
    console.log(nameFromQuery);
  }
});

function listMessages() {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      let data = JSON.parse(xmlhttp.responseText);
      const chatbox = document.getElementById("chat-container");
      const htmlMessages = data.map((x) => showMessage(x)).join("");
      chatbox.innerHTML = htmlMessages;
      //console.log(htmlMessages);
      chatbox.scrollTop = chatbox.scrollHeight;
    }
  };
  const nameFromQuery = getChatpartner();
  xmlhttp.open(
    "GET",
    "https://online-lectures-cs.thi.de/chat/132d33f2-44cf-45e1-9e85-e9da1b64102b/message/" +
      nameFromQuery,
    true
  );
  // Add token, e. g., from Tom
  xmlhttp.setRequestHeader("Authorization", `Bearer ${token}`);
  xmlhttp.send();
}

function showMessage(message) {
  return `<li>${message.from}: ${message.msg}</li>`;
}

listMessages();
const sendMessage = document.getElementById("sendMessage");
const sendButton = document.getElementById("sendButton");
const chatSendForm = document.getElementById("chatSendForm");
chatSendForm.addEventListener("submit", (event) => {
  event.stopPropagation();
  event.preventDefault();
  sendMessages();
});
sendMessage.addEventListener("input", (event) => {
  const { value } = event.target;
  if (value.length <= 0) {
    sendButton.disabled = true;
  } else {
    sendButton.disabled = false;
  }
});

function resetInput() {
  sendMessage.value = "";
}

function sendMessages() {
  //debugger;
  const nameFromQuery = getChatpartner();
  let data = {
    message: sendMessage.value.trim(),
    to: nameFromQuery,
  };
  let xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 204) {
      console.log("done...");
      listMessages();
      resetInput();
    }
  };
  xmlhttp.open(
    "POST",
    "https://online-lectures-cs.thi.de/chat/132d33f2-44cf-45e1-9e85-e9da1b64102b/message",
    true
  );
  xmlhttp.setRequestHeader("Content-type", "application/json");
  // Add token, e. g., from Tom
  xmlhttp.setRequestHeader("Authorization", `Bearer ${token}`);
  // Create request data with message and receiver

  let jsonString = JSON.stringify(data); // Serialize as JSON
  xmlhttp.send(jsonString); // Send JSON-data to server
}

function getChatpartner() {
  const url = new URL(window.location.href);
  // Access the query parameters using searchParams
  const queryParams = url.searchParams;
  // Retrieve the value of the "friend" parameter
  const friendValue = queryParams.get("friend");
  console.log("Friend:", friendValue);
  return friendValue;
}
