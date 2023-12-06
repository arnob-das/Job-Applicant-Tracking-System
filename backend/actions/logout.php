<?php 
session_start();

$_SESSION['userEmail'] = null;
$_SESSION['userRole'] = null;
header("Location: http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/index.php");

?>