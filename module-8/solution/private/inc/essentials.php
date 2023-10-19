<?php
require_once(__DIR__ . "/../controllers/userController.php");
require_once(__DIR__ . "/../controllers/bookingController.php");
require_once(__DIR__ . "/dbConnection.php");
require_once(__DIR__ . "/authcheck.php");

// If the user is not logged in, direct them to the login page
// This function is not needed if the user is already visiting /login or /signup
if (!str_starts_with($_SERVER['REQUEST_URI'], '/login') && !str_starts_with($_SERVER['REQUEST_URI'], '/signup')) {
    if (!$logged_in) {
        header("Location: /login");
    }
}
