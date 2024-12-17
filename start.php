<?php
spl_autoload_register(function ($class) {
    include str_replace('\\', '/', $class) . '.php';
});

session_start();

define('CHAT_SERVER_URL', 'https://online-lectures-cs.thi.de/chat/');
define('CHAT_SERVER_ID', '132d33f2-44cf-45e1-9e85-e9da1b64102b'); # Ihre Collection ID
$service = new Utils\BackendService(CHAT_SERVER_URL, CHAT_SERVER_ID);
