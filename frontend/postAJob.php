<?php

include('./inc/header.php');
include('../backend/config/database.php');


if (isset($_SESSION['userRole']) && $_SESSION['userRole'] != 'jobAdvertiser') {
    header("Location: http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/index.php");
    exit();
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center mb-4">Post Jobs</h2>
            <form class="mb-5" action="../backend/actions/postajobaction.php" method="post">
                <div class="mb-3">
                    <label for="jobTitle" class="form-label">Job Title</label>
                    <input type="text" class="form-control" id="jobTitle" name="jobTitle" placeholder="Data Science Engineer" required>
                </div>
                <div class="mb-3">
                    <label for="company" class="form-label">Company</label>
                    <input type="text" class="form-control" id="company" name="company" placeholder="Google" required>
                </div>
                <div class="mb-3">
                    <label for="salary" class="form-label">Salary</label>
                    <input type="text" class="form-control" id="salary" name="salary" placeholder="80000" required>
                </div>
                <div class="mb-3">
                    <label for="position" class="form-label">Position</label>
                    <input type="text" class="form-control" id="position" name="position" placeholder="Entry Level" required>
                </div>
                <div class="mb-3">
                    <label for="jobDetail" class="form-label">Job Detail</label>
                    <textarea class="form-control" id="jobDetail" name="jobDetail" placeholder="Details" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Post Job</button>
            </form>
        </div>
    </div>
</div>
<?php include('./inc/footer.php') ?>
</body>
</html>