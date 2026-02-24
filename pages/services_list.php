<?php
include dirname(__DIR__)."/db.php";
$result = mysqli_query($conn, "SELECT * FROM services ORDER BY service_id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Services</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include dirname(__DIR__)."/nav.php"; ?>

<div class="container-fluid py-5">
  <div class="row mb-4">
    <div class="col-md-8">
      <h1 class="fw-bold">Services Management</h1>
    </div>
  </div>

  <div class="card shadow">
    <div class="table-responsive">
      <table class="table table-hover mb-0">
        <thead class="table-dark">
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Rate</th>
            <th>Active</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
              <td><strong>#<?php echo $row['service_id']; ?></strong></td>
              <td><?php echo htmlspecialchars($row['service_name']); ?></td>
              <td>₱<?php echo number_format($row['hourly_rate'],2); ?></td>
              <td><?php echo $row['is_active'] ? "Yes" : "No"; ?></td>
              <td>
                <a href="services_edit.php?id=<?php echo $row['service_id']; ?>" class="btn btn-sm btn-warning">Edit</a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>