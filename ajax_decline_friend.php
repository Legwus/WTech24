<?php
require "start.php";

if (!isset($_GET['friendname'])) {
    http_response_code(400); // bad request
    return;
}

// Backend mit übergebenem Benutzernamen aufrufen
$exists = $service->friendDismiss($_GET['friendname']);
/* http status code setzen
 * - 204 Benutzer ex.
 * - 404 Benutzer ex. nicht
 */
http_response_code($exists ? 204 : 404);
?>