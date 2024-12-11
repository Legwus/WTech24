<?php
if (!isset($_SESSION['user'])) {
    http_response_code(401); // not authorized
    return;
}

// Backend aufrufen
$friends = $service->loadFriends();
/* http status code setzen
 * - 200 Friends gesendet
 * - 404 Fehler
 */

if ($friends) {
    // Generate HTML output for friend requests
    echo '<ul id="friendRequestList">';
    foreach ($friends as $friend) {
        if ($friend->getStatus() === 'requested') {
            echo '<li class="align-to-the-left">';
            echo 'Friend Request from <strong>' . htmlspecialchars($friend->getUsername()) . '</strong>';
            echo '<button class="nicebutton rounded-corners justbluebkgrd" onclick="handleFriendRequest(\'' . htmlspecialchars($friend->getUsername()) . '\', true)">Accept</button>';
            echo '<button class="nicebutton rounded-corners" onclick="handleFriendRequest(\'' . htmlspecialchars($friend->getUsername()) . '\', false)">Reject</button>';
            echo '</li>';
        }
    }
    echo '</ul>';
} else {
    echo '<p>No friends requests found.</p>';
}

$token = $_SESSION['chat_token'];
//$beCollectionId = $_SESSION['chat_token'];

echo <<<EOL
    <script>
        function handleFriendRequest(username, accepted) {
            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 204) {
                    console.log("Accepted...");
                }
            };
            xmlhttp.open("PUT", "https://online-lectures-cs.thi.de/chat/132d33f2-44cf-45e1-9e85-e9da1b64102b/friend/"+username, true);
            xmlhttp.setRequestHeader('Content-type', 'application/json');
            xmlhttp.setRequestHeader('Authorization', 'Bearer {$token}');
            const status = accepted ? "accepted" : "dismissed";
            let data = { status };

            let jsonString = JSON.stringify(data);
            xmlhttp.send(jsonString);
               setTimeout(() => {
            window.location.reload();
        }, 1000);
        }
    </script>
EOL;
