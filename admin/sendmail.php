<?php
 require_once '../controller/adminsession.php' ;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Load PHPMailer via Composer
require '../config.php'; // Include your config file

session_start(); // Start session to store flash message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recipientEmail = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USER;
        $mail->Password = SMTP_PASS;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = SMTP_PORT;

        $mail->setFrom(SMTP_USER, 'Support Team');
        $mail->addAddress($recipientEmail);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = nl2br($message);
        $mail->AltBody = strip_tags($message);

        if ($mail->send()) {
            $_SESSION['toastr_message'] = "Mail has been sent successfully!";
            $_SESSION['toastr_type'] = "success";
        } else {
            $_SESSION['toastr_message'] = "Mail sending failed!";
            $_SESSION['toastr_type'] = "error";
        }
    } catch (Exception $e) {
        $_SESSION['toastr_message'] = "Mail Error: " . $mail->ErrorInfo;
        $_SESSION['toastr_type'] = "error";
    }

    // Prevent resubmission by redirecting
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>

<?php require_once 'head.php' ?>
<style>
       .container {
            max-width: 500px;
            margin-top: 50px;
        }
        .card {
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
</style>
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



            <div class="container">

<div class="card">
    <h4 class="text-center mb-4">Send Email</h4>
    <form action="" method="post">
        <div class="mb-3">
            <label for="email" class="form-label">Client Email</label>
            <input type="email" class="form-control" name="email" required placeholder="Enter recipient's email">
        </div>
        <div class="mb-3">
            <label for="subject" class="form-label">Subject</label>
            <input type="text" class="form-control" name="subject" required placeholder="Enter email subject">
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea class="form-control" name="message" rows="5" required placeholder="Enter your message"></textarea>
        </div>
        <button type="submit" class="btn btn-primary w-100">Send Mail</button>
    </form>
</div>
</div>
            <!-- Blank End -->

            <?php require_once 'footer.php' ?>

<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    <?php if (isset($_SESSION['toastr_message']) && isset($_SESSION['toastr_type'])): ?>
        toastr.<?php echo $_SESSION['toastr_type']; ?>('<?php echo $_SESSION['toastr_message']; ?>');
        <?php
        // Clear toastr message after displaying
        unset($_SESSION['toastr_message']);
        unset($_SESSION['toastr_type']);
        ?>
    <?php endif; ?>
</script>

</body>

</html>
