let loadMessageUrl = "ajax_load_messages.php"; // Updated to new endpoint
let sendMessageUrl = "ajax_send_message.php"; // Updated to new endpoint

/*let tom = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjoiVG9tIiwiaWF0IjoxNzMyNjMwMjgyfQ.R4fqhDBoT011itGxilKlo2JTK0Dj69ugs8YiJoR_DqI";
let jerry = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjoiSmVycnkiLCJpYXQiOjE3MzI2MzAyODJ9.pA9-AuP-DEuuRcYOf6Xv9oD8O3AqiFwjLh239oIJACI";

let token = jerry;*/

const friendName = document.getElementById("friendName");
setInterval(listMessages, 5000);  // Refresh messages every 5 seconds
document.addEventListener("DOMContentLoaded", () => {
  const nameFromQuery = getChatpartner();
  if (nameFromQuery) {
    friendName.innerText = nameFromQuery;
    console.log(nameFromQuery);
  }
  listMessages();  // Initial message load
  
});

function listMessages() {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      let data = JSON.parse(xmlhttp.responseText);
      const chatbox = document.getElementById("chat-container");
      const htmlMessages = data.map((x) => showMessage(x)).join("");
      chatbox.innerHTML = htmlMessages;
      chatbox.scrollTop = chatbox.scrollHeight;
    }
  };
  const nameFromQuery = getChatpartner();
  xmlhttp.open(
    "GET",
    `ajax_load_messages.php?to=${nameFromQuery}`,
    true
  );
  xmlhttp.send();
}

function showMessage(message) {
  return `<li>${message.from}: ${message.msg}</li>`;
}

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
  sendButton.disabled = value.length <= 0;
});

function resetInput() {
  sendMessage.value = "";
}

function sendMessages() {
  const nameFromQuery = getChatpartner();
  let data = {
    msg: sendMessage.value.trim(),
    to: nameFromQuery,
  };
  let xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 204) {
      console.log("Message sent");
      listMessages();  // Reload messages after sending
      resetInput();
    }
  };
  xmlhttp.open("POST", sendMessageUrl, true);
  xmlhttp.setRequestHeader("Content-type", "application/json");
  xmlhttp.send(JSON.stringify(data));
}

function getChatpartner() {
  const url = new URL(window.location.href);
  const queryParams = url.searchParams;
  const friendValue = queryParams.get("friend");
  console.log("Friend:", friendValue);
  return friendValue;
}

