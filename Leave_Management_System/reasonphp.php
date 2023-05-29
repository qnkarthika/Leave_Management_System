<?php
$server_name = "localhost";
$username = "root";
$password = "";
$database_name = "reason_page";

$conn = mysqli_connect($server_name, $username, $password, $database_name);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $first_name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $reason = mysqli_real_escape_string($conn, $_POST['reason']);

    $sql_query = "INSERT INTO reason (user_name, email_id, reason_for) VALUES ('$first_name', '$email', '$reason')";

    if (mysqli_query($conn, $sql_query)) {
         header("Location: sign_inn.php");
         exit();
    } else {
        echo "Error: " . $sql_query . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
