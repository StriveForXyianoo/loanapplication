<?php
require '../../controllers/connections.php';
if(isset($_POST['benefile'])){
    $clientid = $_POST['id'];
    $name1 = mysqli_real_escape_string($conn,$_POST['name1']);
    $relationship1 = mysqli_real_escape_string($conn,$_POST['relationship1']);
   

    $name2 = mysqli_real_escape_string($conn,$_POST['name2']);
    $relationship2 = mysqli_real_escape_string($conn,$_POST['relationship2']);
    

    $name3 = mysqli_real_escape_string($conn,$_POST['name3']);
    $relationship3 = mysqli_real_escape_string($conn,$_POST['relationship3']);
    

    $sql = "INSERT INTO `clientbeneficiary`(`CLIENTID`, `BENEFICIARY`, `RELATIONSHIP`) VALUES 
    ('$clientid','$name1','$relationship1'),
    ('$clientid','$name2','$relationship2'),
    ('$clientid','$name3','$relationship3')";
    $result = mysqli_query($conn,$sql);
    if($result){
        ?>
        <script>
            alert('Success')
            window.location.href="../bene"
        </script>
        <?php
    }else{
        ?>
        <script>
            alert('Failed')
            window.location.href="../bene"
        </script>
        <?php
    }
    


}
?>