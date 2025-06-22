<h2>User List</h2>
<a href="index.php?action=addForm">➕ Add New</a>
<table border="1" cellpadding="5">
    <tr><th>ID</th><th>Name</th><th>Email</th><th>Action</th></tr>
    <?php while($row = $users->fetch_assoc()): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['name'] ?></td>
        <td><?= $row['email'] ?></td>
        <td>
            <a href="index.php?action=editForm&id=<?= $row['id'] ?>">✏️</a>
            <a href="index.php?action=delete&id=<?= $row['id'] ?>" onclick="return confirm('Sure?')">❌</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
