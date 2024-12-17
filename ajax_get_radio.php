<?php
require "start.php";
$phpVar = $service->loadUser($_SESSION['user'])->getRadio();

echo json_encode(['message' => "$phpVar" ?? null]);
?>