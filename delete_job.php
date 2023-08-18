<?php
require_once "includes/db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $job_id = $_GET["id"];

    // Delete related applications from the applications table
    $delete_applications_sql = "DELETE FROM applications WHERE job_id = ?";
    $stmt = $conn->prepare($delete_applications_sql);
    $stmt->bind_param("i", $job_id);
    $stmt->execute();

    // Delete the job from the jobs table
    $delete_job_sql = "DELETE FROM jobs WHERE id = ?";
    $stmt = $conn->prepare($delete_job_sql);
    $stmt->bind_param("i", $job_id);

    if ($stmt->execute()) {
        echo "Job deleted successfully.";

    } else {
        echo "Error deleting job: " . $stmt->error;
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Job</title>
</head>
<body>
    <h1></h1>
    <a href="employer_dashboard.php">Go back to Employer Dashboard</a> <!-- Link to return to dashboard -->
</body>
</html>