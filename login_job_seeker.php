<?php include "includes/header.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Job Seeker Login</title>
<link rel="stylesheet" href="style_login.css">
</head>
<body>
    <h1>Job Seeker Login</h1>
    <form action="process_login_job_seeker.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <button type="submit">Log In</button>
    </form>
    <a href="index.php">Back to Home</a>
</body>
</html>
