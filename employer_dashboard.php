<?php include "includes/header.php"; ?>

<?php
session_start(); // Start the session

// Check if the user is logged in and has a valid session
if (!isset($_SESSION["user_id"]) || $_SESSION["user_type"] !== "employer") {
    // Redirect to the login page or take appropriate action
    header("Location: login_employer.php");
    exit();
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Employer Dashboard</title>
</head>
<body>
    <h1>Welcome to Your Employer Dashboard</h1>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FEF8DD;
            margin: 0;
            padding: 0;
            margin-left:2rem;
}
.edit-button {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 5px 10px;
    border-radius: 3px;
    cursor: pointer;
    text-decoration: none;
display: inline-block;
}
.edit-button:hover {
    background-color: #0056b3;
}
.delete-button {
    background-color: #dc3545;
    color: white;
    border: none;
    padding: 5px 10px;
    border-radius: 3px;
    cursor: pointer;
    text-decoration: none;
}

.delete-button:hover {
    background-color: #c82333;
}
/* Style for job titles */
.job-title {
    font-size: 20px;
    color: #007bff;
}

/* Style for job descriptions */
.job-description {
    font-size: 14px;
    color: #555;
}
/* Style for the "Post a New Job" form */
form {
    max-width: 500px;
    margin: auto;
    padding: 20px;
    background-color: white;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

form h2 {
    text-align: center;
    margin-bottom: 20px;
}

form label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

form input[type="text"],
form textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

form button[type="submit"] {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px;
    border-radius: 3px;
    cursor: pointer;
    width: 100%;
}

form button[type="submit"]:hover {
    background-color: #0056b3;
}

form a {
    display: block;
    text-align: center;
    margin-top: 20px;
    color: #007bff;
    text-decoration: none;
}
.logoutButton{
    display: block;
    text-align: center;
    margin-top: 20px;
    color: #007bff;
    text-decoration: none;
}
    </style>


    <h2>Posted Jobs</h2>
    <?php
require_once "includes/db_connection.php";

$employer_id = $_SESSION["user_id"]; // Get the employer's ID from the session

$sql = "SELECT id, title, description FROM jobs WHERE employer_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $employer_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<ul class='job-title'>";
    while ($row = $result->fetch_assoc()) {
        echo "<li class='job-description'><strong>" . $row["title"] . "</strong><br>" . $row["description"] . "<br>";
        echo "<a class='edit-button' href='edit_job.php?id=" . $row["id"] . "' >Edit</a> | ";
        echo "<a class='delete-button' href='delete_job.php?id=" . $row["id"] . "'>Delete</a></li>";
    }
    echo "</ul>";
} else {
    echo "You haven't posted any jobs yet.";
}

$conn->close();
?>
    <h2>Post a New Job</h2>
    <form action="process_post_job.php" method="post">
    <label for="job_title">Job Title:</label>
    <input type="text" id="job_title" name="job_title" required><br>
    <label for="job_description">Job Description:</label>
    <textarea id="job_description" name="job_description" required></textarea><br>
    <input type="hidden" name="employer_id" value="<?php echo $_SESSION['user_id']; ?>">
 
    <button type="submit">Post Job</button>
</form>

    <a href="logout.php" class='logoutButton'>Logout</a>
</body>
</html>
