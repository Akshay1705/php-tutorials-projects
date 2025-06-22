<?php
require_once '../classes/User.php';
$userObj = new User();

$action = $_GET['action'] ?? 'list';

if ($action == 'addForm') {
    include '../views/add.php';

} elseif ($action == 'add' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $userObj->addUser($_POST['name'], $_POST['email']);
    header("Location: index.php");

} elseif ($action == 'editForm') {
    $user = $userObj->getUser($_GET['id']);
    include '../views/edit.php';

} elseif ($action == 'update' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $userObj->updateUser($_GET['id'], $_POST['name'], $_POST['email']);
    header("Location: index.php");

} elseif ($action == 'delete') {
    $userObj->deleteUser($_GET['id']);
    header("Location: index.php");

} else {
    $users = $userObj->getAllUsers();
    include '../views/list.php';
}
