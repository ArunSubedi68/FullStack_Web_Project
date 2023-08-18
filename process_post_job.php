<?php include "includes/header.php"; ?>
<style>
    a {
    display: inline-block;
    margin-top: 10px;
    color: #007bff;
    text-decoration: none;
    font-weight: bold;
}

a:hover {
    color: #0056b3;
}
</style>
<?php
require_once "includes/db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $job_title = $_POST["job_title"];
    $job_description = $_POST["job_description"];
    $employer_id = $_POST["employer_id"]; // Retrieve the employer_id from the form

    $sql = "INSERT INTO jobs (employer_id, title, description, posted_at) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $employer_id, $job_title, $job_description);

    if ($stmt->execute()) {
        echo "Job posted successfully.";
        echo '<a href="employer_dashboard.php">Back to Employer Dashboard</a>';

    } else {
        echo "Error: " . $stmt->error;
    }
}

$conn->close();
?>
