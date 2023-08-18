<?php include "includes/header.php"; ?>

<?php
require_once "includes/db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password, user_type) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $user_type = "job_seeker";
    $stmt->bind_param("sss", $username, $hashed_password, $user_type);

    if ($stmt->execute()) {
        echo "Job seeker registered successfully.";

        // Redirect to the job seeker dashboard or another page
        // header("Location: job_seeker_dashboard.php");
        // exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}

$conn->close();
?>
