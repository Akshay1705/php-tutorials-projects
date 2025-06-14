<?php
use PHPMailer\PHPMailer\PHPMailer;//Shortcut to use PHPMailer class from the PHPMailer library
use PHPMailer\PHPMailer\Exception;//Needed to catch errors using try { ... } catch (Exception $e)

// Include PHPMailer classes
require 'PHPMailer/src/PHPMailer.php';//Loads the actual class code from files
require 'PHPMailer/src/SMTP.php';//Loads the SMTP class for sending emails
require 'PHPMailer/src/Exception.php';//Loads the Exception class for error handling

// Load global CSS
echo "<link rel='stylesheet' href='style.css'>";

// ✅ Define masking function at the top
//akshay1705@gmail.com ==> ak*******@gmail.com
function maskEmail($email) {//akshay1705@gmail.com
    $parts = explode("@", $email);//Splits the email into 2 parts: before @ and after @.
    $name = substr($parts[0], 0, 2) . str_repeat("*", max(0, strlen($parts[0]) - 2));
    //Gets the first 2 characters of the username: ==> ak
    //strlen($parts[0]) - 2 ==> Calculates how many * characters are needed:10-2 = 8
    //str_repeat("*", 8) ==> Creates a string of 8 * characters: ********
    //$name = "ak" . "********";  // → "ak********"
    return $name . '@' . $parts[1];
    //return "ak********" . "@" . "gmail.com";
}//ak*******@gmail.com

// Get and validate form data
$to = filter_var($_POST['friend_email'], FILTER_VALIDATE_EMAIL);
$subject = htmlspecialchars($_POST['subject']);
$body = nl2br(htmlspecialchars($_POST['message']));

$mail = new PHPMailer(true);
//$mail ==>	A variable that will store the PHPMailer object, which you'll use to configure and send your email.
//PHPMailer(true) ==> Creates a new instance(object) of the PHPMailer class.
//With (true)	You can use try/catch to handle errors cleanly.

try {
    // SMTP settings
    $mail->isSMTP();//Tells PHPMailer to use SMTP protocol instead of default mail() function.(which is not secure)(protocol (isSMTP()) ==> Use Gmail's SMTP server)
    $mail->Host       = 'smtp.gmail.com';//SMTP server address for Gmail
    $mail->SMTPAuth   = true;//Enable SMTP authentication
    $mail->Username   = 'your@gmail.com';// Your Gmail address (must be a valid Gmail account)
    $mail->Password   = 'your_app_password_here';  // App password only
    $mail->SMTPSecure = 'tls';//Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;//TCP port to connect to (587 for TLS, 465 for SSL)

    // Email setup
    $mail->setFrom('your@gmail.com', 'your name');// Set the sender's email address and name
    $mail->addAddress($to);// Add a recipient's email address
    $mail->isHTML(true);// Set email format to HTML (true) or plain text (false)    
    $mail->Subject = $subject;// Set the email subject  
    $mail->Body    = $body;// Set the email body content

    $mail->send();// Sends the email using the configured settings

    // ✅ Use masked email in output
    echo "<div class='status success'>✅ Email has been sent to <strong>" . maskEmail($to) . "</strong>!</div>";
} catch (Exception $e) {
    echo "<div class='status error'>❌ Message could not be sent.<br><small>Error: {$mail->ErrorInfo}</small></div>";
}
?>
