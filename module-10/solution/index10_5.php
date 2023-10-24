<?php
// The reason why we store the task name in a variable instead of directly
// using it in the HTML code is because this file gets inlcuded by index.php,
// which then access $task_name so that it can add it to it's list
$task_name = "{{{TASK_NAME}}}";

// In index.php we import this file so that we can access $task_name.
// Without the if-statement below, the HTML code will displayed in index.php.
// __FILE__ and $_SERVER['SCRIPT_FILENAME'] explaination: https://stackoverflow.com/a/29697427/9215267
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])) :

    // index.php is included as we use the generate_footer() function from it
    include "index.php";
    $HOST = "db";
    $PORT = 3306;
    $DBNAME = "bookingsystem";
    $USERNAME = "root";
    $PASSWORD = "root";
    try {
        $pdo = new PDO("mysql:host=$HOST;port=$PORT;dbname=$DBNAME", $USERNAME, $PASSWORD);

        // Set PDO to throw exceptions on errors
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("pdoection failed: " . $e->getMessage());
    }

    function getBookingById($id)
    {
        global $pdo;
        $query = "SELECT * FROM booking WHERE id = $id";
        $stmt = $pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getBookingsBySupervisor($supervisorId)
    {
        global $pdo;
        $query = "SELECT * FROM booking WHERE supervisor_id = $supervisorId";
        $stmt = $pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getBookingsByStudent($studentId)
    {
        global $pdo;
        $query = "SELECT * FROM booking WHERE user_id = $studentId";
        $stmt = $pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getBookingsByMonth($month)
    {
        global $pdo;
        $query = "SELECT * FROM booking WHERE MONTH(time) = $month";
        $stmt = $pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    if (isset($_GET["action"])) {
        $action = $_GET["action"];

        if ($action === "getBookingById" && isset($_GET["id"])) {
            $bookingId = $_GET["id"];
            $output = getBookingById($bookingId);

        } elseif ($action === "getBookingsBySupervisor" && isset($_GET["supervisor_id"])) {
            $supervisorId = $_GET["supervisor_id"];
            $output = getBookingsBySupervisor($supervisorId);

        } elseif ($action === "getBookingsByStudent" && isset($_GET["student_id"])) {
            $studentId = $_GET["student_id"];
            $output = getBookingsByStudent($studentId);

        } elseif ($action === "getBookingsByMonth" && isset($_GET["month"])) {
            $month = $_GET["month"];
            $output = getBookingsByMonth($month);

        } else {
            $output = "Invalid action";
        }

        header("Content-Type: application/json");
        echo json_encode($output);
    } else {
        echo "No action specified.";
    }
?>


<?php endif; ?>