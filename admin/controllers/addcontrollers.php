<?php
include '../../controllers/connections.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../vendor/autoload.php';
session_start();
if(isset($_POST['user'])){
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $middlename = mysqli_real_escape_string($conn, $_POST['middlename']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    //generate 10 digit password with random characters
    $npassword = substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', mt_rand(1,10))),1,10);
    $password = password_hash($npassword, PASSWORD_DEFAULT);


    $sql = "INSERT INTO `users`(`ID`, `LASTNAME`, `FIRSTNAME`, `MIDDLENAME`, `EMAILADDRESS`, `PASSWORD`,  `ROLES`, `CONTACTNUMBER`) VALUES (NULL, '$lastname', '$firstname', '$middlename', '$email', '$password', '$role', '$contact')";
    $query = mysqli_query($conn, $sql);
    if($query){
        $mail = new PHPMailer(true);
        try{
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'bcgempcsystem@gmail.com';
            $mail->Password   = 'sywwedtovebnweel';                               // SMTP password
            $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = 587;                                    // TCP port to connect to
            $subject = 'Account Password';
            $body = "Hello $firstname $middlename $lastname, <br> Your account password is $npassword";
            $mail->setFrom('bcgempcsystem@gmail.com', 'BCGE MPC System');
            $mail->addAddress($email);     // Add a recipient
            //send
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;
            $mail->send();

            $_SESSION['msgstatus'] = 'success';
            $_SESSION['msg'] = 'User added successfully';
            header('location: ../user');
        }catch(Exception $e){
            $_SESSION['msgstatus'] = 'error';
            $_SESSION['msg'] = 'Message could not be sent. Password not sent to email : '.$npassword;
            
        }
        
    }else{
        $_SESSION['msgstatus'] = 'error';
        $_SESSION['msg'] = 'Failed to add user';    
        header('location: ../user');
    }
}
?>