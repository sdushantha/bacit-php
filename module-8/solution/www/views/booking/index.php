<?php
require_once(__DIR__ . "/../../../private/inc/essentials.php");
require_once(__DIR__ . "/../../../private/inc/navbar.php");



$bookingController = new BookingController($pdo);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $time = $_POST['date'] . " " . $_POST['time'];
    $bookingController->createBooking($_POST['supervisor'], $_SESSION['user_id'], $time, $_POST['subject'], $_POST['description']);
}
?>

<form id="booking" action="" method="POST">
    <div class="form-group">
        <label for="supervisor">Supervisor</label>
        <select class="form-control form-control-lg" name="supervisor">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
        </select>
    </div>
    <div class="form-group">
        <label for="date">Date</label>
        <select class="form-control form-control-lg" name="date">
            <option>2024-09-21</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
        </select>
    </div>
    <div class="form-group">
        <label for="time">Time</label>
        <select class="form-control form-control-lg" name="time">
            <option>18:00:00</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
        </select>
    </div>

    <div class="form-group">
        <label for="subject">Subject</label>
        <input class="form-control form-control-lg" type="text" placeholder="Subject" name="subject">
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" name="description" rows="3"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Submit Booking</button>

</form>

<style>
    #booking {
        margin: 7% 15%;

    }

    #booking label {
        font-weight: bold;
    }
</style>