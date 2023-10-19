<?php

/**
 * Class UserController
 *
 * Controller class that interacts with the user data in the database.
 */
class UserController
{

    private $pdo;

    /**
     * UserController constructor.
     *
     * @param PDO $pdo The PDO database connection.
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Get a user by their ID.
     *
     * @param int $id The user's ID.
     * @return User|null A User object if found, or null if not found.
     */
    private function getUser($id = null, $username = null, $email = null)
    {
        require_once(__DIR__ . "/../models/user.php");

        if ($id) {
            $stmt = $this->pdo->prepare("SELECT * FROM user WHERE id = :id");
            $stmt->bindParam(':id', $id);
        } elseif ($username) {
            $stmt = $this->pdo->prepare("SELECT * FROM user WHERE username = :username");
            $stmt->bindParam(':username', $username);
        } elseif ($email) {
            $stmt = $this->pdo->prepare("SELECT * FROM user WHERE email = :email");
            $stmt->bindParam(':email', $email);
        } else {
            return null;
        }

        $stmt->execute();

        $user = new User();
        $user_data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user_data) {
            $user->setId($user_data['id']);
            $user->setPasswordHash($user_data['password_hash']);
            $user->setUsername($user_data['username']);
            $user->setFirstname($user_data['firstname']);
            $user->setLastname($user_data['lastname']);
            $user->setEmail($user_data['email']);
            $user->setRole($user_data['role']);


            return $user;
        }

        return null;
    }

    /**
     * Get a user by their ID.
     *
     * @param int $id The user's ID.
     * @return User|null A User object if found, or null if not found.
     */
    public function getUserByID($id)
    {
        return $this->getUser(id: $id);
    }

    /**
     * Get a user by their username.
     *
     * @param string $username The username to search for.
     * @return User|null A User object if found, or null if not found.
     */
    public function getUserByUsername($username)
    {
        return $this->getUser(username: $username);
    }

    /**
     * Get a user by their email address.
     *
     * @param string $email The email address to search for.
     * @return User|null A User object if found, or null if not found.
     */
    public function getUserByEmail($email)
    {
        return $this->getUser(email: $email);
    }

    /**
     * Create a new user.
     *
     * @param string $username The username of the new user.
     * @param string $password_hash The hashed password of the new user.
     * @param string $first_name The first name of the new user.
     * @param string $last_name The last name of the new user.
     * @param string $email The email address of the new user.
     */
    public function createUser($username, $password_hash, $first_name, $last_name, $email, $role)
    {
        $insert_stmt = $this->pdo->prepare("INSERT INTO user (username, password_hash, firstname, lastname, email, role) VALUES (:username, :password_hash, :firstname, :lastname, :email, :role)");
        $insert_stmt->execute([
            'username' => $username,
            'password_hash' => $password_hash,
            'firstname' => $first_name,
            'lastname' => $last_name,
            'email' => $email,
            'role' => $role
        ]);
    }

    /**
     * Update user information.
     *
     * @param int $id The user's ID.
     * @param string|null $username The new username (optional).
     * @param string|null $password_hash The new hashed password (optional).
     * @param string|null $first_name The new first name (optional).
     * @param string|null $last_name The new last name (optional).
     * @param string|null $email The new email address (optional).
     */
    public function updateUser($id, $username = null, $password_hash = null, $first_name = null, $last_name = null, $email = null)
    {
        // Create an array to hold the update fields and their values
        $update_fields = [];

        // Prepare the UPDATE statement
        // 
        // We build our UPDATE statement by checking what values were provided
        $update_query = "UPDATE user SET";

        if ($username !== null) {
            $update_query .= " username = :username,";
            $update_fields[':username'] = $username;
        }

        if ($password_hash !== null) {
            $update_query .= " password_hash = :password_hash,";
            $update_fields[':password_hash'] = $password_hash;
        }

        if ($first_name !== null) {
            $update_query .= " firstname = :firstname,";
            $update_fields[':firstname'] = $first_name;
        }

        if ($last_name !== null) {
            $update_query .= " lastname = :lastname,";
            $update_fields[':lastname'] = $last_name;
        }

        if ($email !== null) {
            $update_query .= " email = :email,";
            $update_fields[':email'] = $email;
        }

        // Remove the trailing comma as each update_query has a trailing comma
        // but the trailing comma in the last part of the query is not needed
        $update_query = rtrim($update_query, ',');

        // Add the WHERE clause
        $update_query .= " WHERE id = :id";
        $update_fields[':id'] = $id;

        // Prepare and execute the update statement
        $update_stmt = $this->pdo->prepare($update_query);
        $update_stmt->execute($update_fields);
    }
}
