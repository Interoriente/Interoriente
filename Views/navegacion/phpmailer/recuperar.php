<?php
$destinatario = $_POST['id'];
// echo $destinatario . "<br>";
require '../../../Models/dao/conexion.php';
// $sql = "SELECT contrasenaUsuario FROM tblUsuario WHERE emailUsuario='$destinatario'";
// $query = $pdo->prepare($sql);
// $query->execute();
// $results = $query->fetch(PDO::FETCH_ASSOC);
$contraseña = substr(md5(uniqid()), 0, 10);


$sql = "UPDATE tblUsuario SET contrasenaUsuario=? WHERE emailUsuario=?";
$pdo->prepare($sql)->execute([$contraseña, $destinatario]);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output

    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    //$mail->   isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'kevinarismendy21@gmail.com';                     //SMTP username
    $mail->Password   = 'NFSelrey2104';                               //SMTP password
    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('kevinarismendy21@gmail.com', 'InterOriente');
    $mail->addAddress($destinatario);     //Add a recipient
    //$mail->addAddress('ellen@example.com');               //Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Recuperar contraseña | InterOriente';
    $mail->Body    = 'Tu contraseña temporal es '. $contraseña;
    $mail->AltBody = 'Tu contraseña temporal es '. $contraseña;

    $mail->send();
    echo "<script>alert('Se ha enviado correctamente el correo, ¡revisalo!');</script>";
    echo "<script> document.location.href='../iniciarsesion.php';</script>";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
