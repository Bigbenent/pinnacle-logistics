<?php
session_start();
include('../controller/db_connect.php'); // Include database connection

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Check if the order exists before attempting to delete
    $sql = "SELECT * FROM orders WHERE order_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    $order = $stmt->fetch();

    if ($order) {
        // Delete the order from the database
        $sql = "DELETE FROM orders WHERE order_id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);

        // Check if the deletion was successful
        if ($stmt->rowCount() > 0) {
            $_SESSION['toastr_message'] = 'Order deleted successfully!';
            $_SESSION['toastr_type'] = 'success';
        } else {
            $_SESSION['toastr_message'] = 'Failed to delete order. Please try again.';
            $_SESSION['toastr_type'] = 'error';
        }
    } else {
        $_SESSION['toastr_message'] = 'Order not found!';
        $_SESSION['toastr_type'] = 'error';
    }
}

// Redirect back to the manage orders page after deletion
header("Location: vieworder.php");
exit();
?>
