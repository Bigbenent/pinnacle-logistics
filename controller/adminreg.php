<?php
session_start();
include('db_connect.php'); // Include database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $passwordHash = password_hash($password, PASSWORD_DEFAULT); // Hash the password

    // Server-side Validation
    if (empty($name) ||  empty($email) || empty($password)) {
        $_SESSION['toastr_message'] = 'All fields are required!';
        $_SESSION['toastr_type'] = 'error';
        header("Location: ../Admin/register.php"); // Redirect to registration page
        exit();
    }

    // Check if email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['toastr_message'] = 'Invalid email format!';
        $_SESSION['toastr_type'] = 'error';
        header("Location: ../Admin/register.php");
        exit();
    }

    // Check if the email already exists
    $sql = "SELECT * FROM admin WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if ($user) {
        // Username or email already exists
        $_SESSION['toastr_message'] = 'Username or Email already taken!';
        $_SESSION['toastr_type'] = 'error';
        header("Location: ../Admin/register.php"); // Redirect to registration page
        exit();
    } else {
        // Insert the new user into the database
        $sql = "INSERT INTO admin (name, email, password) 
                VALUES (:name, :email, :password)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'name' => $name, 
            'email' => $email, 
            'password' => $passwordHash
        ]);

        // Registration successful, show Toastr success and redirect to login page
        $_SESSION['toastr_message'] = 'Registration successful! Please log in.';
        $_SESSION['toastr_type'] = 'success';
        header("Location: ../Admin/login.php"); // Redirect to login page
        exit();
    }
}
?>
