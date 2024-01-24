<?php

session_start();

include('../config/database.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $contactNumber = $_POST['contactNumber'];
    $role = $_POST['role'];

    if (empty($fullName) || empty($email) || empty($password) || empty($contactNumber) || empty($role)) {
        $_SESSION['registrationError'] = "Please fill in all fields";
        header("Location: http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/registration.php");
        exit();
    }

    if (strlen($password) < 6) {
        $_SESSION['registrationError'] = "Password must be at least 6 characters long";
        header("Location: http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/registration.php");
        exit();
    }

    $emailCheckQuery = "SELECT Email FROM JOBADVERTISER WHERE Email = '$email' UNION SELECT Email FROM CANDIDATE WHERE Email = '$email'";
    $emailCheckResult = mysqli_query($conn, $emailCheckQuery);

    if (mysqli_num_rows($emailCheckResult) > 0) {
        $_SESSION['registrationError'] = "Email already exists. Please use a different email.";
        header("Location: http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/registration.php");
        exit();
    }

    $contactNumberCheckQuery = "SELECT ContactNo FROM JOBADVERTISER WHERE ContactNo = '$contactNumber' UNION SELECT ContactNo FROM CANDIDATE WHERE ContactNo = '$contactNumber'";
    $contactNumberCheckResult = mysqli_query($conn, $contactNumberCheckQuery);

    if (mysqli_num_rows($contactNumberCheckResult) > 0) {
        $_SESSION['registrationError'] = "Contact number already exists. Please use a different contact number.";
        header("Location: http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/registration.php");
        exit();
    }

    if ($role === 'jobAdvertiser') {
        $query = "INSERT INTO JOBADVERTISER (Email, FullName, Role, Password, ContactNo) VALUES ('$email', '$fullName', '$role', '$password', '$contactNumber')";
    } elseif ($role === 'candidate') {
        $query = "INSERT INTO CANDIDATE (Email, FullName, Role, Password, ContactNo) VALUES ('$email', '$fullName', '$role', '$password', '$contactNumber')";
    } else {
        $_SESSION['registrationError'] = "Invalid role selected";
        header("Location: http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/registration.php");
        exit();
    }

    $result = mysqli_query($conn, $query);

    if ($result) {
        // clear the error message after successful registration
        $_SESSION['registrationError'] = "";
        header("Location: http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/index.php");
        exit();
    } else {
        $_SESSION['registrationError'] = "Registration failed: " . mysqli_error($conn);
        header("Location: http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/registration.php");
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    $_SESSION['registrationError'] = "Can not handle registration. Please try again@";
    header("Location: http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/registration.php");
}
