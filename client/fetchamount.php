<?php
include "../controllers/connections.php";
if(isset($_POST['loanname'])) {
    $loanname = $_POST['loanname'];
    $sql = "SELECT * FROM loantype WHERE ID = '$loanname'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    echo "The loan amount available are minimum of ₱ ".number_format($row['MINAM'], 2)." and maximum of ₱ ".number_format($row['MAXAM'], 2);

}

?>