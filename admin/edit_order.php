<?php
session_start();
include('../controller/db_connect.php'); // Include database connection

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Fetch order details based on the order ID
    $sql = "SELECT * FROM orders WHERE order_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    $order = $stmt->fetch();

    if (!$order) {
        $_SESSION['toastr_message'] = 'Order not found!';
        $_SESSION['toastr_type'] = 'error';
        header("Location: manage_orders.php");
        exit();
    }
}
?>
<?php require_once 'head.php'; ?>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Sidebar Start -->
        <?php require_once 'sidebar.php'; ?>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php require_once 'navbar.php'; ?>
            <!-- Navbar End -->

            <div class="container mt-5">
                <h1 class="text-center">Edit Order</h1>
                <form action="update_order.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $order['order_id']; ?>">

                    <div class="form-group">
                        <label for="sender_name">Sender Name</label>
                        <input type="text" class="form-control" id="sender_name" name="sender_name" value="<?php echo $order['sender_name']; ?>" >
                    </div>

                    <div class="form-group">
                        <label for="sender_phone">Sender Phone</label>
                        <input type="text" class="form-control" id="sender_phone" name="sender_phone" value="<?php echo $order['sender_phone']; ?>" >
                    </div>

                    <div class="form-group">
                        <label for="recipient_name">Recipient Name</label>
                        <input type="text" class="form-control" id="recipient_name" name="recipient_name" value="<?php echo $order['recipient_name']; ?>" >
                    </div>

                    <div class="form-group">
                        <label for="recipient_phone">Recipient Phone</label>
                        <input type="text" class="form-control" id="recipient_phone" name="recipient_phone" value="<?php echo $order['recipient_phone']; ?>" >
                    </div>

                    <div class="form-group">
                        <label for="recipient_address">Recipient Address</label>
                        <input type="text" class="form-control" id="recipient_address" name="recipient_address" value="<?php echo $order['recipient_address']; ?>" >
                    </div>

                    <div class="mb-3">
                                <label for="shipmentType" class="form-label">Shipment Type</label>
                                <select class="form-select" id="shipmentType" name="shipment_type" required>
                                    <option value="" disabled selected>Select shipment type</option>
                                    <option value="Cargo">Cargo</option>
                                    <option value="Truck">Truck</option>
                                    <option value="freight">Freight</option>
                                </select>
                            </div>

                    <div class="form-group">
                        <label for="weight">Weight</label>
                        <input type="text" class="form-control" id="weight" name="weight" value="<?php echo $order['weight']; ?>" >
                    </div>

                    <div class="form-group">
                        <label for="departure_date">Departure Date</label>
                        <input type="date" class="form-control" id="departure_date" name="departure_date" value="<?php echo $order['departure_date']; ?>" >
                    </div>

                    <div class="form-group">
                        <label for="arrival_date">Arrival Date</label>
                        <input type="date" class="form-control" id="arrival_date" name="arrival_date" value="<?php echo $order['arrival_date']; ?>" >
                    </div>

                 

                    <button type="submit" class="btn btn-success mt-4">Update Order</button>
                </form>
            </div>

            <!-- Footer Start -->
            <?php require_once 'footer.php'; ?>
            <!-- Footer End -->

            <?php
            // Display Toastr messages
            if (isset($_SESSION['toastr_message']) && isset($_SESSION['toastr_type'])) {
                echo "
                <script>
                    $(document).ready(function() {
                        toastr.{$_SESSION['toastr_type']}('{$_SESSION['toastr_message']}');
                    });
                </script>";
                unset($_SESSION['toastr_message']);
                unset($_SESSION['toastr_type']);
            }
            ?>
        </div>
    </div>
</body>
</html>
