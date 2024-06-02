<?php
// Include necessary files
require '../PHPMailer/PHPMailerAutoload.php';

include 'conn_db.php'; // Your database connection script

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate and sanitize email input
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    // Check if the email exists in the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Generate a unique reset code
        $resetCode = bin2hex(random_bytes(16));

        // Store the reset code in the database
        $stmt = $conn->prepare("UPDATE users SET reset_code = ? WHERE email = ?");
        $stmt->bind_param("ss", $resetCode, $email);
        $stmt->execute();

        // Send reset code to user's email
        $mail = new PHPMailer();
        // Configure PHPMailer with your SMTP settings
        // ...

        $mail->setFrom('bongtola618@gmail.com', 'MET TOLA');
        $mail->addAddress($email);

        $mail->Subject = 'Password Reset Code';
        $mail->Body    = "Your password reset code is: $resetCode";

        if ($mail->send()) {
            echo "Reset code sent successfully. Check your email.";
        } else {
            echo "Error sending reset code: " . $mail->ErrorInfo;
        }
    } else {
        echo "Email not found in our records.";
    }

    $stmt->close();
    $conn->close();
}
?>
