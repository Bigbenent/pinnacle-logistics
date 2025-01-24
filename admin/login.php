<?php
session_start();
?>
    <?php include 'head.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Admin Panel</title>
</head>
<style>
 
    .login-box{
        max-width: 50%;
        margin: auto;
        padding: 20px;
        border: 1px solid black;
    }
    .container .login-box{
       margin-top: 50px;

    }
 
  .toast-success {
    background-color: #28a745 !important; /* Green */
    color: #fff !important;
  }
  .toast-error {
    background-color: #dc3545 !important; /* Red */
    color: #fff !important;
  }
  .toast-info {
    background-color: #17a2b8 !important; /* Blue */
    color: #fff !important;
  }
  .toast-warning {
    background-color: #ffc107 !important; /* Yellow */
    color: #fff !important;
  }

</style>
<body>

<div class="container">
    <div class="login-box mb-5">
        <h2 class="text-center">Admin Login</h2>
        <form action="../controller/adminlogin.php" method="POST">
            <div class="mb-3">
                <label for="email">Email Address</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    <?php if (isset($_SESSION['toastr_message']) && isset($_SESSION['toastr_type'])): ?>
        toastr.<?php echo $_SESSION['toastr_type']; ?>('<?php echo $_SESSION['toastr_message']; ?>');
        <?php unset($_SESSION['toastr_message']); unset($_SESSION['toastr_type']); ?>
    <?php endif; ?>
</script>

</body>
</html>
