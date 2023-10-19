<?php
    require_once(__DIR__ . "/../../../private/controllers/bookingController.php");
    require_once(__DIR__ . "/../../../private/inc/dbConnection.php");
    require_once(__DIR__ . "/../../../private/inc/essentials.php");
    require_once(__DIR__ . "/../../../private/inc/navbar.php");

    $bookingController = new BookingController($pdo);
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

</head>


<br>
<h2 class="text-center"><b>Welcome <?= $user->getFirstname()?>!</b></h1>

    <?php
    $my_bookings = $bookingController->getBookingsByUserId($_SESSION['user_id']);

echo "<div class= 'card_container'>";

    foreach ($my_bookings as $booking) {
        echo
        "<div class='card' style='width: 18rem;'>
  <div class='card-body>
  <h5 class='card-title'> </h5> 
  <h5 class='card-title'> Subject </h5>
    <p class='card-text'>" . $booking->getSubject() . "</p>
    <h5 class='card-title'> Description </h5>
    <p class='card-text'>" . $booking->getDescription() . "</p>
    <h5 class='card-title'> Supervisor </h5>
    <p class='card-text'> FIX ME </p>
    <h5 class='card-title'> Time </h5>
    <p class='card-text'>" . $booking->getTime() . "</p>
    <a href='#' class='btn btn-primary'>Edit</a>
  </div>
</div>";
    }

    echo "</div>";
    ?>

    <!-- Button is where we link to Edit page -->

</html>

<style>
    .card_container {
        display: flex;
        flex-direction: row;
    }

    .card {
        padding: 10px;
        margin: 20px;
    }
</style>