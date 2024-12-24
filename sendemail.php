<?php
// Define constants
define("RECIPIENT_NAME", "Eleventh Hour Team");
define("RECIPIENT_EMAIL", "uamrzeeshan709@gmail.com");

// Read form values
$userName = isset($_POST['username']) ? filter_var($_POST['username'], FILTER_SANITIZE_STRING) : "";
$senderEmail = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) : "";
$phone = isset($_POST['phone']) ? filter_var($_POST['phone'], FILTER_SANITIZE_STRING) : "";
$query = isset($_POST['query']) ? filter_var($_POST['query'], FILTER_SANITIZE_STRING) : "";
$message = isset($_POST['message']) ? filter_var($_POST['message'], FILTER_SANITIZE_STRING) : "";

$success = false;

// Validate required fields
if ($userName && $senderEmail && $message) {
    $recipient = RECIPIENT_NAME . " <" . RECIPIENT_EMAIL . ">";
    $subject = "New Contact Form Submission: $query";
    $headers = "From: $userName <$senderEmail>\r\n";
    $headers .= "Reply-To: $senderEmail\r\n";
    $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

    $msgBody = "You have received a new message via the contact form:\n\n";
    $msgBody .= "Name: $userName\n";
    $msgBody .= "Email: $senderEmail\n";
    $msgBody .= "Phone: $phone\n";
    $msgBody .= "Subject: $query\n\n";
    $msgBody .= "Message:\n$message\n";

    // Send email
    $success = mail($recipient, $subject, $msgBody, $headers);

    // Redirect after submission
    if ($success) {
        header('Location: contact.html?message=Successful');
    } else {
        header('Location: contact.html?message=Failed');
    }
} else {
    header('Location: contact.html?message=Failed');
}
?>
