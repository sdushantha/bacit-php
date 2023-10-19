<?php

/**
 * Private/Booking
 * Model class for a booking appointment.
 * This class is for storing data about a booking that
 * the user creates and is used for changing data
 * in the views.
 */
class Booking
{
    // Private properties to store booking data
    private $id;
    private $supervisor_id;
    private $user_id;
    private $time;
    private $subject;
    private $description;

    /**
     * Constructor for initializing a Booking object.
     * @param int $id Booking's ID
     * @param int $supervisor_id ID of the supervisor associated with the booking
     * @param string $time Time of the booking appointment
     */
    function _construct($id, $supervisor_id, $time)
    {
        $this->id = $id;
        $this->supervisor_id = $supervisor_id;
        $this->time = $time;
    }

    // Getters

    /**
     * Get the booking's ID.
     * @return int Booking's ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the ID of the supervisor associated with the booking.
     * @return int Supervisor's ID
     */
    public function getSupervisorId()
    {
        return $this->supervisor_id;
    }

    /**
     * Get the user's ID associated with the booking.
     * @return int User's ID
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Get the time of the booking appointment.
     * @return string Time of the booking appointment
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Get the subject of the booking.
     * @return string Subject of the booking
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Get the description of the booking.
     * @return string Description of the booking
     */
    public function getDescription()
    {
        return $this->description;
    }

    // Setters

    /**
     * Set the booking's ID.
     * @param int $id Booking's ID
     */
    public function setId($id)
    {
        return $this->id = $id;
    }

    /**
     * Set the ID of the supervisor associated with the booking.
     * @param int $supervisor_id Supervisor's ID
     */
    public function setSupervisorId($supervisor_id)
    {
        return $this->supervisor_id = $supervisor_id;
    }

    /**
     * Set the user's ID associated with the booking.
     * @param int $user_id User's ID
     */
    public function setUserId($user_id)
    {
        return $this->user_id = $user_id;
    }

    /**
     * Set the time of the booking appointment.
     * @param string $time Time of the booking appointment
     */
    public function setTime($time)
    {
        return $this->time = $time;
    }

    /**
     * Set the subject of the booking.
     * @param string $subject Subject of the booking
     */
    public function setSubject($subject)
    {
        return $this->subject = $subject;
    }

    /**
     * Set the description of the booking.
     * @param string $description Description of the booking
     */
    public function setDescription($description)
    {
        return $this->description = $description;
    }
}
