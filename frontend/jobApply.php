<?php
include('./inc/header.php');
include('../backend/config/database.php');

// Check if jobId is provided in the URL
if (isset($_GET['jobId'])) {
    $jobId = $_GET['jobId'];

    // Display the application form
?>
    <div class="container mt-4">
        <h2>Application Form</h2>
        <form action="../backend/actions/jobApplyAction.php" method="post" enctype="multipart/form-data">
            <!-- Hidden field to store jobId -->
            <input type="hidden" name="jobId" value="<?php echo $jobId; ?>">

            <!-- Upload CV/Resume -->
            <div class="mb-3">
                <label for="cv" class="form-label">Upload CV/Resume (PDF only)</label>
                <input type="file" class="form-control" id="cv" name="cv" accept=".pdf" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit Application</button>
            <?php
            //echo $_SESSION['applyError'];
            ?>
        </form>
    </div>
<?php
} else {
    // jobId not provided, redirect to an error page or handle accordingly
    header("Location: error.php");
    exit();
}

include('./inc/footer.php');
?>