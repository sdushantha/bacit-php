<?php

/**
 * Class BookingController
 *
 * Controller class that interacts with the booking table in the database.
 */
class BookingController
{
    private $pdo;

    /**
     * Constructor
     * 
     * Bind PDO to Controller.
     * Connects with the DB and is able to prepare querys.
     * 
     * @param PDO
     */
    function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Get all bookings related to a user
     * 
     * @param user_id
     */
    function getBookingsByUserId($user_id)
    {
        require_once(__DIR__ . "/../models/booking.php");

        $stmt = $this->pdo->prepare("SELECT * FROM booking WHERE  user_id = :user_id");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        $booking_data = $stmt->fetchAll(PDO::FETCH_GROUP | PDO::FETCH_ASSOC);
        $booking_repo = array();

        foreach ($booking_data as $booking_obj) {
            
            if ($booking_data) {
                $booking = new Booking();
                //$booking->setId($booking_obj[0]['id']);
                $booking->setSupervisorId($booking_obj[0]['supervisor_id']);
                $booking->setUserId($booking_obj[0]['user_id']);
                $booking->setTime($booking_obj[0]['time']);
                $booking->setSubject($booking_obj[0]['subject']);
                $booking->setDescription($booking_obj[0]['description']);

                array_push($booking_repo, $booking);
            }
        }
        if ($booking_repo) {
            return $booking_repo;
        } else {
            return null;
        }
    }


    /**
     * Creats a booking.
     * @param supervisor_id - appointment with.
     * @param user_id - appointer.
     * @param time - time of the appointment.
     * @param subject - subject to speak of.
     * @param description - specific description.
     */
    public function createBooking($supervisor_id, $user_id, $time, $subject, $description)
    {
        // Needs validation on supervisor/time.
        $insert_stmt = $this->pdo->prepare("INSERT INTO booking (supervisor_id, user_id, time, subject, description) VALUES (:supervisor_id, :user_id, :time, :subject, :description)");
        $insert_stmt->execute([
            'supervisor_id' => $supervisor_id,
            'user_id' => $user_id,
            'time' => $time,
            'subject' => $subject,
            'description' => $description,
        ]);
    }
}
