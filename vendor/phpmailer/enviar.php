<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require './phpmailer/src/PHPMailer.php';
    require './phpmailer/src/SMTP.php';
    require './phpmailer/src/Exception.php';

    $names = trim($_POST['names']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    if ($names != null && $email != null && $subject != null && $message != null) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $mail = new PHPMailer(true); // Passing true enables exceptions
            //Server settings
            $mail->SMTPDebug = 2; // Enable verbose debug output
            $mail->isSMTP(); // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = 'pablorincones95@gmail.com'; // SMTP username
            $mail->Password = 'v--24418291'; // SMTP password
            $mail->SMTPSecure = 'tls'; // Enable TLS encryption, ssl also accepted
            $mail->Port = 587; // TCP port to connect to

            //Recipients
            $mail->setFrom($email, $names);
            $mail->addAddress('pablorincones95@gmail.com');     // Add a recipient
            $mail->addReplyTo($email, $names);
            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Formulario de contacto de control de ratones';
            $mail->Body = "
                <div>
                    <p>Nombre: {$_POST['names']} </p>
                    <p>Asunto: {$_POST['subject']} </p>
                    <p>Mensaje: {$_POST['message']} </p>
                </div>
            ";
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            if ($mail->send()) { 
                $success = 'success';
                $msg = 'Formulario Enviado, gracias';
                http_response_code(200);
            } else {
                http_response_code(500);
                echo "A ocurrido un error intente mas tarde";
            }
        } else {
            $success = 'false';
            $msg = 'Correo invalido';
        }
    } else {
        $success = 'success';
        $msg = 'Complete el formulario';
    }

    $data = array(
        'success' => $success,
        "msg" => $msg
    );
    echo json_encode($data);

   /* $mail = new PHPMailer(true); // Passing true enables exceptions
    try {
        //Server settings
        $mail->SMTPDebug = 2; // Enable verbose debug output
        $mail->isSMTP(); // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'pablorincones95@gmail.com'; // SMTP username
        $mail->Password = 'v--24418291'; // SMTP password
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption, ssl also accepted
        $mail->Port = 587; // TCP port to connect to

        //Recipients
        $mail->setFrom("{$_POST['email']}", "{$_POST['names']}");
        $mail->addAddress('pablorincones95@gmail.com');     // Add a recipient
        //$mail->addAddress('ellen@example.com');               // Name is optional
        //$mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Formulario de contacto de control de ratones';
        $mail->Body = "
            <div>
                <p>Nombre: {$_POST['names']} </p>
                <p>Asunto: {$_POST['subject']} </p>
                <p>Mensaje: {$_POST['message']} </p>
            </div>
        ";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        if ($mail->send()) { 
            $success = 'correo enviado';
            $book = array(
                "title" => "JavaScript: The Definitive Guide",
                "author" => "David Flanagan",
                "edition" => 6
            );
            echo json_encode($book);
        } else {
            $error = 'a ocurrido un error';
        }
        
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }*/

?>