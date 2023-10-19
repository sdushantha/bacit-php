<?php

/**
 * /private/user  
 * Defines and stores data on a user. Server side.
 */
class User {
    public $id;
    public $username;
    public $password_hash;
    public $firstname;
    public $lastname;
    public $email;
    public $role;

    /**
     * Constructor for initializing a User object.
     * @param int $id User's ID
     * @param string $username User's username
     * @param string $password_hash User's hashed password
     * @param string $firstname User's first name
     * @param string $lastname User's last name
     * @param string $email User's email address
     */
    public function _construct($id, $username, $password_hash, $firstname, $lastname, $email, $role){
        // Initialize object properties with provided values
        $this->id = $id;
        $this->username = $username;
        $this->password_hash = $password_hash;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->role = $role;
    }

    // Getters

    /**
     * Get the user's ID.
     * @return int User's ID
     */
    public function getId(){
        return $this->id;
    }

    /**
     * Get the user's username.
     * @return string User's username
     */
    public function getUsername(){
        return $this->username;
    }

    /**
     * Get the user's hashed password.
     * @return string User's hashed password
     */
    public function getPasswordHash(){
        return $this->password_hash;
    }

    /**
     * Get the user's first name.
     * @return string User's first name
     */
    public function getFirstname(){
        return $this->firstname;
    }

    /**
     * Get the user's last name.
     * @return string User's last name
     */
    public function getLastname(){
        return $this->lastname;
    }

    /**
     * Get the user's email address.
     * @return string User's email address
     */
    public function getEmail(){
        return $this->email;
    }

     /**
     * Get the user's role.
     * @return string Either User or Supervisor.
     */
    public function getRole(){
        return $this->role;
    }

    // Setters

    /**
     * Set the user's ID.
     * @param int $id User's ID
     */
    public function setId($id){
        $this->id = $id;
    }

    /**
     * Set the user's ID.
     * @param int $id User's ID
     */
    public function setPasswordHash($password){
        $this->password_hash = $password;
    }

    /**
     * Set the user's username.
     * @param string $username User's username
     */
    public function setUsername($username){
        $this->username = $username;
    }

    /**
     * Set the user's first name.
     * @param string $firstname User's first name
     */
    public function setFirstname($firstname){
        $this->firstname = $firstname;
    }

    /**
     * Set the user's last name.
     * @param string $lastname User's last name
     */
    public function setLastname($lastname){
        $this->lastname = $lastname;
    }

    /**
     * Set the user's email address.
     * @param string $email User's email address
     */
    public function setEmail($email){
        $this->email = $email;
    }

      /**
     * Set the user's role.
     * @param string $role - can be either user or supervisor.
     */
    public function setRole($role){
        $this->role = $role;
    }

}
