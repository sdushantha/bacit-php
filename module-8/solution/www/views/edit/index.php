<?php 

// TODO
// not finished


require_once(__DIR__."/../../../private/controllers/bookingController.php");
require_once(__DIR__."/../../../private/inc/dbConnection.php");
session_start();

if (isset($_SESSION['user_id'])) {
    // Check if the user clicked the logout button. If so, destroy the
    // session and redirect to the login page
    if (isset($_POST['logout'])) {
        session_destroy();
        header("Location: /login");
        exit();
    }

    $bookingController = new BookingController($pdo);
    $bookingController->getBookingsByUserId($_SESSION['user_id']);
    
    $acces_granted = true;
} else {
    $acces_granted = false;
}

require_once(__DIR__."/../../../private/inc/navbar.php");
