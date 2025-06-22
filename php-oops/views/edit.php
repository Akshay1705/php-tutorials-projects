<h2>Edit User</h2>
<form method="post" action="index.php?action=update&id=<?= $user['id'] ?>">
    <input type="text" name="name" value="<?= $user['name'] ?>" required><br>
    <input type="email" name="email" value="<?= $user['email'] ?>" required><br>
    <button type="submit">Update</button>
</form>
<a href="index.php">Back to List</a>
