<?php


$friends = $service->loadFriends();

if ($friends) {
    // Generate HTML output for friends
    echo '<ul id="friendList">';
    foreach ($friends as $friend) {
        if ($friend->getStatus() === 'accepted') {

            echo '<li>';
            echo '<a href="chat.php?friend=' . htmlspecialchars($friend->getUsername()) . '">';
            echo htmlspecialchars($friend->getUsername());
            echo '</a>';
            if ($friend->getUnread() > 0) {
                echo '<span class="notification-border">' . htmlspecialchars($friend->getUnread()) . '</span>';
            }
            echo '</li>';
        }
    }
    echo '</ul>';
} else {
    echo '<p>No friends found.</p>';
}
//http_response_code($friends ? 200 : 404);
