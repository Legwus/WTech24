<?php
require "start.php";

if (!isset($_GET['user'])) {
    http_response_code(400); // bad request
    return;
}

// Backend mit übergebenem Benutzernamen aufrufen
$exists = $service->removeFriend($_GET['user']);
/* http status code setzen
 * - 204 Benutzer ex.
 * - 404 Benutzer ex. nicht
 */
    if ($exists==204) {
        header("Location: friends.php");
        exit; // Ensure no further code is executed
    }

http_response_code($exists ? 204 : 404);
?>
