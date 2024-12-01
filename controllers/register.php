<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json'); // Ensure the response is in JSON format
echo json_encode([
    'status' => 'success',
    'message' => 'Registration successful'
]);

include 'connections.php';
session_start();



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
$requestBody = file_get_contents('php://input');
$data = json_decode($requestBody, true);

// Check if the form is submitted and face descriptor is sent
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you are handling the form data and file upload properly

    // Retrieve the faceDescriptor from the POST data
    if (isset($_POST['faceDescriptor'])) {
        // Decode the face descriptor from JSON
        $faceDescriptor = json_decode($_POST['faceDescriptor']);

        // Store the faceDescriptor in a session variable
        $_SESSION['faceDescriptor'] = $faceDescriptor;

        // Log the face descriptor (for debugging purposes)
        var_dump($faceDescriptor);
        exit();
    } else {
        echo "Face descriptor not received.";
    }
} else {
    // Handle the case where the form is not submitted properly
    echo "Invalid request method.";
}


// Check if the form is submitted
if (isset($_POST['register'])) {
    // Sanitize user inputs
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $mname = mysqli_real_escape_string($conn, $_POST['mname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $bdate = mysqli_real_escape_string($conn, $_POST['bdate']);
    $civilstatus = mysqli_real_escape_string($conn, $_POST['civilstatus']);
    $position = mysqli_real_escape_string($conn, $_POST['position']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $salary = mysqli_real_escape_string($conn, $_POST['salary']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $years = mysqli_real_escape_string($conn, $_POST['years']);

    // Validate and process file uploads
    $documentphoto = $_FILES['documentphoto']['name'];
    $capture = $_FILES['capture']['name'];

    $docExt = pathinfo($documentphoto, PATHINFO_EXTENSION);
    $capExt = pathinfo($capture, PATHINFO_EXTENSION);

    $docName = uniqid() . "." . $docExt;
    $capName = uniqid() . "." . $capExt;

    $targetDoc = "../uploads/documents/" . $docName;
    $targetCap = "../uploads/images/" . $capName;

    if (!move_uploaded_file($_FILES['documentphoto']['tmp_name'], $targetDoc) || !move_uploaded_file($_FILES['capture']['tmp_name'], $targetCap)) {
        error_log("Error uploading files");
        $_SESSION['status'] = "error";
        $_SESSION['message'] = "Failed to upload files";
        header('Location: ../login');
        exit();
    }


    // Encode face descriptor as JSON
    $faceDescriptorJson = json_encode($_SESSION['faceDescriptor']);
    if (json_last_error() !== JSON_ERROR_NONE) {
        error_log("JSON encoding error: " . json_last_error_msg());
        $_SESSION['status'] = "error";
        $_SESSION['message'] = "Failed to encode face descriptor.";
        header('Location: ../login');
        exit();
    }


    // Check for duplicate email
    $sql = "SELECT * FROM clientinformation WHERE EMAIL = '$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['status'] = "error";
        $_SESSION['message'] = "Email already exists";
        header('Location: ../login');
        exit();
    }

    // Generate random password
    $passwordRaw = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
    $password = password_hash($passwordRaw, PASSWORD_DEFAULT);

    // Insert user data
    $sql = "INSERT INTO clientinformation (FIRSTNAME, MIDDLENAME, LASTNAME, GENDER, BIRTHDATE, CIVILSTATUS, CONTACTNO, POSITION, SALARY, ADDRESS, YEARS, DEPARTMENT, EMAIL, PASSWORD, REGISTRATIONSTATUS) 
            VALUES ('$fname', '$mname', '$lname', '$gender', '$bdate', '$civilstatus', '$phone', '$position', '$salary', '$address', '$years', '$department', '$email', '$password', 'PENDING')";

    if (mysqli_query($conn, $sql)) {
        $last_id = mysqli_insert_id($conn);

        // Insert files into clientimage table
        $sql2 = "INSERT INTO clientimage (CLIENT_ID, TYPE, FILEP) VALUES ('$last_id', 'VALIDID', '$docName')";
        $sql3 = "INSERT INTO clientimage (CLIENT_ID, TYPE, FILEP) VALUES ('$last_id', 'USERPIC', '$capName')";
        if (mysqli_query($conn, $sql2) && mysqli_query($conn, $sql3)) {
            // Insert face descriptor into clientface table
            $sql4 = "INSERT INTO clientface (CLIENT_ID, FACE_DESCRIPTOR) VALUES ('$last_id', '$faceDescriptorJson')";
            if (mysqli_query($conn, $sql4)) {
                // Send email to user
                $mail = new PHPMailer(true);
                try {
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'bcgempcsystem@gmail.com';
                    $mail->Password = 'sywwedtovebnweel';
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;

                    $mail->setFrom('bcgempcsystem@gmail.com', 'BCGE MPC System');
                    $mail->addAddress($email);
                    $mail->isHTML(true);
                    $mail->Subject = "Important Message: BCGE MPC System";
                    $mail->Body = "Hello $fname $lname,<br>Your password is $passwordRaw.<br>Please keep it confidential.";

                    $mail->send();

                    $_SESSION['status'] = "success";
                    $_SESSION['message'] = "Successfully Registered! Password sent to your email.";
                    header('Location: ../login');
                } catch (Exception $e) {
                    error_log("Mailer Error: " . $e->getMessage());
                    $_SESSION['status'] = "error";
                    $_SESSION['message'] = "Failed to send email.";
                    header('Location: ../login');
                }
            } else {
                error_log("Error inserting face descriptor: " . mysqli_error($conn));
                $_SESSION['status'] = "error";
                $_SESSION['message'] = "Failed to save face descriptor.";
                header('Location: ../login');
            }
        } else {
            error_log("Error inserting images: " . mysqli_error($conn));
            $_SESSION['status'] = "error";
            $_SESSION['message'] = "Failed to insert user photos.";
            header('Location: ../login');
        }
    } else {
        error_log("Error registering user: " . mysqli_error($conn));
        $_SESSION['status'] = "error";
        $_SESSION['message'] = "Failed to register user.";
        header('Location: ../login');
    }
}
