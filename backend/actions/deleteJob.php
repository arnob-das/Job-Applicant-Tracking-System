<?php
include('../config/database.php');

if (isset($_GET['jobId'])) {
    $jobId = $_GET['jobId'];

    $deleteJobQuery = "DELETE FROM JOBS WHERE JobId = '$jobId'";
    $result = mysqli_query($conn, $deleteJobQuery);

    if ($result) {
        header("Location: ../../frontend/jobadvertiserDashboard.php");
        exit();
    } else {
        header("Location: ../../frontend/error.php");
        exit();
    }
} else {
    header("Location: ../../frontend/jobadvertiserDashboard.php");
    exit();
}
