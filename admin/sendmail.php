<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Load PHPMailer via Composer
require '../config.php'; // Include your config file

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
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Instead of 'ssl'
        $mail->Port = SMTP_PORT;
    
        $mail->SMTPDebug = 2; // Enable debugging
        $mail->Debugoutput = 'html'; // Show output in readable HTML
    
        $mail->setFrom(SMTP_USER, 'Support Team');
        $mail->addAddress($recipientEmail);
    
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = nl2br($message);
        $mail->AltBody = strip_tags($message);
    
        if ($mail->send()) {
            echo "Mail has been sent successfully!";
        } else {
            echo "Mail sending failed!";
        }
    } catch (Exception $e) {
        echo "Mail Error: " . $mail->ErrorInfo;
    }
}    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="" method="post">
    <label for="email">Client Email:</label>
    <input type="email" name="email" required>

    <label for="subject">Subject:</label>
    <input type="text" name="subject" required>

    <label for="message">Message:</label>
    <textarea name="message" required></textarea>

    <button type="submit">Send Mail</button>
</form>

</body>
</html>