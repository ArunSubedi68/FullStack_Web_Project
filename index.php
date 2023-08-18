<?php include "includes/header.php"; ?>


<!DOCTYPE html>
<html>
<head>
    <title>Welcome to My Application</title>
    <style>
 body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            margin-left:0rem;
            background-image: url("includes/17580.jpg");
        }
        .button {
            display: inline-block;
            margin: 10px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .button:hover {
            background-color: #0056b3;
        }
        h2{
            margin-left: 1rem;
        }
    </style>
</head>
<body>
    <h1>Welcome to the Job finder.</h1>  
    <div class='emp'><h2>Employer</h2> 
    <a href='login_employer.php' class='button'>Log In as Employer</a>
    <br>
    <a href='signup_employer.php' class='button'>Sign Up as Employer</a>
    <br></div>
   <div class='seeker'>
    <h2>Job Seeker</h2> 
    <a href='login_job_seeker.php' class='button'>Log In as Job Seeker</a>
    <br>
    <a href='signup_job_seeker.php' class='button'>Sign Up as Job Seeker</a>
    </div>
    <style>
        /* Style for login and signup buttons */
        .button {
            display: inline-block;
            margin-bottom: 5px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .button:hover {
            background-color: #0056b3;
        }
        .emp, .seeker{
            display:inline-flex;
            align-items: center;
            margin-left: 7%;
        }
        h1{
            margin-left: 7%; 
        }
    </style>
</body>
</html>
