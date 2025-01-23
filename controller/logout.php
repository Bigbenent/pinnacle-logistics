<?php
session_start();

// Destroy session to log the user out
session_unset(); // Remove all session variables
session_destroy(); // Destroy the session

// Toastr message after logout
$_SESSION['toastr_message'] = 'You have been logged out successfully!';
$_SESSION['toastr_type'] = 'success';


// Redirect to the login page
header("Location: ../index.php");
exit();
?>
