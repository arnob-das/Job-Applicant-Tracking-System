<?php
include('../config/database.php');

// if (isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'jobAdvertiser') {
//     // job advertiser is logged in
// } else {
//     header("Location: http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/index.php");
//     exit();
// }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $applyId = $_POST['applyId'];
    $status = $_POST['status'];
    $jobId = $_POST['jobId'];
    $jobTitle = $_POST['jobTitle'];

    $updateStatusQuery = "UPDATE APPLY SET Status = '$status' WHERE applyId = $applyId";

    if (mysqli_query($conn, $updateStatusQuery)) {
        // Status updated successfully

        // for notification
        if ($status == "selected") {
            $candidateIdsQuery = "SELECT candidateId FROM APPLY WHERE JobId = $jobId";
            $candidateIdsResult = mysqli_query($conn, $candidateIdsQuery);

            // send notification to all candidates who applied in this job.
            while ($candidateIdRow = mysqli_fetch_assoc($candidateIdsResult)) {
                $candidateIdId = $candidateIdRow['candidateId'];
                $notificationQuery = "INSERT INTO Notifications (candidateId, message, createdAt) VALUES ( $candidateIdId, 'One candidate is selected for this job {$jobTitle} !', NOW())";
                mysqli_query($conn, $notificationQuery);
            }
        }

        header("Location: ../../frontend/applicants.php?jobId={$jobId}"); // Redirect back to applicants page
        exit();
    } else {
        // Error updating status
        header("Location: ../../frontend/error.php");
        exit();
    }
} else {
    // If the request method is not POST, redirect to an error page or handle accordingly
    header("Location: ../../frontend/error.php");
    exit();
}
