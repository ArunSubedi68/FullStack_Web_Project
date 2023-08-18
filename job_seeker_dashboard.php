<?php include "includes/header.php"; ?>

<?php
session_start(); 
 
if (!isset($_SESSION["user_id"]) || $_SESSION["user_type"] !== "job_seeker") {
    header("Location: login_job_seeker.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Job Seeker Dashboard</title>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $(".apply-button").click(function() {
        var jobId = $(this).data("job-id");
        $("#jobId").val(jobId);
        $("#applyPopup").show();
    });

    $("#applyForm").submit(function(event) {
        event.preventDefault();
        var jobId = $("#jobId").val();
        var fullName = $("#fullName").val();
        var email = $("#email").val();
        var address = $("#address").val();

        $.ajax({
            type: "POST",
            url: "process_apply_job.php", 
            data: {
                jobId: jobId,
                fullName: fullName,
                email: email,
                address: address
            },
            success: function(response) {
                alert(response); 
                $("#applyPopup").hide();
            }
        });
    });
});

$(document).ready(function() {
    $(".apply-button").click(function() {
        var jobId = $(this).data("job-id");
        $("#jobId").val(jobId);
        $(".popup-overlay").show(); 
    });

    $(".popup-close").click(function() {
        $(".popup-overlay").hide(); 
    });

    $(".popup-container").click(function(event) {
        event.stopPropagation();
    });
});
</script>
</head>
<body>
    <h1>Welcome to Your Job Seeker Dashboard</h1>
    
    <h2>Available Jobs</h2>
    <div id="job-list-container">
    <?php
    require_once "includes/db_connection.php";

    $sql = "SELECT * FROM jobs";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li>" . $row["title"] . " - " . $row["description"] . " <a href='javascript:void(0)' class='apply-button' data-job-id='" . $row["id"] . "'>Apply</a></li>";
        }
        echo "</ul>";
  

    } else {
        echo "No available jobs.";
    }

    $conn->close();
    ?>
 </div>

    <div class="popup-overlay">
    <div class="popup-container">
        <span class="popup-close">&times;</span> <!-- Close button -->
        <form id="applyForm">
        <input type="hidden" id="jobId" name="jobId">
        <label for="fullName">Full Name:</label>
        <input type="text" id="fullName" name="fullName" required><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required><br>
        <input type="hidden" name="job_seeker_id" value="<?php echo $_SESSION['user_id']; ?>">

        <button type="submit">Apply</button>
        </form>
    </div>
    </div>
    

    <a href="logout.php" class="logout_to_dc">Logout</a>


<style>
    /* Style for the job list */
#job-list-container ,h2 {
    max-width: 800px;
    margin: auto;
    padding: 20px;
    background-color: white;
    margin-bottom: 1rem;
    border-radius: 5px;
    box-shadow: 0 4px 5px rgba(0, 0.2, 0, 0.8);
}

.job-item {
    margin-bottom: 15px;
    padding: 15px;
    background-color: #f0f0f0;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.job-item h3 {
    margin-top: 0;
}

.job-item p {
    margin: 5px 0;
}

.apply-button {
    display: inline-block;
    background-color: #007bff;
    color: white;
    padding: 5px 10px;
    border-radius: 3px;
    cursor: pointer;
    text-decoration: none;
}

.apply-button:hover {
    background-color: #0056b3;
}

    /* Styles for the popup overlay */
.popup-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 1000;
}
.popup-container {
    background-color: white;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    position: relative;
}

.popup-close {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 24px;
    cursor: pointer;
    color: #888;
}

.popup-close:hover {
    color: #555;
}

.popup-container label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

.popup-container input[type="text"],
.popup-container input[type="email"] {
    width: 90%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

.popup-container button[type="submit"] {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px;
    border-radius: 3px;
    cursor: pointer;
    width: 100%;
}

.popup-container button[type="submit"]:hover {
    background-color: #0056b3;
}
/* Styles for the popup container */
.popup-container {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
}

/* Styles for the close button */
.popup-close {
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
}
.logout_to_dc {
    display: block;
    text-align: center;
    margin-top: 20px;
    color: #007bff;
    text-decoration: none;
    
}

</style>
</body>
</html>
