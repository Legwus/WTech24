<?php
require "start.php";

if (!isset($_SESSION['chat_token'])) {
    http_response_code(400); // bad request
    return;
}


echo json_encode([
    'user' => $_SESSION['chat_token'] ?? null,
]);
