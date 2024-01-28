<?php
session_start();
include('../config/database.php');

if (isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'jobAdvertiser') {
    // job advertiser is logged in
} else {
    header("Location: http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/error.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $jobTitle = $_POST['jobTitle'];
    $company = $_POST['company'];
    $salary = $_POST['salary'];
    $position = $_POST['position'];
    $jobDetail = $_POST['jobDetail'];

    // Check if any of the fields are empty
    if (empty($jobTitle) || empty($company) || empty($salary) || empty($position) || empty($jobDetail)) {
        $_SESSION['jobPostError'] = "Please fill in all required fields";
        header("Location: http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/postajob.php");
        exit();
    }

    // Encode special characters in jobDetail for safe storage in the database
    $jobDetail = htmlspecialchars($jobDetail, ENT_QUOTES, 'UTF-8');

    $postedBy = $_SESSION['userEmail'];
    $jobStatus = 'pending';

    // Use prepared statement to avoid SQL injection
    $query = "INSERT INTO JOBS (JobTitle, dateposted, company, salary, position, jobDetail, postedBy) VALUES (?, NOW(), ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "ssdsss", $jobTitle, $company, $salary, $position, $jobDetail, $postedBy);

        // Execute the statement
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            // Job posting successful
            $_SESSION['jobPostError'] = "";
            header("Location: http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/postajob.php");
            exit();
        } else {
            // Job posting failed
            $_SESSION['jobPostError'] = "Error posting the job. Please try again.";
            header("Location: http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/postajob.php");
            exit();
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Error in prepared statement
        $_SESSION['jobPostError'] = "Error posting the job. Please try again.";
        header("Location: http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/postajob.php");
        exit();
    }
} else {
    // Redirect if the form is not submitted using POST method
    header("Location: http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/postajob.php");
    exit();
}
