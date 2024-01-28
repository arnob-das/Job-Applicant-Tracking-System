<?php
session_start();
include('../config/database.php');

if (isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'candidate') {
    // job advertiser is logged in
} else {
    header("Location: http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/error.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $jobId = $_POST['jobId'];
    $email = $_SESSION['userEmail'];

    // Check if the file is uploaded successfully
    if ($_FILES['cv']['error'] === UPLOAD_ERR_OK) {
        // Retrieve candidateId based on email
        $getCandidateIdQuery = "SELECT candidateId FROM CANDIDATE WHERE Email = ?";
        $getCandidateIdStmt = mysqli_prepare($conn, $getCandidateIdQuery);
        mysqli_stmt_bind_param($getCandidateIdStmt, "s", $email);
        mysqli_stmt_execute($getCandidateIdStmt);
        $candidateIdResult = mysqli_stmt_get_result($getCandidateIdStmt);

        if ($candidateIdRow = mysqli_fetch_assoc($candidateIdResult)) {
            $candidateId = $candidateIdRow['candidateId'];

            // Generate the new filename
            $newFileName = $candidateId . '_' . $jobId . '.pdf';
            $targetDirectory = 'http://localhost/varsity/project/Job-Applicant-Tracking-System/backend/uploads/'; // Specify your upload directory
            $cvFilePath = $targetDirectory . $newFileName;

            // Update the CvLink in the APPLY table with the new filename
            $insertQuery = "INSERT INTO APPLY (JobId, candidateId, applicationDate, CvLink) VALUES (?, ?, NOW(), ?)";
            $stmt = mysqli_prepare($conn, $insertQuery);

            if ($stmt) {
                // Bind parameters
                mysqli_stmt_bind_param($stmt, "iis", $jobId, $candidateId, $cvFilePath);

                // Execute the statement
                $result = mysqli_stmt_execute($stmt);

                if ($result) {
                    // Move the uploaded file to the specified directory with the new filename
                    move_uploaded_file($_FILES['cv']['tmp_name'], $cvFilePath);
                    $_SESSION['applyError'] = '';
                    header("Location: http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/jobs.php");
                } else {
                    $_SESSION['applyError'] = 'Error submitting the application. Please try again.';
                }

                mysqli_stmt_close($stmt);
            } else {
                $_SESSION['applyError'] = 'Error submitting the application. Please try again.';
            }
        } else {
            // Candidate not found, handle accordingly
            $_SESSION['applyError'] = 'Candidate not found. Please register before applying.';
        }

        mysqli_stmt_close($getCandidateIdStmt);
    } else {
        // File upload error, handle accordingly
        $_SESSION['applyError'] = 'Error uploading the file. Please try again.';
    }

    // Redirect to the jobApply.php page with the jobId
    header("Location: http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/jobApply.php?jobId=$jobId");
    exit();
} else {
    // Redirect if the form is not submitted using POST method
    header("Location: http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/error.php");
    exit();
}
