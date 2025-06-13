<?php
$uploadDir = "uploads/";
$allowedTypes = ['pdf', 'doc', 'docx'];
$maxFileSize = 2 * 1024 * 1024; // 2MB

echo '<link rel="stylesheet" href="style.css">';
echo '<div class="container">';

if (isset($_FILES["resume"])) {
    $fileName = $_FILES["resume"]["name"];
    $tmpName = $_FILES["resume"]["tmp_name"];
    $fileSize = $_FILES["resume"]["size"];
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Validate file type
    if (!in_array($fileExt, $allowedTypes)) {
        echo '<div class="status error">❌ Invalid file type. Only PDF, DOC, DOCX allowed.</div>';
        exit;
    }

    // Validate file size
    if ($fileSize > $maxFileSize) {
        echo '<div class="status error">❌ File too large. Maximum 2MB allowed.</div>';
        exit;
    }

    // Move file to uploads folder
    $uniqueName = time() . "_" . basename($fileName);
    $targetPath = $uploadDir . $uniqueName;

    if (move_uploaded_file($tmpName, $targetPath)) {
        echo '<div class="status success">✅ Resume uploaded successfully: <a href="' . $targetPath . '" target="_blank">View Resume</a></div>';
    } else {
        echo '<div class="status error">❌ Upload failed.</div>';
    }
} else {
    echo '<div class="status error">❌ No file uploaded.</div>';
}

echo '</div>';
?>
