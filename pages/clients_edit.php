<?php
include dirname(__DIR__)."/db.php";
 
$id = $_GET['id'];
 
$stmt = $conn->prepare("SELECT * FROM clients WHERE client_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$get = $stmt->get_result();
$client = mysqli_fetch_assoc($get);
 
$message = "";
 
if (isset($_POST['update'])) {
  $full_name = $_POST['full_name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
 
  if ($full_name == "" || $email == "") {
    $message = "Name and Email are required!";
  } else {
    $stmt = $conn->prepare("UPDATE clients SET full_name=?, email=?, phone=?, address=? WHERE client_id=?");
    $stmt->bind_param("ssssi", $full_name, $email, $phone, $address, $id);
    $stmt->execute();
    header("Location: /assess/pages/clients_list.php");
    exit;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Client</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include dirname(__DIR__)."/nav.php"; ?>

<div class="container py-5">
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <div class="card shadow">
        <div class="card-body p-5">
          <h2 class="card-title mb-4">Edit Client</h2>
          
          <?php if ($message != "") { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <?php echo $message; ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          <?php } ?>
          
          <form method="post">
            <div class="mb-3">
              <label for="full_name" class="form-label">Full Name <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo htmlspecialchars($client['full_name']); ?>" required>
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
              <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($client['email']); ?>" required>
            </div>

            <div class="mb-3">
              <label for="phone" class="form-label">Phone</label>
              <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($client['phone']); ?>">
            </div>

            <div class="mb-3">
              <label for="address" class="form-label">Address</label>
              <textarea class="form-control" id="address" name="address" rows="3"><?php echo htmlspecialchars($client['address']); ?></textarea>
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
              <a href="clients_list.php" class="btn btn-secondary">Cancel</a>
              <button type="submit" name="update" class="btn btn-primary">Update Client</button>
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