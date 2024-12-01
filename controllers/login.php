<?php
include 'connections.php';
session_start();
if(isset($_POST['signin'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM clientinformation WHERE EMAIL = '$email'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row['PASSWORD'])){
            session_start();
            $_SESSION['id'] = $row['ID'];
            $_SESSION['name'] = $row['FIRSTNAME']." ".$row['LASTNAME'];
            $_SESSION['role'] = 'client';
            header('location: ../client/');
            
        }else{
            echo "<script>alert('Invalid Password')</script>";
            echo "<script>window.location.href='../index'</script>";
        }
    }else{

        echo "<script>alert('Email does not exist')</script>";
        echo "<script>window.location.href='../index'</script>";
    }

}
?>