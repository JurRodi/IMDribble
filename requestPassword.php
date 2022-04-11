<?php 

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    include_once(__DIR__. "/bootstrap.php");

    if(isset($_POST['email'])){
        $email = $_POST['email'];

        $code = uniqid(true);
        $conn = Db::getConnection();
        $statement = $conn->prepare("insert into resetPassword (email, code) values (:email, :code)");
        $statement->bindValue(":email", $email);
        $statement->bindValue(":code", $code);
        $statement->execute();


        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings 
            $mail->isSMTP();                                        //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                   //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                               //Enable SMTP authentication
            $mail->Username   = 'IMDribble22@gmail.com';                      //SMTP username
            $mail->Password   = '2VcMrvzp5cWd@E64K#Mh';                         //SMTP password
            $mail->SMTPSecure = 'tls';                              //Enable implicit TLS encryption
            $mail->Port       = 587;                                //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('rodijurrien@gmail.com', 'IMDribble');
            $mail->addAddress($email);
            $mail->addReplyTo('no-reply@gmail.com', 'No reply');

            //Content
            $url = "http://localhost/IMDribble/resetPassword.php?code=$code";
            $mail->isHTML(true);
            $mail->Subject = 'Reset password';
            $mail->Body    = "Click on the link to reset your password: <a href='$url'>Reset your password</a>";
            $mail->AltBody = "Click on the link to reset your password: $url";

            $mail->send();
            echo 'Reset password link has been sent to your email'; 
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        exit();
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMDribble</title>
</head>
<body>
    <form action="" method="POST">
        <input type="text" name="email" placeholder="Your email">
        <input type="submit" name="submit" value="Reset password">
    </form>
</body>
</html>