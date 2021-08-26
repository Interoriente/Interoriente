<?php
/* INICIO Codigo de Google*/
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
  // INFORMACION CAPTURADA EN VARIABLES PHP
  $email =  $google_account_info->email;
  $name =  $google_account_info->name;
  $familyName =  $google_account_info->familyName;
  $picture =  $google_account_info->picture;
  $givenName =  $google_account_info->givenName;
  $gender =  $google_account_info->gender;
  $id =  $google_account_info->id;
  $locale =  $google_account_info->locale;
  $verifiedEmail =  $google_account_info->verifiedEmail;

  /* FIN Codigo de Google*/
  require_once '../dao/conexion.php';

  //Capturo información
  $estado = '1';
  $sqlInicio = "SELECT*FROM tblUsuario WHERE emailUsuario=? AND estadoUsuario = ?";
  $consultaInicio = $pdo->prepare($sqlInicio);
  $consultaInicio->execute(array($email, $estado));
  $resultadoInicio = $consultaInicio->rowCount();

  if ($resultadoInicio) {
    $_SESSION["documentoIdentidad"] = $resultadoObjetoInicio->documentoIdentidad;
    //Siempre para iniciar se inicia como Comprador/Proveedor -> O por lo menos con el primer rol que se tenga
    $_SESSION['roles'] = $rol;
    //Comprador/Proveedor
    header("Location: ../../users/dashboard/principal/dashboard.php");
} else {
    echo "<script>alert('Correo o documento y/o contraseña incorrecto, o validación denegada');</script>";
    echo "<script> document.location.href='../../principal/navegacion/iniciarsesion.php';</script>";
}
  /*
  echo "Email= ".$email .'<br>';
  echo "familyName= ".$familyName .'<br>';
  echo "Name= ".$name .'<br>';
  echo "Picture= ".$picture .'<br>';
  echo "Given Name= ".$givenName .'<br>';
  echo "Gender= ".$gender .'<br>';
  echo "Id= ".$id .'<br>';
  echo "Locale= ".$locale .'<br>';
  echo "Verified Email= ".$verifiedEmail .'<br>';
  */
}  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciando Sesion...</title>
</head>
<body>
  
</body>
</html>