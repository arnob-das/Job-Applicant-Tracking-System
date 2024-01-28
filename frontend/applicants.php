<?php
include('./inc/header.php');
include('../backend/config/database.php');

// Ensure the jobId is provided in the query string
if (isset($_GET['jobId'])) {
    $jobId = $_GET['jobId'];

    $jobQuery = "SELECT * FROM JOBS WHERE JobId = $jobId";
    $jobResult = mysqli_query($conn, $jobQuery);
    $job = mysqli_fetch_assoc($jobResult);


    // Fetch applicants for the selected job
    $applicantsQuery = "SELECT CANDIDATE.*, APPLY.applyId, APPLY.Status, APPLY.CvLink 
                        FROM APPLY 
                        JOIN CANDIDATE ON APPLY.candidateId = CANDIDATE.candidateId
                        WHERE APPLY.JobId = $jobId";
    $applicantsResult = mysqli_query($conn, $applicantsQuery);
?>

    <div class="container mt-4">
        <h2>Applicants for Job: <?php echo $job['JobTitle']; ?></h2>

        <?php if (mysqli_num_rows($applicantsResult) > 0) { ?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Candidate Name</th>
                            <th>Candidate Email</th>
                            <th>Status</th>
                            <th>Resume</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($applicant = mysqli_fetch_assoc($applicantsResult)) { ?>
                            <tr>
                                <td><?php echo $applicant['FullName']; ?></td>
                                <td><?php echo $applicant['Email']; ?></td>
                                <td><?php echo $applicant['Status']; ?></td>
                                <td>
                                    <a href="<?php echo $applicant['CvLink']; ?>" target="_blank">Show Resume</a>
                                </td>
                                <td>
                                    <form class='d-flex' action="../backend/actions/updateApplicationStatus.php" method="post">
                                        <input type="hidden" name="applyId" value="<?php echo $applicant['applyId']; ?>">
                                        <input type="hidden" name="jobId" value="<?php echo $jobId; ?>">
                                        <input type="hidden" name="jobTitle" value="<?php echo $job['JobTitle']; ?>">
                                        <select name="status" class="form-select" required>
                                            <option value="pending" <?php echo ($applicant['Status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
                                            <option value="selected" <?php echo ($applicant['Status'] == 'selected') ? 'selected' : ''; ?>>Selected</option>
                                            <option value="rejected" <?php echo ($applicant['Status'] == 'rejected') ? 'selected' : ''; ?>>Rejected</option>
                                        </select>
                                        <button type="submit" class="btn btn-primary btn-sm">Update Status</button>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <p>No applicants for this job yet.</p>
        <?php } ?>
    </div>

<?php
} else {
    echo "<p>Error: JobId not provided.</p>";
}

include('./inc/footer.php');
?>