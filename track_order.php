<?php
session_start();
require 'controller/db_connect.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tracking_number = trim($_POST['tracking_number']); // Fix incorrect input name

    if (!empty($tracking_number)) {
        try {
            // Query to check tracking number
            $stmt = $pdo->prepare("SELECT * FROM orders WHERE tracking_number = :tracking_number");
            $stmt->bindParam(':tracking_number', $tracking_number, PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $_SESSION['tracking_details'] = $stmt->fetch(PDO::FETCH_ASSOC);
                $_SESSION['success'] = "This is your Package Details.";
                header("Location: track.php"); // Redirect to delivery details page
                exit();
            } else {
                $_SESSION['error'] = "Tracking number not found!";
                header("Location: index.php"); // Redirect back to tracking form
                exit();
            }
        } catch (PDOException $e) {
            $_SESSION['error'] = "Database error: " . $e->getMessage();
            header("Location: index.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Please enter a tracking number.";
        header("Location: index.php");
        exit();
    }
}
?>
