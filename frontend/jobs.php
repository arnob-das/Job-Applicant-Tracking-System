<?php
include('./inc/header.php');
include('../backend/config/database.php');

$sql = "SELECT * FROM JOBS";
$result = $conn->query($sql);
?>

<div class="container mt-5">
    <h2 class="mb-4">Jobs Information</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
               
                <th>Job Title</th>
                <th>Date Posted</th>
                <th>Company</th>
                <th>Salary</th>
                <th>Position</th>
                <th>Posted By</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    
                    echo "<td>{$row['JobTitle']}</td>";
                    echo "<td>{$row['dateposted']}</td>";
                    echo "<td>{$row['company']}</td>";
                    echo "<td>{$row['salary']}</td>";
                    echo "<td>{$row['position']}</td>";
                    echo "<td>{$row['postedBy']}</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No jobs found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
$conn->close();
?>