<?php
include('./inc/header.php');
include('../backend/config/database.php');
?>

<?php
// Handle actions (approve, reject, delete)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && isset($_POST['jobId'])) {
        $action = $_POST['action'];
        $jobId = $_POST['jobId'];

        switch ($action) {
            case 'approve':
                // Update the 'Verify' column to TRUE for the selected job
                $updateQuery = "UPDATE JOBS SET Verify = TRUE WHERE JobId = $jobId";
                mysqli_query($conn, $updateQuery);
                break;

            case 'reject':
                // Update the 'Verify' column to FALSE for the selected job
                $updateQuery = "UPDATE JOBS SET Verify = FALSE WHERE JobId = $jobId";
                mysqli_query($conn, $updateQuery);
                break;

            case 'delete':
                // Now you can safely delete the job
                $deleteQuery = "DELETE FROM JOBS WHERE JobId = $jobId";
                mysqli_query($conn, $deleteQuery);
                break;
        }
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center mb-4">Manage Jobs</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Job Title</th>
                        <th>Company</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Retrieve jobs from the database
                    $jobsQuery = "SELECT * FROM JOBS where verify = false";
                    $jobsResult = mysqli_query($conn, $jobsQuery);

                    while ($row = mysqli_fetch_assoc($jobsResult)) {
                        echo "<tr>";
                        echo "<td>{$row['JobTitle']}</td>";
                        echo "<td>{$row['company']}</td>";
                        echo "<td>
                                <form class='d-flex' action='' method='post'>
                                    <select name='action' class='form-select me-3' required>
                                        <option value='approve'>Approve</option>
                                        <option value='reject'>Reject</option>
                                        <option value='delete'>Delete</option>
                                    </select>
                                    <input type='hidden' name='jobId' value='{$row['JobId']}'>
                                    <button type='submit' class='btn btn-primary btn-sm'>Submit</button>
                                </form>
                            </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include('./inc/footer.php'); ?>
