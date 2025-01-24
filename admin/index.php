<?php require_once '../controller/adminsession.php' ?>


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


            <!-- Sale & Revenue Start -->
            <?php require_once 'overview.php' ?>

            <!-- Sale & Revenue End -->

            <?php require_once 'footer.php' ?>

</body>

</html>