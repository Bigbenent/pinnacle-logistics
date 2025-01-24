<?php
session_start();
if (!isset($_SESSION['tracking_details'])) {
    header("Location: index.php");
    exit();
}

$delivery = $_SESSION['tracking_details']; // Retrieve tracking details
unset($_SESSION['tracking_details']); // Clear session data
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pinnacle-LOGISTICS</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
<link rel="shortcut icon" href="logo.png" type="image/x-icon">
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
<!-- Include Toastr CSS in the <head> section -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <link href="assets/css/style.css" rel="stylesheet">
 
</head>
<style>
      .toast-success {
    background-color: #28a745 !important; /* Green */
    color: #fff !important;
  }
  .toast-error {
    background-color: #dc3545 !important; /* Red */
    color: #fff !important;
  }
  .toast-info {
    background-color: #17a2b8 !important; /* Blue */
    color: #fff !important;
  }
  .toast-warning {
    background-color: #ffc107 !important; /* Yellow */
    color: #fff !important;
  }
  .deliver {
  font-family: Arial, sans-serif;
  text-align: center;
  background-color: #f5f5f5;
  margin: 0;
}

h1 {
  color: #333;
  margin: 20px 0;
}

table {
  width: 80%;
  margin: 20px auto;
  border-collapse: collapse;
  background-color: #fff;
  box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
}

th, td {
  padding: 12px;


  text-align: center;
}

th {
  background-color: #333;
  color: #fff;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}

tr:nth-child(odd) {
  background-color: #e6e6e6;
}
.scan{
    width: 30%;
    margin-left:400px;
    margin-top: 20px;
}
.read{
    left:100px;
position: relative;
top: 200px;
color: red;
}
.location{
    width: 10%;
  left:100px;
position: relative;
top: 50px;
    height: 100px;
}
.country{
left:130px;
position: relative;
top: 80px;
}
@media screen and (max-width: 915px) {
  .scan {
    width: 50%;
    right:250px;
    position: relative;
  }
  .location{
width: 10%;
left:50px;
position: relative;
top: 10px;
    height: 100px;
  }
  .read{
left:5px;
position: relative;
top: 150px;
color: red;
}
.country{
left:40px;
position: relative;
top: 30px;
}
}
 </style>

<body>

 

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="page-header d-flex align-items-center" style="background-image: url('img/header.jpg');">
        <div class="container position-relative">
          <div class="row d-flex justify-content-center">
            <div class="col-lg-6 text-center">
              <h2>Tracking</h2>
            </div>
          </div>
        </div>
      </div>
      <nav>
        <div class="container">
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Tracking</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->


    <!-- ======= Tracking Section ======= -->
   <div class="container px-1 px-md-4 py-5 mx-auto">
        <div class="card">
            <p class="read"><b>Current Location</b></p>
            <img src="location.png" class="location" alt="">
            <p class="country"><?php echo htmlspecialchars($delivery['current_location']); ?>
            <b>
       

            </b></p>
        <img src="scan.jpg" alt="" class="scan">

            <div class="row d-flex justify-content-between px-3 top">
                <div class="d-flex">
                    <h5><b>Tracking Id </b><span class="text-success font-weight-bold">
                    <?php echo htmlspecialchars($delivery['tracking_number']); ?>
                  </h5>
                </div>
                <div class="d-flex flex-column text-sm-right">
                    <b class="mb-0"><b>Shipment-statues</b>
                      <span class="text-success font-weight-bold">
                      <?php echo htmlspecialchars($delivery['status']); ?>

                      </span></b>

                </div>
                <div class="d-flex flex-column text-sm-right">
                    <b class="mb-0"> <b>Delivery destination</b>
                      <span class="text-success font-weight-bold">
                      <td>
                      <?php echo htmlspecialchars($delivery['recipient_address']); ?>

                      </td>
                      </span></b>

                </div>
            </div> 
            <!-- Add class 'active' to progress -->
         <div class="row d-flex justify-content-center">
                <div class="col-12">
                <ul id="progressbar" class="text-center">
                    <li class="active step0"></li>
                    <li class="active step0"></li>
                    <li class="active step0"></li>
                    <li class="step0"></li>
                </ul>
                </div>
            </div>
            <div class="deliver">
              
              <table>
                  <tr>
                    <th>Sender's name</th>
                      <th>sender's Phone</th>
                  </tr>
                  <tr>
                      <td>
                        <?php echo htmlspecialchars($delivery['sender_name']); ?>
                      </td>


                      <td>
                                            <?php echo htmlspecialchars($delivery['sender_phone']); ?>
                      </td>
                  </tr>
              </table>

              <table>
                  <tr>
                      <th>Reciever_name</th>
                      <th>Reciever_Email</th>
                  </tr>
                  <tr>
                      <td>
                                            <?php echo htmlspecialchars($delivery['recipient_name']); ?>
                      </td>

                    

                      <td>
                                         <?php echo htmlspecialchars($delivery['recipient_address']); ?>
                      </td>
                  </tr>
              </table>
          
              <table>
                  <tr>
                  <th>track_point</th>
                      <th>Reciever_phone number</th>
                  </tr>
                  <tr>
                      <td>
                                            <?php echo htmlspecialchars($delivery['track_point']); ?>
                      </td>

                      <td>
                                            <?php echo htmlspecialchars($delivery['recipient_phone']); ?>
                      </td>

                     
                  </tr>
              </table>

             

              <table>
                  <tr>
                    <th>package Description </th>
                      <th>Departure_date</th>
                      
                  </tr>
                  <tr>
                      <td>
                                            <?php echo htmlspecialchars($delivery['desc']); ?>
                      </td>

                      <td>
                                            <?php echo htmlspecialchars($delivery['departure_date']); ?>
                      </td>

                  </tr>
              </table>

              <table>
                  <tr>

                      <!-- <th>reciever_address</th> -->
                      <th>package_weight</th>
                      <th>Arrival_date</th>
                  </tr>
                  <tr>

                      <td>
                                            <?php echo htmlspecialchars($delivery['weight']); ?>
                      </td>
                      <td>
                                            <?php echo htmlspecialchars($delivery['arrival_date']); ?>
                      </td>
                  </tr>
              </table>
              </div>
          
          
            
  </main><!-- End #main -->
    

<a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<div id="preloader"></div>
<!-- jQuery and Toastr JS, place these just before </body> -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Make sure jQuery is loaded before Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
$(document).ready(function() {
    <?php if (isset($_SESSION['error'])) { ?>
        toastr.error("<?php echo $_SESSION['error']; ?>");
        <?php unset($_SESSION['error']); ?>
    <?php } ?>

    <?php if (isset($_SESSION['success'])) { ?>
        toastr.success("<?php echo $_SESSION['success']; ?>");
        <?php unset($_SESSION['success']); ?>
    <?php } ?>
});
</script>
<!-- Vendor JS Files -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

</body>

</html>