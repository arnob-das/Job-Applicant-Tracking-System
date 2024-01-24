<?php
session_start();
include('../config/database.php');
echo $_SESSION['userEmail'];


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

    $postedBy = $_SESSION['userEmail'];
    $jobStatus = 'pending';

    $query = "INSERT INTO JOBS (JobTitle, dateposted, company, salary, position, jobDetail, postedBy, jobStatus)
                  VALUES ('$jobTitle', NOW(), '$company', $salary, '$position','$jobDetail', '$postedBy', '$jobStatus')";

    $result = mysqli_query($conn, $query);

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

    // // Check if the user is logged in and has the necessary role
    // if (isset($_SESSION['userRole']) && $_SESSION['userRole'] === 'jobAdvertiser') {
    //     $postedBy = $_SESSION['userEmail']; // Assuming the user's email is stored in the session
    //     $jobStatus = 'pending'; // You can set a default status or modify it as needed

    //     // Insert job posting into the database
    //     $query = "INSERT INTO JOBS (JobTitle, dateposted, company, salary, position, jobDetail, postedBy, jobStatus)
    //               VALUES ('$jobTitle', NOW(), '$company', $salary, '$position','$jobDetail', '$postedBy', '$jobStatus')";

    //     $result = mysqli_query($conn, $query);

    //     if ($result) {
    //         // Job posting successful
    //         $_SESSION['jobPostError'] = "";
    //         header("Location: http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/postajob.php");
    //         exit();
    //     } else {
    //         // Job posting failed
    //         $_SESSION['jobPostError'] = "Error posting the job. Please try again.";
    //         header("Location: http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/postajob.php");
    //         exit();
    //     }
    // } else {
    //     // Redirect if the user doesn't have the necessary role
    //     header("Location: http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/index.php");
    //     exit();
    // }
} else {
    // Redirect if the form is not submitted using POST method
    header("Location: http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/postajob.php");
    exit();
}
