<?php
session_start();
require_once 'db_connect.php';
// Check if user is logged in by verifying session variables
if (!isset($_SESSION['admin_id'])) {
    // If user is not logged in, set a Toastr message and redirect to login page
    $_SESSION['toastr_message'] = 'You must log in to access this page.';
    $_SESSION['toastr_type'] = 'error';
    header("Location: ../Admin/login.php"); // Redirect to login page
    exit(); // Stop further code execution
}
?>
