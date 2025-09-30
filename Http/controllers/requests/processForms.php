<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Ensure PHPMailer is installed via Composer

// Example config
$config = [
    "SMTP_USER" => "elvisasante019@gmail.com",
    "SMTP_PASSWORD" => "sjehgfokbmukyzoh",
    "RECEIPIENT" => "admin@kennorescare.com",
    "RECEIPIENT_NAME" => "Receiver Name"
];

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = [
        "name" => trim($_POST["name"]),
        "email" => trim($_POST["email"]),
        "message" => trim($_POST["message"]),
        "subject" => "New message from " . trim($_POST["name"])
    ];

    $mail = new PHPMailer(true);

    try {
        // SMTP setup
        $mail->isSMTP();
        $mail->SMTPAuth   = true;
        $mail->Host       = 'smtp.gmail.com';
        $mail->Username   = $config["SMTP_USER"];
        $mail->Password   = $config["SMTP_PASSWORD"];
        $mail->Port       = 465;
        $mail->SMTPSecure = "ssl";
        $mail->isHTML(true);

        // Sender (user input)
        $mail->setFrom($data['email'], $data['name']);

        // Receiver
        $mail->addAddress($config["RECEIPIENT"], $config["RECEIPIENT_NAME"]);

        // Content
        $mail->Subject = $data['subject'];
        $mail->Body    = "<h3>New message from your website</h3>
                          <p><strong>Name:</strong> {$data['name']}</p>
                          <p><strong>Email:</strong> {$data['email']}</p>
                          <p><strong>Message:</strong><br>{$data['message']}</p>";
        $mail->AltBody = "New message from your website\n\n" .
                         "Name: {$data['name']}\n" .
                         "Email: {$data['email']}\n" .
                         "Message:\n{$data['message']}";

        $mail->send();
        echo "Message has been sent successfully!";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>


