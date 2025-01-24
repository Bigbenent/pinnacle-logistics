<?php
session_start();
include('../controller/db_connect.php'); // Include database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data and sanitize
    $id = trim($_POST['id']);
    $sender_name = trim($_POST['sender_name']);
    $sender_phone = trim($_POST['sender_phone']);
    $recipient_name = trim($_POST['recipient_name']);
    $recipient_phone = trim($_POST['recipient_phone']);
    $recipient_email = trim($_POST['recipient_email'] ?? ''); // Handle missing field
    $recipient_address = trim($_POST['recipient_address']);
    $shipment_type = trim($_POST['shipment_type']);
    $current_location = trim($_POST['current_location']);
    $weight = trim($_POST['weight']);
    $track_point = trim($_POST['track_point'] ?? '');
    $desc = trim($_POST['desc'] ?? '');
    $departure_date = trim($_POST['departure_date']);
    $arrival_date = trim($_POST['arrival_date']);

    // Server-side Validation
    if (empty($id) || empty($sender_name) || empty($sender_phone) || empty($recipient_name) || 
        empty($recipient_phone) || empty($recipient_address) || empty($shipment_type) || 
        empty($weight) || empty($departure_date)) {
        $_SESSION['toastr_message'] = 'All fields are required!';
        $_SESSION['toastr_type'] = 'error';
        header("Location: vieworder.php");
        exit();
    }

    // Validate dates
    if (strtotime($departure_date) < time()) {
        $_SESSION['toastr_message'] = 'Departure date cannot be in the past!';
        $_SESSION['toastr_type'] = 'error';
        header("Location: vieworder.php");
        exit();
    }

    if (strtotime($arrival_date) <= strtotime($departure_date)) {
        $_SESSION['toastr_message'] = 'Arrival date must be after the departure date!';
        $_SESSION['toastr_type'] = 'error';
        header("Location: vieworder.php");
        exit();
    }

    // Update order in the database
    $sql = "UPDATE orders SET 
                sender_name = :sender_name, 
                sender_phone = :sender_phone, 
                recipient_name = :recipient_name, 
                recipient_phone = :recipient_phone, 
                recipient_email = :recipient_email,
                recipient_address = :recipient_address, 
                shipment_type = :shipment_type, 
                current_location = :current_location, 
                weight = :weight, 
                track_point = :track_point, 
                `desc` = :desc, 
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
        'recipient_email' => $recipient_email,
        'recipient_address' => $recipient_address,
        'shipment_type' => $shipment_type,
        'current_location' => $current_location,
        'weight' => $weight,
        'track_point' => $track_point,
        'desc' => $desc,
        'departure_date' => $departure_date,
        'arrival_date' => $arrival_date,
    ]);

    // Success or failure message
    if ($result) {
        $_SESSION['toastr_message'] = 'Order updated successfully!';
        $_SESSION['toastr_type'] = 'success';
    } else {
        $_SESSION['toastr_message'] = 'Failed to update order. Please try again.';
        $_SESSION['toastr_type'] = 'error';
    }

    // Redirect to view orders page
    header("Location: vieworder.php");
    exit();
}
?>
