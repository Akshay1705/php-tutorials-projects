<?php
session_start();
if (!isset($_SESSION['username'])) {
    // If the user is not logged in, redirect to login page
    // This prevents unauthorized access to the welcome page
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Welcome</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="welcome-box">
    <h2>Welcome, <?php echo $_SESSION['username']; ?> 🎉</h2>
    <p>You have successfully logged in.</p>
    <a href="logout.php">Logout</a>
  </div>
</body>
</html>
