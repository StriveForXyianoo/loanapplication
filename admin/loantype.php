<?php
// Database connection
include '../controllers/connections.php';
$sql = "SELECT 
    COUNT(clientloan.ID) AS count,
    loantype.LOANTYPE 
FROM 
    clientloan
INNER JOIN 
    loantype 
    ON clientloan.LOANID = loantype.ID 
GROUP BY 
    loantype.LOANTYPE;
";
$query = mysqli_query($conn, $sql);
$data = array();
foreach ($query as $row) {
    $data[] = $row;
}
echo json_encode($data);