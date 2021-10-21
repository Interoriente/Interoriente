<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'phpmailer/Exception.php';
    require 'phpmailer/PHPMailer.php';
    require 'phpmailer/SMTP.php';


    enviarEmail();

    function enviarEmail()
    {
        if (isset($_POST)) {
            //mandar correo
            $correo = $_POST['correo'];
            
            $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
            try {
                //Server settings
                $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';                   // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'interoriente437@gmail.com';                 // SMTP username
                $mail->Password = ':$SpZ3xSeh!H';                           // SMTP password
                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                    // TCP port to connect to

                //Recipients
                $mail->setFrom('interoriente437@gmail.com', '');//Se debe dejar el mismo del Username
                $mail->addAddress($correo, ' ');//Correo que recibe 

                $mensaje2 = "<!DOCTYPE html>
                <html lang='en'>
                
                <head>
                    <meta charset='UTF-8'>
                    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>Document</title>
                
                <style>
                    .container {
                        background-color: #004E64;
                        width: 90%;
                    }
                
                    .mensaje {
                        font-size: 20px;
                        text-align: center;
                        color: white;
                    }
                </style>
                </head>
                
                <body>
                    <div class='container'>
                        <div class='mensaje'>
                            Correo: $correo <br>
                            Prueba 123
                        </div>
                    </div>
                    
                </body>
                
                </html>";
                //Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Soporte';
                $mail->Body    = $mensaje2;

                if ($mail->send()) {
                    echo "<script>alert('Correo enviado correctamente');</script>";
                    echo "<script> document.location.href='../../Views/navegacion/iniciarsesion.php';</script>";
                }
            } catch (Exception $e) {
                echo "<script>alert('Ha ocurrido un error! $mail->ErrorInfo');</script>";
            }
        } else {
            return false;
        }
    }
    ?>
