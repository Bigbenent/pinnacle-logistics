<?php
session_start();
require 'db_connect.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Check if email already exists
    $stmt = $pdo->prepare("SELECT * FROM admins WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        $_SESSION['toastr_message'] = "Email already registered!";
        $_SESSION['toastr_type'] = "error";
        header("Location: ../admin/register.php");
        exit();
    }

    // Insert new admin
    $stmt = $pdo->prepare("INSERT INTO admins (name, email, password) VALUES (?, ?, ?)");
    if ($stmt->execute([$name, $email, $password])) {
        $_SESSION['toastr_message'] = "Registration successful! Please login.";
        $_SESSION['toastr_type'] = "success";
        header("Location: ../admin/index.php");
        exit();
    } else {
        $_SESSION['toastr_message'] = "Registration failed!";
        $_SESSION['toastr_type'] = "error";
        header("Location: ../admin/register.php");
        exit();
    }
}
?>
