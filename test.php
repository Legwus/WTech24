
<?php
require("start.php");
$json = json_encode($user);
echo $json . "<br><br>";
$jsonObject = json_decode($json);
$newUser = Model\User::fromJson($jsonObject);
var_dump($newUser);
?>
<br><br>
<?php

$service = new Utils\BackendService(CHAT_SERVER_URL, CHAT_SERVER_ID);
var_dump($service->test());
?>
<br><br>
<?php
var_dump($service->register("Test123", "12345678"));

?>
<br><br>
<?php
var_dump($service->login("Test123", "12345678"));
?>
<br><br>
<?php
//$user->setBio("asfd");
//$user->setUsername("User123");
$service->saveUser($user);
var_dump($service->loadUser("Test123"));
?>
<br><br>

