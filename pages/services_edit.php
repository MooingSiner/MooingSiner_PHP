<?php
include dirname(__DIR__)."/db.php";
 
$id = $_GET['id'];
 
$stmt = $conn->prepare("SELECT * FROM services WHERE service_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$get = $stmt->get_result();
$service = mysqli_fetch_assoc($get);
 
if (isset($_POST['update'])) {
  $name = $_POST['service_name'];
  $desc = $_POST['description'];
  $rate = $_POST['hourly_rate'];
  $active = $_POST['is_active'];
 
  $stmt = $conn->prepare("UPDATE services SET service_name=?, description=?, hourly_rate=?, is_active=? WHERE service_id=?");
  $stmt->bind_param("sssii", $name, $desc, $rate, $active, $id);
  $stmt->execute();
 
  header("Location: /assess/pages/services_list.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Service</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include dirname(__DIR__)."/nav.php"; ?>

<div class="container py-5">
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <div class="card shadow">
        <div class="card-body p-5">
          <h2 class="card-title mb-4">Edit Service</h2>
          
          <form method="post">
            <div class="mb-3">
              <label for="service_name" class="form-label">Service Name <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="service_name" name="service_name" value="<?php echo htmlspecialchars($service['service_name']); ?>" required>
            </div>

            <div class="mb-3">
              <label for="description" class="form-label">Description</label>
              <textarea class="form-control" id="description" name="description" rows="4"><?php echo htmlspecialchars($service['description']); ?></textarea>
            </div>

            <div class="mb-3">
              <label for="hourly_rate" class="form-label">Hourly Rate <span class="text-danger">*</span></label>
              <input type="number" step="0.01" class="form-control" id="hourly_rate" name="hourly_rate" value="<?php echo htmlspecialchars($service['hourly_rate']); ?>" required>
            </div>

            <div class="mb-3">
              <label for="is_active" class="form-label">Active</label>
              <select class="form-select" id="is_active" name="is_active">
                <option value="1" <?php if($service['is_active']==1) echo "selected"; ?>>Yes</option>
                <option value="0" <?php if($service['is_active']==0) echo "selected"; ?>>No</option>
              </select>
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
              <a href="services_list.php" class="btn btn-secondary">Cancel</a>
              <button type="submit" name="update" class="btn btn-primary">Update Service</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>