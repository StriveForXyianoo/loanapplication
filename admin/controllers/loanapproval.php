<?php
session_start();
include '../../controllers/connections.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../vendor/autoload.php';
$name =  $_SESSION['id'];


$status = '';
$mail = new PHPMailer(true);
$mail->isSMTP();                                            // Send using SMTP
$mail->Host       = 'smtp.gmail.com';                     // Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
$mail->Username   = 'bcgempcsystem@gmail.com';
$mail->Password   = 'sywwedtovebnweel';                               // SMTP password
$mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
$mail->Port       = 587; 


if(isset($_POST['approveid'])){
    $id = mysqli_real_escape_string($conn, $_POST['approveid']);
    $subject = 'Loan Status: Approved';
    $body = "Hello, <br> Your loan application has been approved. <br> Please wait for further instructions. <br>";
    $mail->setFrom('bcgempcsystem@gmail.com', 'BCGE MPC System');

    $sql = "
    SELECT 
        ci.EMAIL
    FROM 
        clientloan cl
    JOIN 
        clientinformation ci 
    ON 
        cl.CLIENTID = ci.ID
    WHERE 
        cl.ID = '$id'
    ";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($query);
    $email = $row['EMAIL'];
    $mail->addAddress($email);     // Add a recipient
    //send
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = $body;
    $mail->send();
    $status = 'APPROVED';
    $sql = "UPDATE clientloan SET `STATUS` = '$status',`UPDATEBY` = $name WHERE ID = '$id'";
    $query = mysqli_query($conn, $sql);
    if($query){
        echo 'success';
        $_SESSION['msgstatus'] = 'success';
        $_SESSION['msg'] = 'Loan application approved';
    }else{
        echo 'failed';
        $_SESSION['msgstatus'] = 'error';
        $_SESSION['msg'] = 'Failed to approve loan';
    }


}

if(isset($_POST['disapproveid'])){
    $id = mysqli_real_escape_string($conn, $_POST['disapproveid']);
    $subject = 'Loan Status: Disapproved';
    $body = "Hello, <br> Your loan application has been disapproved. <br> Please wait for further instructions. <br>";
    $mail->setFrom('bcgempcsystem@gmail.com', 'BCGE MPC System');

    $sql = "
    SELECT 
        ci.EMAIL
    FROM 
        clientloan cl
    JOIN 
        clientinformation ci 
    ON 
        cl.CLIENTID = ci.ID
    WHERE 
        cl.ID = '$id'
    ";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($query);
    $email = $row['EMAIL'];
    $mail->addAddress($email);     // Add a recipient
    //send
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = $body;
    $mail->send();
    $status = 'DECLINED';
    $sql = "UPDATE clientloan SET `STATUS` = '$status',`UPDATEBY` = $name WHERE ID = '$id'";
    $query = mysqli_query($conn, $sql);
    if($query){
        echo 'success';
        $_SESSION['msgstatus'] = 'success';
        $_SESSION['msg'] = 'Loan application disapproved';
    }else{
        echo 'failed';
        $_SESSION['msgstatus'] = 'error';
        $_SESSION['msg'] = 'Failed to disapprove loan';
    }


}
if(isset($_POST['doneid'])){
    $id = mysqli_real_escape_string($conn, $_POST['doneid']);
    $sql = "UPDATE clientloan SET `STATUS` = 'DONE',`UPDATEBY` = $name WHERE ID = '$id'";
    $query = mysqli_query($conn, $sql);
    if($query){
        echo 'success';
        $_SESSION['msgstatus'] = 'success';
        $_SESSION['msg'] = 'Loan payment done';
    }else{
        echo 'failed';
        $_SESSION['msgstatus'] = 'error';
        $_SESSION['msg'] = 'Failed to mark loan as done';
    }
}
if(isset($_POST['payment'])){
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $paymentdate = mysqli_real_escape_string($conn, $_POST['paymentdate']);
    $paymentamount = mysqli_real_escape_string($conn, $_POST['amount']);
    $remarks = mysqli_real_escape_string($conn, $_POST['remarks']);
    $sql = "INSERT INTO `paymentloan`(`LOANID`, `DATEPAYMENT`, `AMOUNT`, `REMARK`) VALUES ('$id','$paymentdate','$paymentamount','$remarks')";
    $query = mysqli_query($conn, $sql);
    if($query){
       
        $_SESSION['msgstatus'] = 'success';
        $_SESSION['msg'] = 'Payment added';
        header('location: ../loan_view.php?id='.$id);
    }else{
        
        $_SESSION['msgstatus'] = 'error';
        $_SESSION['msg'] = 'Failed to add payment';
        header('location: ../loan_view.php?id='.$id);
    }
    
}
?>