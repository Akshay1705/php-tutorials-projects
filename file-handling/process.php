<?php
$filename = "diary.txt";

// Handle form submission (write entry)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $entry = trim($_POST["entry"]);

    if (!empty($entry)) {
        $date = date("Y-m-d H:i:s");
        $formatted = "[$date] $entry\n";
        file_put_contents($filename, $formatted, FILE_APPEND);
        header("Location: index.html"); // Redirect to avoid resubmission
        exit();
    } else {
        echo "<b>Please write something!</b>";
        exit();
    }
}

// Display file content
if (file_exists($filename)) {
    $content = htmlspecialchars(file_get_contents($filename));
    echo "<pre>$content</pre>";
} else {
    echo "<i>No entries yet...</i>";
}
?>
