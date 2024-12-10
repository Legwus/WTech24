<?php
require "start.php";

if (!isset($_SESSION['user'])) {
    http_response_code(400); // bad request
    return;
}

echo json_encode([
    'user' => $_SESSION['user'] ?? null,
]);

?>