<?php

session_start();

include('../config/database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $_SESSION['loginError'] = "Please fill in all fields";
        header("Location: http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/login.php");
        exit();
    }

    // if the user is job advertiser
    $emailCheckQuery = "SELECT * FROM JOBADVERTISER WHERE Email = '$email'";
    $emailCheckResult = mysqli_query($conn, $emailCheckQuery);

    if ($emailCheckResult && mysqli_num_rows($emailCheckResult) == 1) {
        $user = mysqli_fetch_assoc($emailCheckResult);

        // Verify the entered password using password_verify
        if (password_verify($password, $user['Password'])) {
            $_SESSION['userEmail'] = $email;
            $_SESSION['userRole'] = 'jobAdvertiser';
            $_SESSION['loginError'] = ''; // clear the error message
            header("Location: http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/index.php");
            exit();
        } else {
            $_SESSION['loginError'] = "Email or Password is not correct!";
            header("Location: http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/login.php");
            exit();
        }
    }

    // if the user is candidate
    $emailCheckQuery = "SELECT * FROM CANDIDATE WHERE Email = '$email'";
    $emailCheckResult = mysqli_query($conn, $emailCheckQuery);

    if ($emailCheckResult && mysqli_num_rows($emailCheckResult) == 1) {
        $user = mysqli_fetch_assoc($emailCheckResult);

        // Verify the entered password using password_verify
        if (password_verify($password, $user['Password'])) {
            $_SESSION['userEmail'] = $email;
            $_SESSION['userRole'] = 'candidate';
            $_SESSION['loginError'] = ''; // clear the error message
            header("Location: http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/index.php");
            exit();
        } else {
            $_SESSION['loginError'] = "Email or Password is not correct!";
            header("Location: http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/login.php");
            exit();
        }
    }

    // If the email or password is not correct, show an error message
    $_SESSION['loginError'] = "Email or Password is not correct!";
    header("Location: http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/login.php");
    exit();

    // Close the database connection
    mysqli_close($conn);
} else {
    $_SESSION['loginError'] = "Can not handle login. Please try again!";
    header("Location: http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/login.php");
    exit();
}
?>
