<?php



require_once 'vendor/autoload.php';

require_once 'config.php';

 

$client = new Google_Client();

$client->setClientId($clientID);

$client->setClientSecret($clientSecret);

$client->setRedirectUri($redirectUri);

$client->addScope("email");

$client->addScope("profile");


echo "<script> document.location.href='"."$client->createAuthUrl()"."';</script>";