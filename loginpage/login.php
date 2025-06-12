<?php

    $emailError = "";
    $submittedEmail = "";

    // Handle the POST request
    // $_SERVER , $_POST , $_GET are (superglobals) in PHP
    // $_SERVER["REQUEST_METHOD"] checks the request method is (GET, POST, etc.) or what?


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["email"])) {
            $emailError = "Email is required!";
        } else {
            $submittedEmail = htmlspecialchars($_POST["email"]);
            // htmlspecialchars() -> 
            // converts special characters to HTML entities
            // This is to prevent XSS (Cross-Site Scripting) attacks
            // XSS is a security vulnerability that allows attackers to inject malicious scripts into web pages viewed by other users.
            // htmlspecialchars() is used to escape HTML characters like <, >, &, etc.to &lt;, &gt;, &amp;, etc.
            // This ensures that the email is safe to display in the HTML output.

        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Result</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="login-container">
    <h2>Login Result</h2>

    <!-- if this if (true(not empty error)) means it has error then print that div content -->
    <?php if (!empty($emailError)) : ?> 
        <div class="error">
            <?php echo $emailError; ?>
        </div>

    <!-- if the emailError is empty(else) then print this div content -->
    <?php else : ?>
        <div class="message">Submitted Email: 
            <?php echo $submittedEmail; ?>
        </div>
    <!-- it shoudl mandatory to this below line when using mixed php -->
    <?php endif; ?>

    <a href="index.html" style="display:block; text-align:center; margin-top:20px;">Go Back</a>
</div>

</body>
</html>
