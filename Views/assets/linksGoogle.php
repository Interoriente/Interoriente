<?php
require_once '../../Controllers/logingoogle/vendor/autoload.php';

require_once '../../Controllers/logingoogle/config.php';

$client = new Google_Client();

$client->setClientId($clientID);

$client->setClientSecret($clientSecret);

$client->setRedirectUri($redirectUri);

$client->addScope("email");

$client->addScope("profile");

$GoogleLogin = $client->createAuthUrl();