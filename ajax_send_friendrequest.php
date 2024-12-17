<?php
require "start.php";

// get the passed JSON from JS and make it readable for php since it can't properly deal with undecoded JSON
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($_SESSION['user'])) {
    http_response_code(401); // not authorized
    return;
}

// Backend aufrufen
$response = $service->friendRequest($data);
if ($response) {
    // erhaltene Friend-Objekte im JSON-Format senden 
    var_dump("Successful friendrequest!");
} else {
    var_dump("Error in friendrequest!");
    var_dump($response);
}
/* http status code setzen
 * - 200 Friends gesendet
 * - 404 Fehler
 */
//http_response_code($response ? 200 : 404);
?>