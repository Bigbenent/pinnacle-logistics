<?php
session_start();
include('db_connect.php'); // Include database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect and sanitize form data
    $sender_name = trim($_POST['sender_name']);
    $sender_phone = trim($_POST['sender_phone']);
    $recipient_name = trim($_POST['recipient_name']);
    $recipient_phone = trim($_POST['recipient_phone']);
    $recipient_address = trim($_POST['recipient_address']);
    $shipment_type = trim($_POST['shipment_type']);
    $weight = trim($_POST['weight']);
    $departure_date = trim($_POST['departure_date']);
    $arrival_date = trim($_POST['arrival_date']);

    // Server-side Validation
    if (empty($sender_name) || empty($sender_phone) || empty($recipient_name) || 
        empty($recipient_phone) || empty($recipient_address) || 
        empty($shipment_type) || empty($weight) || empty($departure_date)) {
        $_SESSION['toastr_message'] = 'All fields are required!';
        $_SESSION['toastr_type'] = 'error';
        header("Location: ../orders/register_order.php"); // Redirect to order form
        exit();
    }

    // Check if the departure date is valid (not in the past)
    if (strtotime($departure_date) < time()) {
        $_SESSION['toastr_message'] = 'Departure date cannot be in the past!';
        $_SESSION['toastr_type'] = 'error';
        header("Location: ../orders/register_order.php");
        exit();
    }
    
    if (strtotime($arrival_date) <= strtotime($departure_date)) {
        $_SESSION['toastr_message'] = 'Arrival date must be after the departure date!';
        $_SESSION['toastr_type'] = 'error';
        header("Location: ../orders/register_order.php");
        exit();
    }
    
    // Generate a unique tracking number
    $tracking_number = strtoupper('TRK-' . bin2hex(random_bytes(4)));

    // Insert the new order into the database
    $sql = "INSERT INTO orders (sender_name, sender_phone, recipient_name, recipient_phone, recipient_address, shipment_type, weight, departure_date,arrival_date, tracking_number, status) 
            VALUES (:sender_name, :sender_phone, :recipient_name, :recipient_phone, :recipient_address, :shipment_type, :weight, :departure_date,:arrival_date, :tracking_number, :status)";
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute([
        'sender_name' => $sender_name,
        'sender_phone' => $sender_phone,
        'recipient_name' => $recipient_name,
        'recipient_phone' => $recipient_phone,
        'recipient_address' => $recipient_address,
        'shipment_type' => $shipment_type,
        'weight' => $weight,
        'departure_date' => $departure_date,
        'arrival_date' => $arrival_date,
        'tracking_number' => $tracking_number,
        'status' => 'On Hold' // Default status
    ]);

    if ($result) {
        // Order registered successfully
        $_SESSION['toastr_message'] = 'Order registered successfully! Tracking Number: ' . $tracking_number;
        $_SESSION['toastr_type'] = 'success';
        header("Location: ../admin/registerorder.php"); // Redirect to manage orders page
        exit();
    } else {
        // Order registration failed
        $_SESSION['toastr_message'] = 'Failed to register order. Please try again.';
        $_SESSION['toastr_type'] = 'error';
        header("Location: ../admin/registerorder.php");
        exit();
    }
}
?>
