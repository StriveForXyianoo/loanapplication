<?php
include '../../controllers/connections.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../vendor/autoload.php';
session_start();
if(isset($_POST['updatestatus'])){
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $remark = mysqli_real_escape_string($conn, $_POST['remark']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $sql = "UPDATE `clientinformation` SET `REGISTRATIONSTATUS`='$status'WHERE `ID` = '$id'";
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
            $mail->Port       = 587;  

            $subject = 'Account Status';
            $body = "Hello $name, <br> Your account status is $status <br> Remark: $remark <br>";
            $mail->setFrom('bcgempcsystem@gmail.com', 'BCGE MPC System');
            $mail->addAddress($email);     // Add a recipient
            //send
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;
            $mail->send();

            $_SESSION['msgstatus'] = 'success';
            $_SESSION['msg'] = 'Status updated successfully';
            

        }catch(Exception $e){
            $_SESSION['msgstatus'] = 'error';
            $_SESSION['msg'] = 'Message could not be sent. Status not sent to email: ' . $e->getMessage();

        }
    }else{
        $_SESSION['msgstatus'] = 'error';
        $_SESSION['msg'] = 'Failed to update status';
    }
    header('location: ../client');
}
?>