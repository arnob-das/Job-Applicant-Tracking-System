<?php
include('./inc/header.php');
include('../backend/config/database.php');

// Check if the user is an admin (replace it with your actual authentication logic)
if (isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'admin') {
    // Admin is logged in
} else {
    // Redirect if the user is not an admin
    header("Location: http://localhost/varsity/project/Job-Applicant-Tracking-System/frontend/index.php");
    exit();
}

// Handle actions (approve, reject, delete)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && isset($_POST['jobAdvertiserId'])) {
        $action = $_POST['action'];
        $jobAdvertiserId = $_POST['jobAdvertiserId'];

        switch ($action) {
            case 'approve':
                // Update the 'Verify' column to TRUE for the selected job advertiser
                $updateQuery = "UPDATE JOBADVERTISER SET Verify = TRUE WHERE Email = '$jobAdvertiserId'";
                mysqli_query($conn, $updateQuery);
                break;

            case 'reject':
                // Update the 'Verify' column to FALSE for the selected job advertiser
                $updateQuery = "UPDATE JOBADVERTISER SET Verify = FALSE WHERE Email = '$jobAdvertiserId'";
                mysqli_query($conn, $updateQuery);
                break;

            case 'delete':
                // Delete the jobs associated with the job advertiser
                $deleteJobsQuery = "DELETE FROM JOBS WHERE postedBy = '$jobAdvertiserId'";
                mysqli_query($conn, $deleteJobsQuery);

                $deleteQuery = "DELETE FROM JOBADVERTISER WHERE Email = '$jobAdvertiserId'";
                mysqli_query($conn, $deleteQuery);
                break;
        }
    }
}

// Fetch job advertisers who are not verified
$selectQuery = "SELECT * FROM JOBADVERTISER WHERE Verify = FALSE";
$result = mysqli_query($conn, $selectQuery);
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Manage Job Advertisers</h2>

    <table class="table">
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['FullName']}</td>";
                echo "<td>{$row['Email']}</td>";
                echo "<td>
                        <form action='' method='post' class='d-flex'>
                            <select name='action' class='form-select me-3'>
                                <option value='approve'>Approve</option>
                                <option value='reject'>Reject</option>
                                <option value='delete'>Delete</option>
                            </select>
                            <input type='hidden' name='jobAdvertiserId' value='{$row['Email']}'>
                            <button type='submit' class='btn btn-primary'>Submit</button>
                        </form>
                      </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<?php include('./inc/footer.php'); ?>