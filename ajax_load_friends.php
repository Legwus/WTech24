<?php
require "start.php";

if (!isset($_SESSION['user'])) {
    http_response_code(401); // not authorized
    return;
}

// Backend aufrufen
$friends = $service->loadFriends();
if ($friends) {
    // erhaltene Friend-Objekte im JSON-Format senden 
    echo json_encode($friends);
}
/* http status code setzen
 * - 200 Friends gesendet
 * - 404 Fehler
 */

if ($friends) {
    // Generate HTML output for friends
    echo '<ul id="friendList">';
    foreach ($friends as $friend) {
        if ($friend->getStatus() === 'accepted') {
            echo '<li>';
            echo '<a href="chat.html?friend=' . htmlspecialchars($friend->getUsername()) . '">';
            echo htmlspecialchars($friend->getUsername());
            echo '</a>';
            if ($friend->getUnread() > 0) {
                echo '<span class="notification-border">' . htmlspecialchars($friend->getUnread()) . '</span>';
            }
            echo '</li>';
        }
    }
    echo '</ul>';

    // Generate HTML output for friend requests
    echo '<ul id="friendRequestList">';
    foreach ($friends as $friend) {
        if ($friend->getStatus() === 'requested') {
            echo '<li class="align-to-the-left">';
            echo 'Friend Request from <strong>' . htmlspecialchars($friend->getUsername()) . '</strong>';
            echo '<button class="nicebutton rounded-corners justbluebkgrd" onclick="acceptFriend(\'' . htmlspecialchars($friend->getUsername()) . '\')">Accept</button>';
            echo '<button class="nicebutton rounded-corners" onclick="rejectFriend(\'' . htmlspecialchars($friend->getUsername()) . '\')">Reject</button>';
            echo '</li>';
        }
    }
    echo '</ul>';
} else {
    echo '<p>No friends found.</p>';
}
//http_response_code($friends ? 200 : 404);
