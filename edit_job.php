<?php include "includes/header.php"; ?>

<?php
require_once "includes/db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $job_id = $_GET["id"];

    // Retrieve the job details from the database
    $sql = "SELECT title, description FROM jobs WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $job_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $title = $row["title"];
        $description = $row["description"];
    } else {
        echo "Job not found.";
        exit();
    }
} else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    $job_id = $_POST["job_id"];
    $new_title = $_POST["title"];
    $new_description = $_POST["description"];

    // Update the job details in the database
    $sql = "UPDATE jobs SET title = ?, description = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $new_title, $new_description, $job_id);
    $stmt->execute();

    echo "Job updated successfully.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Job</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
}
p {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
    margin-left: 29%;
  margin-right: auto;
}
h2 {
    text-align: center;
    margin-bottom: 20px;
}
input[type="text"],
 textarea {
    width: 40%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 3px;
    display: block;
  margin-left: auto;
  margin-right: auto;
}
input[type="submit"] {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px;
    border-radius: 3px;
    cursor: pointer;
    display: block;
  margin-left: auto;
  margin-right: auto;
}
input[type="submit"]:hover {
    background-color: #0056b3;
}
a {
    display: block;
    text-align: center;
    margin-top: 20px;
    color: #007bff;
    text-decoration: none;
}
    </style>
</head>
<body>
    <h2>Edit Job</h2>
    <form method="post" action="employer_dashboard.php">
        <input type="hidden" name="job_id" value="<?php echo $job_id; ?>">
        <p>Title:</p> <input type="text" name="title" value="<?php echo $title; ?>"><br>
        <p>Description:</p> <textarea name="description"><?php echo $description; ?></textarea><br>
        <input type="submit" name="update" value="Update">
    </form>
    <a href="employer_dashboard.php">Go back to Employer Dashboard</a> <!-- Link to return to dashboard -->

</body>
</html>
