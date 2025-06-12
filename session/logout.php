<?php
session_start();
session_unset();
session_destroy();
header("Location: login.php");
exit();
?>
<!-- header imitates a redirect to the any given location(login.php) -->
