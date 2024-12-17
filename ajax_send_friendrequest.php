<?php
require "start.php";



if (!isset($_POST['username'])) {
    http_response_code(401); // not authorized
    //var_dump($_POST);
    return;
} else {
  
}
//+ $_POST['username']
// Backend aufrufen
$response = $service->friendRequest(array("username" => $_POST['username']));
if ($response) {
    var_dump($response);	
    
} else {
  
}
/* http status code setzen
 * - 200 Friends gesendet
 * - 404 Fehler
 */
//http_response_code($response ? 200 : 404);
?>