<?php
include('../backend/config/database.php');
include('./inc/header.php');
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 mt-5">
            <h2 class="text-center">REGISTER</h2>
            <form>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1">
                </div>

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Contact Number</label>
                    <input type="text" class="form-control" id="exampleInputPassword1">
                </div>
                <select class="form-select mb-3" aria-label="Default select example">
                    <option selected>Select Role</option>
                    <option value="1">Job Advertiser</option>
                    <option value="2">Candidate</option>
                </select>
                <button type="submit" class="btn btn-primary">Submit</button>
                <p class="mt-2">Already Registered? Please <a href="http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/login.php">Login</a></p>
            </form>
        </div>
    </div>
</div>
</body>

</html>