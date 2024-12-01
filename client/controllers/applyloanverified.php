<?php
session_start();
require '../../controllers/connections.php';
$id = $_GET['specialorder'];
//check the specialorder if it is existing
$sql =   "SELECT * FROM clientloanpresubmit WHERE SPECIALORDER = '$id'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) <= 0){
    $_SESSION['status'] = 'error';
    $_SESSION['msg'] = 'Please Do not edit the special order number on the URL';
    header('location: ../applyloan.php');
    exit;
}else{
    $row = mysqli_fetch_assoc($result);
    $clientID = $row['CLIENTID'];
    $loanID = $row['LOANID'];
    $amount = $row['LOANAMOUNT'];
    $term = $row['TERM'];
    $interest = $row['INTEREST'];
    $cbu = $row['CBU'];
    $filling = $row['FILLING'];
    $insurance = $row['INSURANCE'];
    $netpro = $row['NETPRO'];

    $sql = "INSERT INTO `clientloan`(`ID`, `CLIENTID`, `LOANID`, `LOANAMOUNT`, `TERM`, `INTEREST`, `CBU`, `FILLING`, `INSURANCE`, `NETPRO`, `LOANDATE`, `STATUS`, `UPDATEBY`) VALUES (NULL,'$clientID','$loanID','$amount','$term','$interest','$cbu','$filling','$insurance','$netpro',NOW(),'PENDING','')";
    $query = mysqli_query($conn, $sql);
    if($query){
        $sql = "DELETE FROM clientloanpresubmit WHERE SPECIALORDER = '$id'";
        $query = mysqli_query($conn, $sql);
        if($query){
            $_SESSION['status'] = 'success';
            $_SESSION['msg'] = 'Loan application submitted';
            
            //get the all admin contact
            $sql = "SELECT * FROM users WHERE ROLES = 'ADMIN'";
            $result = mysqli_query($conn, $sql);
            foreach($result as $row){
                $contact = $row['CONTACTNUMBER'];
                $ch = curl_init();
                $parameters = array(
                    'apikey' => '0f95574de5d22ac18e50ef1b38f0b539', //Your API KEY
                    'number' => $contact,
                    'message' => 'New loan application has been submitted. Please check the admin panel for approval.',
                    'sendername' => 'TRIPLEJ'
                );
                curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/priority' );
                curl_setopt( $ch, CURLOPT_POST, 1 );

                //Send the parameters set above with the request
                curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );

                // Receive response from server
                curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
                $output = curl_exec( $ch );
                curl_close ($ch);

                //Show the server response
            }

            header('location: ../applyloan.php');

            exit;
        }else{
            $_SESSION['status'] = 'error';
            $_SESSION['msg'] = 'Failed to submit loan application';
            header('location: ../applyloan.php');
            exit;
        }
    }else{
        $_SESSION['status'] = 'error';
        $_SESSION['msg'] = 'Failed to submit loan application';
        header('location: ../applyloan.php');
        exit;
    }
    
}

?>