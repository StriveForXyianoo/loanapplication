<?php
require '../../controllers/connections.php';


if(isset($_POST['cancelthisid'])){
    $id = mysqli_real_escape_string($conn, $_POST['cancelthisid']);
    $status = 'CANCELLED';
    $sql = "UPDATE clientloan SET `STATUS` = '$status' WHERE ID = '$id'";
    $query = mysqli_query($conn, $sql);
    if($query){
        echo 'success';
    }else{
        echo 'failed';
    }
}
?>