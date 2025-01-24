<?php
session_start();
if (!isset($_SESSION['tracking_details'])) {
    header("Location: index.php");
    exit();
}

$delivery = $_SESSION['tracking_details']; // Retrieve tracking details
unset($_SESSION['tracking_details']); // Clear session data
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Details</title>
<!-- Include Toastr CSS in the <head> section -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body>

<h2>Delivery Details</h2>
<p><strong>Tracking Number:</strong> <?php echo htmlspecialchars($delivery['tracking_number']); ?></p>
<p><strong>Status:</strong> <?php echo htmlspecialchars($delivery['status']); ?></p>
<p><strong>Estimated Delivery:</strong> <?php echo htmlspecialchars($delivery['estimated_delivery_date']); ?></p>
<p><strong>Current Location:</strong> <?php echo htmlspecialchars($delivery['current_location']); ?></p>



<!-- jQuery and Toastr JS, place these just before </body> -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Make sure jQuery is loaded before Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
$(document).ready(function() {
    <?php if (isset($_SESSION['error'])) { ?>
        toastr.error("<?php echo $_SESSION['error']; ?>");
        <?php unset($_SESSION['error']); ?>
    <?php } ?>

    <?php if (isset($_SESSION['success'])) { ?>
        toastr.success("<?php echo $_SESSION['success']; ?>");
        <?php unset($_SESSION['success']); ?>
    <?php } ?>
});
</script>

</body>
</html>
