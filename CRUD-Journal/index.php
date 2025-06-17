<!-- http://localhost/myphp/phptutorial/CRUD-Journal/index.php -->
<?php 
include 'db.php';
include 'session.php';//session is started in db.php and set in session.php

// Get only the notes of the logged-in user
$user_id = $_SESSION['user_id'];// get user_id from session
$sql = "SELECT * FROM notes WHERE user_id = $user_id ORDER BY created_at ASC";
// Fetch notes ordered by creation date of only the logged-in user
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>🧘‍♀️ SoulScript</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Welcome Message -->
<p class="welcome">👋 Welcome, <strong><?= htmlspecialchars($_SESSION['username']); ?></strong></p>

<!-- Header Bar -->
<div class="top-bar">
    <h1>📖 SoulScript — Reflect. Write. Grow. 🌱</h1>
    <div class="top-actions">
        <a href="add.php" class="add-btn">+ New Journal Entry</a>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</div>
<hr>

<!-- Notes Section -->
<!-- Check if there are any notes -->
<?php if (mysqli_num_rows($result) > 0): ?>
    <div class="notes-container">
    <!-- Loop through and display each note related to that user -->
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <div class="card">
            <h3><?= htmlspecialchars($row['title']) ?></h3>
            <p><?= nl2br(htmlspecialchars($row['content'])) ?></p>
            <!-- strtotime() Converts the string "2025-06-14 21:15:00" into a Unix timestamp.  -->
            <!-- Unix timestamp is just the number of seconds since Jan 1, 1970 — required by date(). -->
            <!-- date('d M Y, h:i A', strtotime($row['created_at'])) 
              example : created_at = "2025-06-14 21:15:00" to ==> 14 Jun 2025, 09:15 PM -->
            <small>🕒 <?= date('d M Y, h:i A', strtotime($row['created_at'])) ?></small>
            <div class="note-actions">
                <a href="edit.php?id=<?= $row['id'] ?>" class="edit-btn">✏️ Edit</a>
                <!-- If user clicks on delete button, a confirmation dialog will appear -->
                <!-- onclick return (true/false) if user confirms deletion -->
                <a href="delete.php?id=<?= $row['id'] ?>" class="delete-btn" onclick="return confirm('Delete this note?');">🗑️ Delete</a>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
<?php else: ?>
    <div class="message">🌱 Every journey begins with one thought. Start writing now. 💭</div>
<?php endif; ?>

</body>
</html>
