<!-- http://localhost/myphp/phptutorial/regi-login/register.php -->
<?php
session_start();
include 'db.php';
?>

<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<form method="POST">
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit" name="register">Register</button>
    <p>Already have an account? <a href="login.php">Login here</a></p>
</form>

<?php
if (isset($_POST['register'])) {
    //isset($_POST['register']) checks if the form is submitted
    // ✅ Validate input
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // ✅ Check if email already exists
    $check_email = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $check_email);
    //$result returns (no. of rows) matching the query
    //if there is error in query, it returns false

    if (mysqli_num_rows($result) > 0) {
        echo "⚠️ Email already registered. Try another one.";
    } else {
        $insert = "INSERT INTO users (username, email, password)
                   VALUES ('$username', '$email', '$password')";
        if (mysqli_query($conn, $insert)) {
            $_SESSION['username'] = $username;
            header("Location: welcome.php");
            exit;
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>

</body>
</html>
