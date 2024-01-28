<?php
include('./inc/header.php');
include('../backend/config/database.php');

$sql = "SELECT * FROM JOBS where Verify = true and jobStatus = 'open'";
$result = $conn->query($sql);
?>

<div class="container mt-5">
    <h2 class="mb-4 text-center">Jobs Information</h2>

    <div class="row">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="col-md-4 mb-4">';
                echo "<a href='jobDetail.php?jobId={$row['JobId']}' class='text-decoration-none'>";
                echo '<div class="card h-100">';
                echo '<div class="card-body">';
                echo "<h5 class='card-title text-primary'>{$row['JobTitle']}</h5>";
                echo "<p class='card-text'><strong>Date Posted:</strong> {$row['dateposted']}</p>";
                echo "<p class='card-text'><strong>Company:</strong> {$row['company']}</p>";
                echo "<p class='card-text'><strong>Salary:</strong> {$row['salary']}</p>";
                echo "<p class='card-text'><strong>Position:</strong> {$row['position']}</p>";
                echo '</div>';
                echo '</div>';
                echo '</a>';
                echo '</div>';
            }
        } else {
            echo "<div class='col-md-12 text-center'><p>No jobs found</p></div>";
        }
        ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
