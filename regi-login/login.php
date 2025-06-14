<?php
session_start();
include 'db.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="style.css"> <!-- ✅ CSS linked here -->
</head>
<body>

<form method="POST">
  <input type="email" name="email" placeholder="Email" required><br>
  <input type="password" name="password" placeholder="Password" required><br>
  <button type="submit" name="login">Login</button>
  <p>Don't have an account? <a href="register.php">Register here</a></p>
</form>

<?php
if (isset($_POST['login'])) {
    // Check if the form is submitted
    // ✅ Validate input
    $email = $_POST['email'];
    $pass  = $_POST['password'];

    // ✅ Check if email exists
    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    // $result returns (no. of rows) matching the query
    if (mysqli_num_rows($result) === 1) {
        // If email exists, fetch user data
        // mysqli_fetch_assoc() returns an associative array of the result set
        $user = mysqli_fetch_assoc($result);

        if (password_verify($pass, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            header("Location: welcome.php");
            exit;
        } else {
            echo "❌ Wrong password";
        }
    } else {
        echo "❌ Email not found";
    }
}
?>

</body>
</html>
