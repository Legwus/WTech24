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
        if ($friend['status'] === 'accepted') {
            echo '<li>';
            echo '<a href="chat.html?friend=' . htmlspecialchars($friend['username']) . '">';
            echo htmlspecialchars($friend['username']);
            echo '</a>';
            if ($friend['unread'] > 0) {
                echo '<span class="notification-border">' . htmlspecialchars($friend['unread']) . '</span>';
            }
            echo '</li>';
        }
    }
    echo '</ul>';

    // Generate HTML output for friend requests
    echo '<ul id="friendRequestList">';
    foreach ($friends as $friend) {
        if ($friend['status'] === 'requested') {
            echo '<li class="align-to-the-left">';
            echo 'Friend Request from <strong>' . htmlspecialchars($friend['username']) . '</strong>';
            echo '<button class="nicebutton rounded-corners justbluebkgrd" onclick="acceptFriend(\'' . htmlspecialchars($friend['username']) . '\')">Accept</button>';
            echo '<button class="nicebutton rounded-corners" onclick="rejectFriend(\'' . htmlspecialchars($friend['username']) . '\')">Reject</button>';
            echo '</li>';
        }
    }
    echo '</ul>';
} else {
    echo '<p>No friends found.</p>';
}
//http_response_code($friends ? 200 : 404);
