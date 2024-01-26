<?php

session_start();

include('../config/database.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $_SESSION['loginError'] =  "Please fill in all fields";
        header("Location: http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/login.php");
        exit();
    }

    // if the user is admin
    $emailCheckQuery = "SELECT * FROM ADMIN WHERE Email = '$email' and password='$password'";
    $emailCheckResult = mysqli_query($conn, $emailCheckQuery);

    if (mysqli_num_rows($emailCheckResult)==1) {
        $_SESSION['userEmail'] = $email;
        $_SESSION['userRole'] = 'admin';
        $_SESSION['loginError'] = ''; // clear the error message
        header("Location: http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/index.php");
        exit();
    } else {
        $_SESSION['loginError'] = "Email or Password is not correct!";
        header("Location: http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/login.php");
        //exit();
    }

    // if the user is job advertiser
    $emailCheckQuery = "SELECT * FROM JOBADVERTISER WHERE Email = '$email' AND password='$password'";
    $emailCheckResult = mysqli_query($conn, $emailCheckQuery);

    if (mysqli_num_rows($emailCheckResult) == 1) {
        $_SESSION['userEmail'] = $email;
        $_SESSION['userRole'] = 'jobAdvertiser';
        $_SESSION['loginError'] = ''; // clear the error message
        header("Location: http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/index.php");
        exit();
    }else {
        $_SESSION['loginError'] = "Email or Password is not correct!";
        header("Location: http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/login.php");
        //exit();
    }

    // if the user is candidate
    $emailCheckQuery = "SELECT * FROM CANDIDATE WHERE Email = '$email' AND password='$password'";
    $emailCheckResult = mysqli_query($conn, $emailCheckQuery);

    if (mysqli_num_rows($emailCheckResult)==1) {
        $_SESSION['userEmail'] = $email;
        $_SESSION['userRole'] = 'candidate';
        $_SESSION['loginError'] = ''; // clear the error message
        header("Location: http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/index.php");
        exit();
    } else {
        $_SESSION['loginError'] = "Email or Password is not correct!";
        header("Location: http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/login.php");
        //exit();
    }



    // Close the database connection
    mysqli_close($conn);
} else {
    $_SESSION['loginError'] = "Can not handle login. Please try again!";
    header("Location: http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/login.php");
    exit();
}
