<!-- http://localhost/myphp/phptutorial/cookie/index.php -->
<?php
// Check for a theme cookie
$theme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'light';

// Handle theme change request
if (isset($_GET['set'])) {
    $theme = $_GET['set'];
    setcookie('theme', $theme, time() + (86400 * 30)); // Save for 30 days
    header("Location: index.php"); // Redirect to apply change
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Theme Switcher</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: <?= $theme === 'dark' ? 'black' : 'white' ?>;
            color: <?= $theme === 'dark' ? 'white' : 'black' ?>;
            font-family: Arial, sans-serif;
            transition: all 0.3s ease;
            text-align: center;
            padding-top: 100px;
        }
        a.button {
            padding: 10px 20px;
            background-color: <?= $theme === 'dark' ? 'white' : 'black' ?>;
            color: <?= $theme === 'dark' ? 'black' : 'white' ?>;
            text-decoration: none;
            border-radius: 5px;
            margin: 0 10px;
            font-weight: bold;
        }
    </style>
</head>
<body>

<h1>Welcome to Theme Switcher 🌗</h1>
<p>Current Theme: <strong><?= ucfirst($theme) ?> Mode</strong></p>

<div>
    <a class="button" href="?set=light">Light Mode</a>
    <a class="button" href="?set=dark">Dark Mode</a>
</div>

</body>
</html>
