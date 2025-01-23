<?php 
session_start();
require_once 'head.php' ?>

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


            <!-- Blank Start -->
            <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h4 class="text-light">Register Order for Delivery</h4>
                    </div>
                    <div class="card-body">
                        <form action="../controller/order_reg.php" method="POST">
                            <!-- Sender Details -->
                            <h5 class="text-primary">Sender Details</h5>
                            <div class="mb-3">
                                <label for="senderName" class="form-label">Sender's Name</label>
                                <input type="text" class="form-control" id="senderName" name="sender_name" placeholder="Enter sender's name" required>
                            </div>
                            <div class="mb-3">
                                <label for="senderPhone" class="form-label">Sender's Phone</label>
                                <input type="tel" class="form-control" id="senderPhone" name="sender_phone" placeholder="Enter sender's phone number" required>
                            </div>

                            <!-- Recipient Details -->
                            <h5 class="text-primary">Recipient Details</h5>
                            <div class="mb-3">
                                <label for="recipientName" class="form-label">Recipient's Name</label>
                                <input type="text" class="form-control" id="recipientName" name="recipient_name" placeholder="Enter recipient's name" required>
                            </div>
                            <div class="mb-3">
                                <label for="recipientPhone" class="form-label">Recipient's Phone</label>
                                <input type="tel" class="form-control" id="recipientPhone" name="recipient_phone" placeholder="Enter recipient's phone number" required>
                            </div>
                            <div class="mb-3">
                                <label for="recipientAddress" class="form-label">Recipient's Address</label>
                                <textarea class="form-control" id="recipientAddress" name="recipient_address" rows="3" placeholder="Enter recipient's address" required></textarea>
                            </div>

                            <!-- Shipment Details -->
                            <h5 class="text-primary">Shipment Details</h5>
                            <div class="mb-3">
                                <label for="shipmentType" class="form-label">Shipment Type</label>
                                <select class="form-select" id="shipmentType" name="shipment_type" required>
                                    <option value="" disabled selected>Select shipment type</option>
                                    <option value="Cargo">Cargo</option>
                                    <option value="Truck">Truck</option>
                                    <option value="freight">Freight</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="weight" class="form-label">Weight (kg)</label>
                                <input type="number" class="form-control" id="weight" name="weight" placeholder="Enter weight in kilograms" required>
                            </div>
                            <div class="mb-3">
                                <label for="departureDate" class="form-label">departure Date</label>
                                <input type="date" class="form-control" id="departureDate" name="departure_date" required>
                            </div>
                            <div class="mb-3">
                                <label for="arrivalDate" class="form-label">Arrival Date</label>
                                <input type="date" class="form-control" id="arrivalDate" name="arrival_date" required>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Register Order</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
            <!-- Blank End -->


            <!-- Footer Start -->
           <?php require_once 'footer.php' ?>
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
</body>

</html>