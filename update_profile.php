<?php
session_start();
// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Database connection parameters
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'hotel';

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and get the updated form values
    $firstName = $conn->real_escape_string($_POST['firstName']);
    $lastName = $conn->real_escape_string($_POST['lastName']);
    $email = $conn->real_escape_string($_POST['email']);
    $mobile_number = $conn->real_escape_string($_POST['mobile_number']);
    $address = $conn->real_escape_string($_POST['address']);

    // Get the user ID from the session
    $email = $_SESSION['email'];

    // Update the user details in the database
    $update_query = "UPDATE users SET firstName = '$firstName', lastName = '$lastName', email = '$email', mobile_number = '$mobile_number', address = '$address' WHERE email = '$email'";

    if ($conn->query($update_query) === TRUE) {
        // Update session variables if successful
        $_SESSION['firstName'] = $firstName;
        $_SESSION['lastName'] = $lastName;
        $_SESSION['email'] = $email;
        $_SESSION['mobile_number'] = $mobile_number;
        $_SESSION['address'] = $address;

        // Redirect back to the profile page
        header("Location: profile.php");
        exit();
    } else {
        echo "Error: " . $update_query . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>