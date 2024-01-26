<?php
include('./inc/header.php');
include('../backend/config/database.php');

$jobAdvertiserEmail = $_SESSION['userEmail'];

// Fetch jobs posted by the logged-in job advertiser
$query = "SELECT * FROM JOBS WHERE postedBy = '$jobAdvertiserEmail'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
?>
    <div class="container mt-4">
        <h2>Your Posted Jobs</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Job Name</th>
                    <th>Date Posted</th>
                    <th>Total Applications</th>
                    <th>Applicants</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    $jobId = $row['JobId'];

                    // Count total applications for each job
                    $applicationsQuery = "SELECT COUNT(*) as totalApplications FROM APPLY WHERE JobId = '$jobId'";
                    $applicationsResult = mysqli_query($conn, $applicationsQuery);
                    $applicationsRow = mysqli_fetch_assoc($applicationsResult);
                    $totalApplications = $applicationsRow['totalApplications'];

                    // Fetch applicants for each job
                    $applicantsQuery = "SELECT CANDIDATE.FullName FROM APPLY
                        JOIN CANDIDATE ON APPLY.candidateId = CANDIDATE.candidateId
                        WHERE APPLY.JobId = '$jobId'";
                    $applicantsResult = mysqli_query($conn, $applicantsQuery);
                    $applicants = mysqli_fetch_all($applicantsResult);

                    echo "<tr>";
                    echo "<td><a href='jobDetail.php?jobId={$jobId}'>{$row['JobTitle']}</a></td>";
                    echo "<td>{$row['dateposted']}</td>";
                    echo "<td>{$totalApplications}</td>";
                    echo "<td><a href='applicants.php?jobId={$jobId}'>" . implode(', ', array_column($applicants, 0)) . "</a></td>";
                    echo "<td><a href='../backend/actions/deleteJob.php?jobId={$jobId}' class='btn btn-danger'>Delete</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
<?php
} else {
    echo "<p>No jobs posted yet.</p>";
}

include('./inc/footer.php');
?>