<?php
include "../controllers/connections.php";

if(isset($_POST['loanname'])) {
    $loanname = $_POST['loanname'];
    $sql = "SELECT * FROM loantype WHERE ID = '$loanname'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    // Prepare response as JSON
    echo json_encode([
        "FITT" => $row["FITT"],
        "MAXAM" => $row["MAXAM"]
    ]);
}
?>
