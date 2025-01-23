<?php
session_start();
include('db_connect.php'); // Include your database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Check if the fields are empty
    if (empty($email) || empty($password)) {
        $_SESSION['toastr_message'] = 'Email and Password are required!';
        $_SESSION['toastr_type'] = 'error';
        header("Location: ../users/login.php"); // Redirect to login page with error message
        exit();
    }

    // Fetch the user from the database
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if ($user) {
        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Password is correct, log the user in
            $_SESSION['user_id'] = $user['id']; // Store user ID in session
            $_SESSION['toastr_message'] = 'Login successful!';
            $_SESSION['toastr_type'] = 'success';
            header("Location: ../users/index.php"); // Redirect to user dashboard
            exit();
        } else {
            // Password is incorrect
            $_SESSION['toastr_message'] = 'Incorrect password!';
            $_SESSION['toastr_type'] = 'error';
            header("Location: ../users/login.php"); // Redirect to login page with error message
            exit();
        }
    } else {
        // Email not found
        $_SESSION['toastr_message'] = 'Email not found!';
        $_SESSION['toastr_type'] = 'error';
        header("Location: ../users/login.php"); // Redirect to login page with error message
        exit();
    }
}
?>
