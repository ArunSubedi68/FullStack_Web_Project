<?php include "includes/header.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Employer Signup</title>
    <link rel="stylesheet" href="style_login.css">

</head>
<body>
    <h1>Employer Signup</h1>
    <form action="process_signup_employer.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <!-- Other employer-related fields can be added here -->
        <button type="submit">Sign Up</button>
    </form>
    <a href="index.php">Back to Home</a>
</body>
</html>
