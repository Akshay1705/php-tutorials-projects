<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!-- header imitates a redirect to the any given location(login.php) -->


<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="welcome-box">
        <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
        <a class="logout-btn" href="logout.php">Logout</a>
    </div>
</body>
</html>
