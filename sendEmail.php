<?php

// Include PHPMailer autoload
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';  // Ensure this path is correct and points to Composer's autoload.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and get form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $project = htmlspecialchars($_POST['project']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);
    
    // Create PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();  // Use SMTP
        $mail->Host = 'smtp.gmail.com';  // Gmail SMTP server
        $mail->SMTPAuth = true;  // Enable SMTP authentication
        $mail->Username = 'cr3681@gmail.com';  // Your Gmail address
        $mail->Password = 'thsbbobkgdhahmhf';  // Use your generated App Password for Gmail (if 2FA is enabled)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Use STARTTLS encryption
        $mail->Port = 587;  // Port for STARTTLS

        // Recipients
        $mail->setFrom('cr3681@gmail.com', 'Ravindra');  // Set the sender's email and name
        $mail->addAddress('cr3681@gmail.com');  // Add recipient email address (your email)

        // Content of the email
        $mail->isHTML(false);  // Set email format to plain text (you can switch to true for HTML format)
        $mail->Subject = "New Contact Form Submission: $subject";
        $mail->Body = "
            Name: $name\n
            Email: $email\n
            Phone: $phone\n
            Project: $project\n
            Subject: $subject\n
            Message: \n$message
        ";

        // Debugging output (set to 3 for detailed logging, can be adjusted for less verbose output)
        $mail->SMTPDebug = 3;  // Show detailed debug output (you can set it to 2 or 1 for less info)

        // Send email
        $mail->send();
        echo "Message sent successfully!";
    } catch (Exception $e) {
        // Detailed error message if sending fails
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
