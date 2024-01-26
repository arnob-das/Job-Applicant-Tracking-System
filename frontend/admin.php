<?php
include('./inc/header.php');
include('../backend/config/database.php');

if (isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'admin') {
    // Admin is logged in
} else {
    header("Location: http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/index.php");
    exit();
}
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Admin Dashboard</h2>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Job Advertisers</h5>
                    <p class="card-text">Manage job advertiser accounts</p>
                    <a href="admin_manage_jobAdvertiser.php" class="btn btn-primary">Manage</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Candidates</h5>
                    <p class="card-text">Manage candidate accounts</p>
                    <a href="admin_manage_candidates.php" class="btn btn-primary">Manage</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Jobs</h5>
                    <p class="card-text">Manage job postings</p>
                    <a href="admin_manage_jobs.php" class="btn btn-primary">Manage</a>
                </div>
            </div>
        </div>
    </div>
</div>
