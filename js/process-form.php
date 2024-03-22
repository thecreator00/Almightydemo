<?php

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Replace with your information
$senderEmail = "your_email@example.com";
$senderName = "Your Name";
$recipientEmail = "24.sam2000@gmail.com";
$subject = "Form Submission";

// Get form data (assuming you have a form with appropriate fields)
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Replace with your SendGrid API key and SMTP details
$apiKey = "YOUR_SENDGRID_API_KEY";
$smtpHost = "smtp.sendgrid.net";
$smtpPort = 587;

$mail = new PHPMailer(true);

try {
  // Server settings
  $mail->SMTPDebug = 2; // Enable verbose debugging (optional)
  $mail->isSMTP();
  $mail->Host = $smtpHost;
  $mail->Port = $smtpPort;
  $mail->SMTPAuth = true;
  $mail->SMTPSecure = 'tls'; // Enable TLS encryption

  // Authentication
  $mail->Username = "apikey"; // SendGrid username (always "apikey")
  $mail->Password = $apiKey;

  // Sender and recipient information
  $mail->setFrom($senderEmail, $senderName);
  $mail->addReplyTo($email, $name);
  $mail->addAddress($recipientEmail);

  // Content
  $mail->isHTML(true); // Set email format to HTML
  $mail->Subject = $subject;
  $mail->Body = "<b>Name:</b> $name<br><b>Email:</b> $email<br><b>Message:</b> $message";

  $mail->send();
  echo "Email sent successfully!";
} catch (Exception $e) {
  echo "Error sending email: " . $mail->ErrorInfo;
}

?>
