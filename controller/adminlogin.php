<?php
session_start();
require 'db_connect.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM admins WHERE email = ?");
    $stmt->execute([$email]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_name'] = $admin['name'];
        
        $_SESSION['toastr_message'] = "Login successful!";
        $_SESSION['toastr_type'] = "success";
        header("Location: ../admin/index.php");
        exit();
    } else {
        $_SESSION['toastr_message'] = "Invalid email or password!";
        $_SESSION['toastr_type'] = "error";
        header("Location: ../admin/login.php");
        exit();
    }
}
?>
