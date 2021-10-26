<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'phpmailer/Exception.php';
    require 'phpmailer/PHPMailer.php';
    require 'phpmailer/SMTP.php';

    function enviarEmail()
    {
        if (isset($_POST)) {
            //mandar correo
            $nombre = $_POST['nombre'];
            $correo = $_POST['correo'];
            $telefono = $_POST['telefono'];
            $tipo = $_POST['tipo'];
            $mensaje = $_POST['mensaje'];


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
                $mail->setFrom('soporte@interoriente.com.co', $nombre); //Se debe dejar el mismo del Username
                $mail->addAddress('interoriente437@gmail.com', 'Administrador'); //Correo que recibe 

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
                            Buen día, ha sido creada satisfactoriamente 
                            la cuenta de Administrador en interoriente.com.co<br>
                            Puedes iniciar con el documento o correo, y con la contraseña 12345<br>
                        </div>
                    </div>
                    
                </body>
                
                </html>";
                //Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Envío contraseña cuenta creada';
                $mail->Body    = $mensaje2;
            } catch (Exception $e) {
                echo 'Ha ocurrido un error! ', $mail->ErrorInfo;
            }
        } else {
            echo "<script>alert('No existe información.');</script>";
        }
    } ?>
