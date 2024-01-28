<?php

session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/signin.css">
    <title>Job Applicant Tracking System</title>

</head>

<body class="">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="/varsity/project/Job-Applicant-Tracking-System/frontend/">
                <img class="img-fluid logo-img" src="./assets/navIcon.png" alt="nav icon" style="width: 100px; height: 100px;">
            </a>
            <button class="navbar-toggler text-bold" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link  btn btn-outline-light text-primary border border-primary mx-2" aria-current="page" href="/varsity/project/Job-Applicant-Tracking-System/frontend/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-light text-primary border border-primary mx-2" href="/varsity/project/Job-Applicant-Tracking-System/frontend/jobs.php">Jobs</a>
                    </li>

                    <?php if (isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'admin') : ?>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-light text-primary border border-primary mx-2" href="/varsity/project/Job-Applicant-Tracking-System/frontend/admin.php">Admin Dashboard</a>
                        </li>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'jobAdvertiser') : ?>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-light text-primary border border-primary mx-2" href="/varsity/project/Job-Applicant-Tracking-System/frontend/postAJob.php">Post A Job</a>
                        </li>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'jobAdvertiser') : ?>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-light text-primary border border-primary mx-2" href="jobAdvertiserDashboard.php">JobAdvertiser Dashboard</a>
                        </li>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'candidate') : ?>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-light text-primary border border-primary mx-2" href="candidateDashboard.php">Candidate Dashboard</a>
                        </li>
                    <?php endif; ?>

                    <?php if (empty($_SESSION['userRole'])) : ?>
                        <li class="nav-item bg-primary rounded px-2">
                            <a class="nav-link text-white" href="/varsity/project/Job-Applicant-Tracking-System/frontend/login.php">Sign In</a>
                        </li>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['userRole']) && ($_SESSION['userRole'] == 'candidate' || $_SESSION['userRole'] == 'jobAdvertiser' || $_SESSION['userRole'] == 'admin')) : ?>
                        <li class="nav-item bg-primary rounded px-2">
                            <a class="nav-link text-white btn-lg" href="/varsity/project/Job-Applicant-Tracking-System/backend/actions/logout.php">Log out</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>