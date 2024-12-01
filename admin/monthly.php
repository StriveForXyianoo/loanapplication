<?php
// Database connection
include '../controllers/connections.php';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch monthly collections
    $stmt = $pdo->prepare("
        SELECT 
    DATE_FORMAT(DATEPAYMENT, '%b %Y') AS month, -- Format date as 'Nov 2024'
    SUM(amount) AS total_collections
FROM 
    paymentloan
GROUP BY 
    DATE_FORMAT(DATEPAYMENT, '%b %Y') -- Group by formatted month
ORDER BY 
    MIN(DATEPAYMENT) ASC; -- Ensure chronological order
");
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Output data as JSON
    echo json_encode($data);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
