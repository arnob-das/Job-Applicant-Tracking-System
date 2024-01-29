<?php
include('./inc/header.php');
include('../backend/config/database.php');

// Ensure the candidate's email is available in the session
if (isset($_SESSION['userEmail']) && $_SESSION['userRole'] == 'candidate') {
    $candidateEmail = $_SESSION['userEmail'];

    // Fetch jobs applied by the candidate
    $jobsQuery = "SELECT JOBS.JobId, JOBS.JobTitle, JOBS.jobStatus, JOBS.dateposted, JOBS.company, JOBS.position, APPLY.Status, APPLY.applicationDate
                  FROM JOBS
                  JOIN APPLY ON JOBS.JobId = APPLY.JobId
                  WHERE APPLY.candidateId = (SELECT candidateId FROM CANDIDATE WHERE Email = '$candidateEmail')";

    $jobsResult = mysqli_query($conn, $jobsQuery);
?>

    <div class="container mt-4">
        <h2>Your Job Applications</h2>

        <?php if (mysqli_num_rows($jobsResult) > 0) { ?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Job Title</th>
                            <th>Application Date</th>
                            <th>Company</th>
                            <th>Position</th>
                            <th>Job Status</th>
                            <th>Application Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($jobsResult)) { 
                            $statusClass = ($row['Status'] == 'selected') ? 'text-success' : '';
                            ?>
                            <tr>
                                <td><a class = "<?php echo $statusClass; ?> . text-decoration-none" href="jobDetail.php?jobId=<?php echo $row['JobId']; ?>"><?php echo $row['JobTitle']; ?></a></td>
                                <td class = "<?php echo $statusClass; ?>"><?php echo $row['applicationDate']; ?></td>
                                <td class = "<?php echo $statusClass; ?>"><?php echo $row['company']; ?></td>
                                <td class = "<?php echo $statusClass; ?>"><?php echo $row['position']; ?></td>
                                <td class = "<?php echo $statusClass; ?>"><?php echo $row['jobStatus']; ?></td>
                                <td class = "<?php echo $statusClass; ?>"><?php echo $row['Status']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <p>You haven't applied to any jobs yet.</p>
        <?php } ?>
    </div>

<?php
} else {
    header("Location: http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/index.php");
    exit();
}

?>