<?php

include('./inc/header.php');

?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 mt-5">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title text-center">LOGIN</h2>
                    <form action="../backend/actions/signinAction.php" method="post">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        <!-- Display error message if exists -->
                        <?php if (!empty($_SESSION['loginError'])) : ?>
                            <div class="alert alert-danger mt-3" role="alert">
                                <?php echo $_SESSION['loginError']; ?>
                            </div>
                        <?php endif; ?>
                    </form>
                    <p class="mt-3 text-center">Not a user? Please <a href="http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/registration.php">Register Here</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>