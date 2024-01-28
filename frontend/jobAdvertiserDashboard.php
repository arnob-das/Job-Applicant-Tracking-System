<?php
include('./inc/header.php');
include('../backend/config/database.php');

$jobAdvertiserEmail = $_SESSION['userEmail'];

if (isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'jobAdvertiser') {
    // job advertiser is logged in
} else {
    header("Location: http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/index.php");
    exit();
}

// Fetch jobs posted by the logged-in job advertiser
$query = "SELECT * FROM JOBS WHERE postedBy = '$jobAdvertiserEmail'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
?>
    <div class="container mt-4">
        <h2>Dashboard</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Job Title</th>
                        <th>Date Posted</th>
                        <th>Job Status</th>
                        <th>Total Applications</th>
                        <th>Applicants</th>
                        <th>Update Job</th>
                        <th>Delete Job</th>
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
                        echo "<td><a class='text-decoration-none' href='jobDetail.php?jobId={$jobId}'>{$row['JobTitle']}</a></td>";
                        echo "<td>{$row['dateposted']}</td>";
                        echo "<td>{$row['jobStatus']}</td>";
                        echo "<td>{$totalApplications}</td>";
                        echo "<td><a class='text-decoration-none' href='applicants.php?jobId={$jobId}'>" . "View Applicants" . "</a></td>";
                        echo "<td>
                            <button class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#updateJobModal{$jobId}'>Update Job</button>
                          </td>";
                        echo "<td><a href='../backend/actions/jobAdvertiserDeleteJob.php?jobId={$jobId}' class='btn btn-danger'>Delete Job</a></td>";
                        echo "</tr>";

                        // Modal for updating job details
                        echo
                        "<div class='modal fade' id='updateJobModal{$jobId}' tabindex='-1' role='dialog' aria-labelledby='updateJobModalLabel{$jobId}' aria-hidden='true'>
                            <div class='modal-dialog' role='document'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <h5 class='modal-title' id='updateJobModalLabel{$jobId}'>Update Job Details</h5>
                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                    </div>
                                    <div class='modal-body'>
                                        <form action='../backend/actions/jobAdvertiserUpdateJob.php' method='post'>
                                        <div class='mb-3'>
                                        <label for='jobTitle' class='form-label'>Job Title</label>
                                        <input type='text' class='form-control' id='jobTitle' name='jobTitle' value='{$row['JobTitle']}' required>
                                    </div>
                                    <div class='mb-3'>
                                        <label for='company' class='form-label'>Company</label>
                                        <input type='text' class='form-control' id='company' name='company' value='{$row['company']}' required>
                                    </div>
                                    <div class='mb-3'>
                                        <label for='salary' class='form-label'>Salary</label>
                                        <input type='text' class='form-control' id='salary' name='salary' value='{$row['salary']}' required>
                                    </div>
                                    <div class='mb-3'>
                                        <label for='position' class='form-label'>Position</label>
                                        <input type='text' class='form-control' id='position' name='position' value='{$row['position']}' required>
                                    </div>
                                    <div class='mb-3'>
                                        <label for='jobDetail' class='form-label'>Job Detail</label>
                                        <textarea class='form-control' id='jobDetail' name='jobDetail' required>{$row['jobDetail']}</textarea>
                                    </div>

                                            <div class='mb-3'>
                                                <label for='jobStatus' class='form-label'>Job Status</label>
                                                <select class='form-select' id='jobStatus' name='jobStatus' required>
                                                    <option value='open' " . ($row['jobStatus'] == 'open' ? 'selected' : '') . ">Open</option>
                                                    <option value='close' " . ($row['jobStatus'] == 'close' ? 'selected' : '') . ">Close</option>
                                                </select>
                                            </div>


                                            <input type='hidden' name='jobId' value='{$jobId}'>
                                            <button type='submit' class='btn btn-warning'>Update Job</button>
                                        </form>
                                    </div>
                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-danger' data-bs-dismiss='modal'>Close</button>
                                    </div>
                                </div>
                            </div>
                            </div>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
<?php
} else {
    echo "<p>No jobs posted yet.</p>";
}

include('./inc/footer.php');
?>