<?php
include('./inc/header.php');
include('../backend/config/database.php');

// Check if jobId is provided in the URL
if (isset($_GET['jobId'])) {
    $jobId = $_GET['jobId'];

    // Use prepared statement to fetch job details from the JOBS table
    $jobQuery = "SELECT * FROM JOBS WHERE JobId = ?";
    $stmt = mysqli_prepare($conn, $jobQuery);

    if ($stmt) {
        // Bind the parameter
        mysqli_stmt_bind_param($stmt, "i", $jobId);

        // Execute the statement
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            // Get the result set
            $jobResult = mysqli_stmt_get_result($stmt);

            if ($jobResult && mysqli_num_rows($jobResult) > 0) {
                $jobDetails = mysqli_fetch_assoc($jobResult);
?>
                <div class="container mt-4">
                    <h2><?php echo $jobDetails['JobTitle']; ?> Details</h2>
                    <div class="card">
                        <div class="card-body">
                            <p><strong>Date Posted:</strong> <?php echo $jobDetails['dateposted']; ?></p>
                            <p><strong>Company:</strong> <?php echo $jobDetails['company']; ?></p>
                            <p><strong>Salary:</strong> <?php echo $jobDetails['salary']; ?></p>
                            <p><strong>Position:</strong> <?php echo $jobDetails['position']; ?></p>
                            <p><strong>Job Detail:</strong> <?php echo $jobDetails['jobDetail']; ?></p>
                            <?php
                            if ($_SESSION['userRole'] == "candidate") {
                                echo "<a class='btn btn-primary' href='jobApply.php?jobId={$jobId}'>Apply</a>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
<?php
            } else {
                // Job not found, redirect to an error page or handle accordingly
                header("Location: error.php");
                exit();
            }
        } else {
            // Error executing the statement
            header("Location: error.php");
            exit();
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Error in prepared statement
        header("Location: error.php");
        exit();
    }
} else {
    // jobId not provided, redirect to an error page or handle accordingly
    header("Location: error.php");
    exit();
}

include('./inc/footer.php');
?>