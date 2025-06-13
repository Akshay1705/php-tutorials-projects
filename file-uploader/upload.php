<?php
$uploadDir = "uploads/";
$allowedTypes = ['pdf', 'doc', 'docx'];
$maxFileSize = 2 * 1024 * 1024; // 2MB => 1kb = 1024 (and) 1MB = 1024 * 1024 .

echo '<link rel="stylesheet" href="style.css">';
echo '<div class="container">';

if (isset($_FILES["resume"])) {
    $fileName = $_FILES["resume"]["name"];//$_FILES is a superglobal ["input name"]["file name"]
    $tmpName = $_FILES["resume"]["tmp_name"];//["input name"]["temporary file name"]
    $fileSize = $_FILES["resume"]["size"];//["input name"]["file size in bytes"]
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    // Extracts the file extension (like pdf, doc, or docx) from the original file name.
    // pathinfo() => breaks down the filename into parts.
    // PATHINFO_EXTENSION => specifically gets the extension
    // strtolower() ==> converts it to lowercase to avoid issues like( .PDF vs .pdf.)

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

    // automatically generate a unique name for the file
    $timestamp = time();
    $baseName = pathinfo($fileName, PATHINFO_FILENAME); // without extension
    $cleanName = preg_replace("/[^a-zA-Z0-9_-]/", "_", $baseName); // sanitize
    $uniqueName = $cleanName . "_" . $timestamp . "." . $fileExt;
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
