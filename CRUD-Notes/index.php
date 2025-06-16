<!-- http://localhost/myphp/phptutorial/CRUD-Notes/index.php -->

<!-- this only for displaying notes -->
<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Notes App</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>📒 My Journal</h1>
    <a href="add.php" class="add-btn">+ Add New Entry</a>
    <hr><br>

    <div class="container">
    <?php
    $sql = "SELECT * FROM notes ORDER BY created_at ASC";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            //$row is an associative array ['id'=>1,'title'=>'Note1', 'content'=>'text', 'created_at'=>'...']
            echo "<div class='card'>";
            echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
            echo "<p>" . nl2br(htmlspecialchars($row['content'])) . "</p>";
            echo "<small>🕒 " . $row['created_at'] . "</small>";//always concatinate string like ways .----.
            echo "<a href='edit.php?id={$row['id']}' class='edit-btn'>✏️ Edit</a> ";
            //   \ (backslash) \"	Escapes special characters inside a string (like " )
            echo "<a href='delete.php?id={$row['id']}' class='delete-btn' onclick=\"return confirm('Delete this note?');\">🗑️ Delete</a>";
            echo "</div>";
        }
    } else {
        echo "<div class='message'>📝 No notes found. Add your first note now!</div>";
    }
    ?>
    </div>
</body>
</html>
