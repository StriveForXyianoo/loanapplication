<?php
require '../vendor/autoload.php';
require '../controllers/connections.php';
$rows = '';
$sql = "SELECT clientinformation.*,clientloan.*,clientloan.ID as LOID,loantype.* FROM clientinformation INNER JOIN clientloan ON clientinformation.ID = clientloan.CLIENTID INNER JOIN loantype ON clientloan.LOANID = loantype.ID";
$result = $conn->query($sql);
if(mysqli_num_rows($result)>0){
    foreach($result as $row){
        if($row['MIDDLENAME']==''){
            $name = $row['FIRSTNAME'].' '.$row['LASTNAME'];
        }else{
            $name = $row['FIRSTNAME'].' '.$row['MIDDLENAME'].' '.$row['LASTNAME'];
        }
        $rows .= '<tr>
            <td>'.$name.'</td>
            <td>'.$row['DEPARTMENT'].'</td>
            <td>'.$row['POSITION'].'</td>
            <td>'.$row['LOANTYPE'].'</td>
            <td>'.$row['LOANAMOUNT'].'</td>
            <td>'.$row['STATUS'].'</td>
        </tr>';
    }

}else{
    $rows = '<tr><td colspan="6" class="text-center">No data found</td></tr>';
}

// Create an instance of mPDF make it long then landscape
$mpdf = new \Mpdf\Mpdf([
    'mode' => 'utf-8',
    'format' => 'A4-L'
]);
$logoSrc   = "../1BGC.jpg";
// Write some HTML content
$html = "
<!DOCTYPE html>
<html>
<head>
    <style>
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 100px; /* Adjust logo size */
            height: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        img {
            width: 100px;
            height: auto;
        }
    </style>
</head>
<body>
    <div class='header'>
        <img src='$logoSrc' alt='Company Logo'>
        <h2>Client Reports</h2>
    </div>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Department</th>
                <th>Position</th>
                <th>Loan Type</th>
                <th>Approved Loan</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            $rows
        </tbody>
    </table>
</body>
</html>
";

// Write the HTML content to the PDF
$mpdf->WriteHTML($html);

// Output the PDF

// Output the PDF
$mpdf->Output('MyPDF.pdf', 'I');
?>