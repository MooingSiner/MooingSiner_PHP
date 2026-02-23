<?php
include "db.php";
 
$clients = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM clients"))['c'];
$services = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM services"))['c'];
$bookings = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM bookings"))['c'];
 
$revRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT IFNULL(SUM(amount_paid),0) AS s FROM payments"));
$revenue = $revRow['s'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include "nav.php"; ?>

<div class="container-fluid py-5">
  <div class="row mb-4">
    <div class="col-md-12">
      <h1 class="display-4 fw-bold">Dashboard</h1>
      <hr class="my-4">
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 col-lg-3 mb-4">
      <div class="card border-primary h-100">
        <div class="card-body">
          <h6 class="card-title text-primary text-uppercase fw-bold">Total Clients</h6>
          <h2 class="card-text fw-bold text-primary"><?php echo $clients; ?></h2>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3 mb-4">
      <div class="card border-success h-100">
        <div class="card-body">
          <h6 class="card-title text-success text-uppercase fw-bold">Total Services</h6>
          <h2 class="card-text fw-bold text-success"><?php echo $services; ?></h2>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3 mb-4">
      <div class="card border-info h-100">
        <div class="card-body">
          <h6 class="card-title text-info text-uppercase fw-bold">Total Bookings</h6>
          <h2 class="card-text fw-bold text-info"><?php echo $bookings; ?></h2>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3 mb-4">
      <div class="card border-warning h-100">
        <div class="card-body">
          <h6 class="card-title text-warning text-uppercase fw-bold">Total Revenue</h6>
          <h2 class="card-text fw-bold text-warning">₱<?php echo number_format($revenue,2); ?></h2>
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-5">
    <div class="col-md-12">
      <h5 class="mb-3">Quick Links</h5>
      <a href="/assess/pages/clients_add.php" class="btn btn-primary me-2"><i class="bi bi-person-plus"></i> Add Client</a>
      <a href="/assess/pages/bookings_create.php" class="btn btn-success"><i class="bi bi-calendar-plus"></i> Create Booking</a>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>