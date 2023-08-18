<?php include "includes/header.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Job Seeker Signup</title>
    <link rel="stylesheet" href="style_login.css">

</head>
<body>
    <h1>Job Seeker Signup</h1>
    <form action="process_signup_job_seeker.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <!-- Other job seeker-related fields can be added here -->
        <button type="submit">Sign Up</button>
    </form>
    <a href="index.php">Back to Home</a>
</body>
</html>
