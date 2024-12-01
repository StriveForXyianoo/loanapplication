<?php
include '../../controllers/connections.php';
session_start();
if(isset($_POST['user'])){
    $user = mysqli_real_escape_string($conn, $_POST['user']);
    $sql = "DELETE FROM `users` WHERE `ID` = '$user'";
    $query = mysqli_query($conn, $sql);
    if($query){
        echo 'success';
    }else{
        echo 'error';
    }
}