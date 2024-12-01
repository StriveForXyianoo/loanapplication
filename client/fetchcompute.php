<?php
include "../controllers/connections.php";

if(isset($_POST['loanname'])) {
    $loanname = $_POST['loanname'];
    $amount = $_POST['amount'];
    $sql = "SELECT * FROM loanterms 
        WHERE LOANID = '$loanname' 
        AND $amount >= MINAM 
        AND $amount <= MAXAM";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    // Prepare response as JSON
    echo json_encode([
        "CCMINAM" => $row["MINAM"],
        "CCMAXAM" => $row["MAXAM"],
        "TERM" => $row["TERMS"]
    ]);
}
?>
