<?php
session_start();

// Database connection
$host = "localhost";
$user = "root";
$password = "kentuser11A@";
$dbname = "loan_system";
$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get captured face descriptor from POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $capturedDescriptor = json_decode($_POST['faceDescriptor'], true);

    if (!$capturedDescriptor) {
        echo json_encode(["status" => "error", "message" => "Invalid face descriptor."]);
        exit;
    }

    $clientId = $_SESSION['id']; // Get the client ID from the session

    // Fetch face descriptors from the database
    $query = "SELECT face_descriptor FROM clientface WHERE client_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $clientId);
    $stmt->execute();
    $result = $stmt->get_result();

    $isMatched = false;
    $threshold = 0.4; // Euclidean distance threshold for a match

    while ($row = $result->fetch_assoc()) {
        $storedDescriptor = json_decode($row['face_descriptor'], true);

        if ($storedDescriptor) {
            // Calculate Euclidean distance
            $distance = calculateEuclideanDistance($capturedDescriptor, $storedDescriptor);

            if ($distance < $threshold) {
                $isMatched = true;
                break;
            }
        }
    }

    $stmt->close();
    $conn->close();

    if ($isMatched) {
        echo json_encode(["status" => "success", "message" => "Face verified successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Face not recognized."]);
    }
}

// Function to calculate Euclidean distance
function calculateEuclideanDistance($a, $b)
{
    $sum = 0;
    for ($i = 0; $i < count($a); $i++) {
        $sum += pow($a[$i] - $b[$i], 2);
    }
    return sqrt($sum);
}
