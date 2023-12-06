<?php

include('./inc/header.php');

?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 mt-5">
            <h2 class="text-center">LOGIN</h2>
            <form action="../backend/actions/signinAction.php" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <!-- Display error message if exists -->
                <?php if (!empty($_SESSION['loginError'])) : ?>
                    <div class="alert alert-danger my-2" role="alert">
                        <?php echo $_SESSION['loginError']; ?>
                    </div>
                <?php endif; ?>
                <p class="mt-2">Not a user? Please <a href="http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/registration.php">Register Here</a></p>
            </form>
        </div>
    </div>
</div>
</body>

</html>