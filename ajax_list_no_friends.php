<?php
$users = $service->loadUsers();
$friends = $service->loadFriends();


if ($users) {
    echo '<form id="userListForm" class="align-to-the-left" onsubmit="event => addUser(event)">';
    echo '<input class="big-textfield" type="text" id="addFriend" name="addFriend" placeholder="Add a Friend to List" list="friend-selector">';
    echo '<datalist id="friend-selector">';
    foreach ($users as $user) {

        $userInList = array_search_friend($user, $friends);
        if (!$userInList) {
            echo <<<EOL
            <option>
                {$user}
            </option>
            EOL;
        }
    }
    echo '</datalist>';
    echo '<input class="friend-add-button nicebutton rounded-corners justbluebkgrd " type="submit" value="Add" id="addButton" disabled>';
    echo '</form>';
} else {
    echo '<p>No users found.</p>';
}

function array_search_friend($user, $friends)
{
    foreach ($friends as $friend) {

        if ($friend->getUsername() === $user) {
            return true;
        }
    }
    return false;
}
$token = $_SESSION['chat_token'];

echo <<<EOL
<script>
    document.getElementById("userListForm").addEventListener("submit", (event)=> {
        event.preventDefault();
        event.stopPropagation();
        console.log(event);

        const userListForm = document.getElementById("userListForm");
        const username = document.getElementById("addFriend").value;

        let xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 204) {
            console.log("Requested...");
            }
        };
        xmlhttp.open("POST", "https://online-lectures-cs.thi.de/chat/132d33f2-44cf-45e1-9e85-e9da1b64102b/friend", true);
        xmlhttp.setRequestHeader("Content-type", "application/json");
        xmlhttp.setRequestHeader("Authorization", "Bearer {$token}");
        let data = {
            username,
        };
        let jsonString = JSON.stringify(data);
        console.log(jsonString);
        xmlhttp.send(jsonString);
        setTimeout(() => {
            window.location.reload();
        }, 1000);
        
    });

    document.getElementById("addFriend").addEventListener("input", (event)=> {
        const {value} = event.target;

        if (value.length > 0) {
            document.getElementById("addButton").disabled = false;
        } else {
            document.getElementById("addButton").disabled = true;
        }
    });
</script>
EOL;
