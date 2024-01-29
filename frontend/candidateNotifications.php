<?php
include('./inc/header.php');
include('../backend/config/database.php');

if (isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'candidate') {
    $userEmail = $_SESSION['userEmail'];

    // Retrieve candidateId based on candidate userEmail
    $candidateIdQuery = "SELECT candidateId FROM CANDIDATE WHERE Email = ?";
    $stmt = mysqli_prepare($conn, $candidateIdQuery);
    mysqli_stmt_bind_param($stmt, "s", $userEmail);
    mysqli_stmt_execute($stmt);
    $candidateIdResult = mysqli_stmt_get_result($stmt);

    if ($candidateIdRow = mysqli_fetch_assoc($candidateIdResult)) {
        $candidateId = $candidateIdRow['candidateId'];

        // Retrieve notifications for the candidate
        $notificationsQuery = "SELECT * FROM Notifications WHERE candidateId = ? ORDER BY createdAt DESC";
        $stmt = mysqli_prepare($conn, $notificationsQuery);
        mysqli_stmt_bind_param($stmt, "i", $candidateId);
        mysqli_stmt_execute($stmt);
        $notificationResult = mysqli_stmt_get_result($stmt);
    } else {
        // Candidate not found
        echo "Candidate not found.";
        exit();
    }
} else {
    header("Location: http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/error.php");
    exit();
}
?>

<div class="container mt-4">
    <h1>Notifications</h1>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Message</th>
                <th>Received on</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($notification = mysqli_fetch_assoc($notificationResult)): ?>
                <tr>
                    <td><?php echo $notification['message']; ?></td>
                    <td><?php echo $notification['createdAt']; ?></td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
