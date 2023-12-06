<?php
include('./inc/header.php');
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 mt-5">
            <h2 class="text-center">REGISTER</h2>
            <form action="../backend/actions/registrationAction.php" method="post">
                <div class="mb-3">
                    <label for="fullName" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="fullName" name="fullName">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>

                <div class="mb-3">
                    <label for="contactNumber" class="form-label">Contact Number</label>
                    <input type="text" class="form-control" id="contactNumber" name="contactNumber">
                </div>
                <select class="form-select mb-3" aria-label="Default select example" name="role">
                    <option selected>Select Role</option>
                    <option value="jobAdvertiser">Job Advertiser</option>
                    <option value="candidate">Candidate</option>
                </select>
                <button type="submit" class="btn btn-primary">Submit</button>
                <!-- Display error message if exists -->
                <?php if (!empty($_SESSION['registrationError'])) : ?>
                    <div class="alert alert-danger my-2" role="alert">
                        <?php echo $_SESSION['registrationError']; ?>
                    </div>
                <?php endif; ?>


                <p class="mt-2">Already Registered? Please <a href="http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/login.php">Login</a></p>
            </form>
        </div>
    </div>
</div>
</body>

</html>