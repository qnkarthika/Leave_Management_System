<?php
// Database connectivity configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reason_page";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the password
    $hashedPassword = $password;

    // Perform the database insert operation
    $stmt = $conn->prepare("INSERT INTO login (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->close();

    // Redirect to success page
    header("Location: sign_inn.php");
    exit();
}

$conn->close();
?>
