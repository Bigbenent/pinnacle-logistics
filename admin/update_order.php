<?php
session_start();
include('../controller/db_connect.php'); // Include database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $id = $_POST['id'];
    $sender_name = $_POST['sender_name'];
    $sender_phone = $_POST['sender_phone'];
    $recipient_name = $_POST['recipient_name'];
    $recipient_phone = $_POST['recipient_phone'];
    $recipient_address = $_POST['recipient_address'];
    $shipment_type = $_POST['shipment_type'];
    $weight = $_POST['weight'];
    $departure_date = $_POST['departure_date'];
    $arrival_date = $_POST['arrival_date'];

    // Update the order in the database
    $sql = "UPDATE orders SET 
                sender_name = :sender_name, 
                sender_phone = :sender_phone, 
                recipient_name = :recipient_name, 
                recipient_phone = :recipient_phone, 
                recipient_address = :recipient_address, 
                shipment_type = :shipment_type, 
                weight = :weight, 
                departure_date = :departure_date, 
                arrival_date = :arrival_date
            WHERE order_id = :id";

    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute([
        'id' => $id,
        'sender_name' => $sender_name,
        'sender_phone' => $sender_phone,
        'recipient_name' => $recipient_name,
        'recipient_phone' => $recipient_phone,
        'recipient_address' => $recipient_address,
        'shipment_type' => $shipment_type,
        'weight' => $weight,
        'departure_date' => $departure_date,
        'arrival_date' => $arrival_date,
    ]);

    // Check if the update was successful
    if ($result) {
        $_SESSION['toastr_message'] = 'Order updated successfully!';
        $_SESSION['toastr_type'] = 'success';
    } else {
        $_SESSION['toastr_message'] = 'Failed to update order. Please try again.';
        $_SESSION['toastr_type'] = 'error';
    }

    // Redirect back to the manage orders page
    header("Location: vieworder.php");
    exit();
}
?>
