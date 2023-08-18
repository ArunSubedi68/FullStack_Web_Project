<?php include "includes/header.php"; ?>

<?php
session_start();
require_once "includes/db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE username = ? AND user_type = 'employer'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        
        // Verify the password
        if (password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["id"]; // Store user ID in the session
            $_SESSION["user_type"] = "employer";
            header("Location: employer_dashboard.php");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "Invalid username.";
    }
}

$conn->close();
?>
