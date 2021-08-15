
    <?php


    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'phpmailer/PHPMailer/src/Exception.php';
    require 'phpmailer/PHPMailer/src/PHPMailer.php';
    require 'phpmailer/PHPMailer/src/SMTP.php';


    enviarEmail();

    function enviarEmail()
    {
        if (isset($_POST)) {
            //mandar correo
            $nombre = $_POST['nombre'];
            $correo = $_POST['correo'];
            $telefono = $_POST['telefono'];
            $tipo = $_POST['tipo'];
            $mensaje = $_POST['mensaje'];
            //$archivo = $_FILES['archivo'];

            $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
            try {
                //Server settings
                $mail->SMTPDebug = 2;                                 // Enable verbose debug output
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';                   // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'interoriente437@gmail.com';                 // SMTP username
                $mail->Password = ':$SpZ3xSeh!H';                           // SMTP password
                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                    // TCP port to connect to

                //Recipients
                $mail->setFrom($correo, 'Mailer');
                $mail->addAddress('interoriente437@gmail.com', 'Mailer');     // Add a recipient
                //$mail->addAddress('ellen@example.com');               // Name is optional
                //$mail->addReplyTo('info@example.com', 'Information');
                //$mail->addCC('cc@example.com');
                //$mail->addBCC('bcc@example.com');

                //Attachments
                $mail->addAttachment('../assets/img/10.jpg');         // Add attachments
                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

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
                            Nombre: $nombre <br>
                            Correo: $correo <br>
                            Tipo de mensaje: $tipo <br>
                            Celular: $telefono <br>
                            Mensaje: $mensaje <br>
                        </div>
                    </div>
                    
                </body>
                
                </html>";
                //Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Soporte';
                $mail->Body    = $mensaje2;
                //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                echo 'Mensaje enviado';
                echo "<script> document.location.href='../users/dashboard/principal/dashboard.php';</script>";
            } catch (Exception $e) {
                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            }
        } else {
            return;
        }
    } ?>
