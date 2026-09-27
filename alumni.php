<?php
require_once "db.php";

$sql = "SELECT id, full_name, email, phone,
        student_id, degree, department,
        graduation_year, current_job, company,
        city, country, created_at
        FROM alumni
        ORDER BY id DESC";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Alumni Directory</title>
<style>
body { font-family: Arial; background:#f1f5f9; padding:30px; }
.container { max-width:1400px; margin:auto; }
.top-bar { display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; }
.top-bar a {
    background:#2563eb; color:white; text-decoration:none;
    padding:10px 18px; border-radius:8px; font-size:14px;
}
.table-wrapper { overflow-x:auto; background:white; border-radius:8px; }
table { width:100%; border-collapse:collapse; background:white; }
th, td { padding:12px; border:1px solid #ddd; text-align:left; }
th { background:#2563eb; color:white; }
tr:nth-child(even) { background:#f8fafc; }
</style>
</head>
<body>
<div class="container">
    <div class="top-bar">
        <h1>Alumni Directory</h1>
        <a href="index.html">+ Register New Alumni</a>
    </div>

    <div class="table-wrapper">
    <table>
        <tr>
            <th>ID</th><th>Name</th><th>Email</th><th>Phone</th>
            <th>Student ID</th><th>Degree</th><th>Department</th>
            <th>Graduation</th><th>Job</th><th>Company</th>
            <th>City</th><th>Country</th><th>Registered</th>
        </tr>

        <?php if ($result->num_rows > 0) { ?>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= htmlspecialchars($row["id"]) ?></td>
                    <td><?= htmlspecialchars($row["full_name"]) ?></td>
                    <td><?= htmlspecialchars($row["email"]) ?></td>
                    <td><?= htmlspecialchars($row["phone"]) ?></td>
                    <td><?= htmlspecialchars($row["student_id"]) ?></td>
                    <td><?= htmlspecialchars($row["degree"]) ?></td>
                    <td><?= htmlspecialchars($row["department"]) ?></td>
                    <td><?= htmlspecialchars($row["graduation_year"]) ?></td>
                    <td><?= htmlspecialchars($row["current_job"]) ?></td>
                    <td><?= htmlspecialchars($row["company"]) ?></td>
                    <td><?= htmlspecialchars($row["city"]) ?></td>
                    <td><?= htmlspecialchars($row["country"]) ?></td>
                    <td><?= htmlspecialchars($row["created_at"]) ?></td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr><td colspan="13">No alumni registered yet.</td></tr>
        <?php } ?>
    </table>
    </div>
</div>
</body>
</html>
<?php $conn->close(); ?>