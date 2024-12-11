<?php
require "start.php";



if (!isset($_POST['username'])) {
    http_response_code(401); // not authorized
    var_dump($_POST);
    return;
} else {
    console.log("Success");
}

// Backend aufrufen
$response = $service->friendRequest($_POST['username']);
if ($response) {
    // erhaltene Friend-Objekte im JSON-Format senden 
    console.log("Successful friendrequest!");
} else {
    console.log("Error within friendrequest!");
}
/* http status code setzen
 * - 200 Friends gesendet
 * - 404 Fehler
 */
//http_response_code($response ? 200 : 404);
?>