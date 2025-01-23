<?php
session_start();
include('../controller/db_connect.php'); // Include database connection
?>
<?php require_once 'head.php' ?>

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
        <?php require_once 'sidebar.php' ?>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php require_once 'navbar.php' ?>
            <!-- Navbar End -->

            <div class="container mt-5">
                <h1 class="text-center">Manage Orders</h1>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>Tracking Number</th>
                                <th>Sender Name</th>
                                <th>Sender Phone</th>
                                <th>Recipient Name</th>
                                <th>Recipient Phone</th>
                                <th>Recipient Address</th>
                                <th>Shipment Type</th>
                                <th>Weight</th>
                                <th>Departure Date</th>
                                <th>Arrival Date</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql = "SELECT * FROM orders ORDER BY created_at DESC";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();
                        $orders = $stmt->fetchAll();

                        if (empty($orders)) {
                            echo "<tr><td colspan='14' class='text-center'><img src='path/to/no-data-found-image.png' alt='No Data Found'></td></tr>";
                        } else {
                            foreach ($orders as $order) {
                                echo "<tr>
                                    <td>{$order['tracking_number']}</td>
                                    <td>{$order['sender_name']}</td>
                                    <td>{$order['sender_phone']}</td>
                                    <td>{$order['recipient_name']}</td>
                                    <td>{$order['recipient_phone']}</td>
                                    <td>{$order['recipient_address']}</td>
                                    <td>{$order['shipment_type']}</td>
                                    <td>{$order['weight']}</td>
                                    <td>{$order['departure_date']}</td>
                                    <td>{$order['arrival_date']}</td>
                                    <td>{$order['status']}</td>
                                    <td>{$order['created_at']}</td>
                                    <td>
                                        <a href='edit_order.php?id={$order['order_id']}' class='btn btn-warning btn-sm'>Edit</a>
                                    </td>
                                    <td>
                                        <a href='delete_order.php?id={$order['order_id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this order?\")'>Delete</a>
                                    </td>
                                </tr>";
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Footer Start -->
            <?php require_once 'footer.php' ?>
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
