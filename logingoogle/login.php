<?php

require_once 'vendor/autoload.php';

require_once 'config.php';
session_start();


$client = new Google_Client();

$client->setClientId($clientID);

$client->setClientSecret($clientSecret);

$client->setRedirectUri($redirectUri);

$client->addScope("email");

$client->addScope("profile");



if (isset($_GET['code'])) {

  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

  $client->setAccessToken($token['access_token']);



  // get profile info

  $google_oauth = new Google_Service_Oauth2($client);

  $google_account_info = $google_oauth->userinfo->get();

  $email =  $google_account_info->email;

  $name =  $google_account_info->name;
  
  $familyName =  $google_account_info->familyName;
  $picture =  $google_account_info->picture;
  $givenName =  $google_account_info->givenName;
  $gender =  $google_account_info->gender;
  $id =  $google_account_info->id;
  $locale =  $google_account_info->locale;
  $verifiedEmail =  $google_account_info->verifiedEmail;

  // Estos datos son los que obtenemos....	

  echo "Email= ".$email .'<br>';
  echo "familyName= ".$familyName .'<br>';
  echo "Name= ".$name .'<br>';
  echo "Picture= ".$picture .'<br>';
  echo "Given Name= ".$givenName .'<br>';
  echo "Gender= ".$gender .'<br>';
  echo "Id= ".$id .'<br>';
  echo "Locale= ".$locale .'<br>';
  echo "Verified Email= ".$verifiedEmail .'<br>';
  
  

}  