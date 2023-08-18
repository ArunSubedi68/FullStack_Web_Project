<?php include "includes/header.php"; ?>

<?php
require_once "includes/db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jobId = $_POST["jobId"];
    $fullName = $_POST["fullName"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $job_seeker_id = $_POST["job_seeker_id"];
    // Insert the job application into the applications table
    $sql = "INSERT INTO applications (job_id, job_seeker_id, full_name, email, address) VALUES (?, ?,  ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisss", $jobId, $job_seeker_id, $fullName, $email, $address);

    if ($stmt->execute()) {
        echo "Job application submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
} else {
    echo "Error: Invalid request.";
}

$conn->close();
?>
