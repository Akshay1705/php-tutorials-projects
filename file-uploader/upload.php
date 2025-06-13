<?php
$uploadDir = "uploads/";
$allowedTypes = ['pdf', 'doc', 'docx'];
$maxFileSize = 2 * 1024 * 1024; // 2MB

if (isset($_FILES["resume"])) {
    $fileName = $_FILES["resume"]["name"];
    $tmpName = $_FILES["resume"]["tmp_name"];
    $fileSize = $_FILES["resume"]["size"];
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Validate file type
    if (!in_array($fileExt, $allowedTypes)) {
        echo "❌ Invalid file type. Only PDF, DOC, DOCX allowed.";
        exit;
    }

    // Validate file size
    if ($fileSize > $maxFileSize) {
        echo "❌ File too large. Maximum 2MB allowed.";
        exit;
    }

    // Move file to uploads folder
    $uniqueName = time() . "_" . basename($fileName);
    $targetPath = $uploadDir . $uniqueName;

    if (move_uploaded_file($tmpName, $targetPath)) {
        echo "✅ Resume uploaded successfully: <a href='$targetPath' target='_blank'>View Resume</a>";
    } else {
        echo "❌ Upload failed.";
    }
} else {
    echo "❌ No file uploaded.";
}
?>
