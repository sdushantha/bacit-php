<?php
require_once(__DIR__ . "/../controllers/userController.php");
session_start();

if (isset($_SESSION['user_id'])) {
    $userController = new UserController($pdo);
    $user = $userController->getUserByID($_SESSION["user_id"]);
    $logged_in = true;
} else {
    $logged_in = false;
}
