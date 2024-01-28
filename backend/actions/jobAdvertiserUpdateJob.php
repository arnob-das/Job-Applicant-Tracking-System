<?php
include('../config/database.php');

// if (isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'jobAdvertiser') {
//     // job advertiser is logged in
// } else {
//     header("Location: http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/index.php");
//     exit();
// }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jobId = $_POST['jobId'];
    $jobTitle = mysqli_real_escape_string($conn, $_POST['jobTitle']);
    $company = mysqli_real_escape_string($conn, $_POST['company']);
    $salary = mysqli_real_escape_string($conn, $_POST['salary']);
    $position = mysqli_real_escape_string($conn, $_POST['position']);
    $jobStatus = mysqli_real_escape_string($conn, $_POST['jobStatus']);
    $jobDetail = mysqli_real_escape_string($conn, $_POST['jobDetail']);

    // Update job details in the database
    $updateQuery = "UPDATE JOBS 
                    SET JobTitle = '$jobTitle', company = '$company', salary = '$salary', 
                        position = '$position', jobDetail = '$jobDetail' , jobStatus = '$jobStatus'
                    WHERE JobId = '$jobId'";

    if (mysqli_query($conn, $updateQuery)) {
        // Job updated successfully

        // for notification
        if ($jobStatus == 'close') {            
            $candidateIdsQuery = "SELECT candidateId FROM APPLY WHERE JobId = $jobId";
            $candidateIdsResult = mysqli_query($conn, $candidateIdsQuery);

            // send notification to all candidates who applied in this job.
            while ($candidateIdRow = mysqli_fetch_assoc($candidateIdsResult)) {
                $candidateIdId = $candidateIdRow['candidateId'];
                $notificationQuery = "INSERT INTO Notifications (candidateId, message, createdAt) VALUES ( $candidateIdId, '$jobTitle This job is closed now !', NOW())";
                mysqli_query($conn, $notificationQuery);
            }
        }

        header("Location: ../../frontend/jobAdvertiserDashboard.php"); // Redirect to yourJobs.php or any other page
        exit();
    } else {
        // Error updating job
        header("Location: ../frontend/error.php");
    }
} else {
    // If the request method is not POST, redirect to an error page or handle accordingly
    header("Location: ../frontend/error.php");
    exit();
}
