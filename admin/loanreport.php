<?php
require  '../vendor/autoload.php';
require '../controllers/connections.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


// Create a new spreadsheet object
$spreadsheet = new Spreadsheet();

// Get active sheet
$sheet = $spreadsheet->getActiveSheet();

// Set some data in the sheet
$sheet->setCellValue('A1', 'Client Name');
$sheet->setCellValue('B1', 'Department');
$sheet->setCellValue('C1', 'Position');
$sheet->setCellValue('D1', 'Loan Type');
$sheet->setCellValue('E1', 'Loan Name');
$sheet->setCellValue('F1', 'Loan Amount');
$sheet->setCellValue('G1', 'Total Payment');
$sheet->setCellValue('H1', 'Loan Balance');
$sheet->setCellValue('I1', 'Loan Date');
$sheet->setCellValue('J1', 'Loan Status');

// Make the header bold
$sheet->getStyle('A1:J1')->getFont()->setBold(true);

// Add border to the header (bottom, right, left, and top)
$sheet->getStyle('A1:J1')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

$excelRow = 2;  // Start from row 2 for data
$sql = "SELECT * FROM clientloan WHERE `STATUS`='APPROVED' OR `STATUS`='DONE'";
$result = $conn->query($sql);

// Check if the query was successful
if ($result && $result->num_rows > 0) {
    while ($loan = $result->fetch_assoc()) {  // Loop through loan records
        $clientid = $loan['CLIENTID'];
        $loanid = $loan['LOANID'];
        $lid = $loan['ID'];

        // Fetch client information
        $csql = "SELECT * FROM clientinformation WHERE ID=?";
        $stmt = $conn->prepare($csql);
        $stmt->bind_param('i', $clientid);
        $stmt->execute();
        $cresult = $stmt->get_result();

        if ($cresult && $cresult->num_rows > 0) {
            $cdata = $cresult->fetch_assoc();
            // Format the client's full name
            $fullname = $cdata['FIRSTNAME'] . ' ' . ($cdata['MIDDLENAME'] ? $cdata['MIDDLENAME'] . ' ' : '') . $cdata['LASTNAME'];

            // Populate the spreadsheet with client data
            $sheet->setCellValue('A' . $excelRow, $fullname);
            $sheet->setCellValue('B' . $excelRow, $cdata['DEPARTMENT']);
            $sheet->setCellValue('C' . $excelRow, $cdata['POSITION']);
        }
        $sheet->setCellValue('F' . $excelRow, number_format($loan['LOANAMOUNT'], 2));

        // Fetch loan type
        $ltpsql = "SELECT * FROM loantype WHERE ID=?";
        $stmt = $conn->prepare($ltpsql);
        $stmt->bind_param('i', $loanid);
        $stmt->execute();
        $ltpresult = $stmt->get_result();

        if ($ltpresult && $ltpresult->num_rows > 0) {
            $ltpdata = $ltpresult->fetch_assoc();
            $sheet->setCellValue('D' . $excelRow, $ltpdata['TPID']);
            $sheet->setCellValue('E' . $excelRow, $ltpdata['LOANTYPE']);
        }

        // Fetch total payment
        $psql = "SELECT SUM(AMOUNT) AS TOTALPAYMENT FROM paymentloan WHERE LOANID=?";
        $stmt = $conn->prepare($psql);
        $stmt->bind_param('i', $lid);
        $stmt->execute();
        $presult = $stmt->get_result();

        if ($presult && $presult->num_rows > 0) {
            $pdata = $presult->fetch_assoc();
            $sheet->setCellValue('G' . $excelRow, number_format($pdata['TOTALPAYMENT'], 2));
        }

        // Calculate loan balance
        $balance = $loan['LOANAMOUNT'] - ($pdata['TOTALPAYMENT'] ?? 0);
        $sheet->setCellValue('H' . $excelRow, number_format($balance, 2));

        // Set loan date and status
        $sheet->setCellValue('I' . $excelRow, $loan['LOANDATE']);
        $sheet->setCellValue('J' . $excelRow, $loan['STATUS']);

        // Increment the row for the next entry
        $excelRow++;
    }
} else {
    echo "No loan records found.";
}

//make the column auto size
foreach (range('A', 'J') as $columnID) {
    $sheet->getColumnDimension($columnID)->setAutoSize(true);
}
//add border to the data
$sheet->getStyle('A1:J' . ($excelRow - 1))->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);




$writer = new Xlsx($spreadsheet);

// Set the appropriate headers to force download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="loanreport.xlsx"');
header('Cache-Control: max-age=0');

// Save the file to output (this triggers the download)
$writer->save('php://output');