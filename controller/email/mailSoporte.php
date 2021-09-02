   <?php
    //Subir imágenes al servidor
    if ($_FILES['archivo']['name']) {
        $target_path = "imagenes/";
        $target_path = $target_path . basename($_FILES['archivo']['name']);
        move_uploaded_file($_FILES['archivo']['tmp_name'], $target_path);
    }



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
            $nombre = $_POST['nombre'];
            $correo = $_POST['correo'];
            $telefono = $_POST['telefono'];
            $tipo = $_POST['tipo'];
            $mensaje = $_POST['mensaje'];
            if ($_FILES['archivo']['name']) {
                $archivo = $_FILES['archivo']['name']; //Nombre del archivo
            }


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
                $mail->setFrom('interoriente437@gmail.com', $nombre);//Se debe dejar el mismo del Username
                $mail->addAddress('interoriente437@gmail.com', 'Administrador');//Correo que recibe 

                //Envío de imágenes
                if ($_FILES['archivo']['name']) {
                    //Adjuntar archivos en el correo
                    $mail->addAttachment("imagenes/$archivo");
                }
                
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
                            Pantallazo:
                        </div>
                    </div>
                    
                </body>
                
                </html>";
                //Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Soporte';
                $mail->Body    = $mensaje2;
                //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                if ($mail->send()) {
                    echo "<script>alert('Correo enviado correctamente');</script>";
                    echo "<script> document.location.href='../view/dashboard/principal/dashboard.php';</script>";
                }
            } catch (Exception $e) {
                echo 'Ha ocurrido un error! ', $mail->ErrorInfo;
            }
        } else {
            return;
        }
    } ?>