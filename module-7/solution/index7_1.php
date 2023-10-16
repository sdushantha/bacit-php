<?php
// The reason why we store the task name in a variable instead of directly
// using it in the HTML code is because this file gets inlcuded by index.php,
// which then access $task_name so that it can add it to it's list
$task_name = "Oppgave 1: liste";

// In index.php we import this file so that we can access $task_name.
// Without the if-statement below, the HTML code will displayed in index.php.
// __FILE__ and $_SERVER['SCRIPT_FILENAME'] explaination: https://stackoverflow.com/a/29697427/9215267
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])) :

    // index.php is included as we use the generate_footer() function from it
    include "index.php";
    require_once(__DIR__ . "/private/inc/essentials.php");
?>

<?= "<h1>$task_name</h1>" ?>

<?php

    $stmt = $pdo->query("SELECT * FROM booking");

    // Check if there are any results
    // Since I use docker, i tend to forget to populate the DB after destroying the container :/
    if ($stmt->rowCount() > 0) {
        echo '<table border="1">';
        echo "<tr><th>ID</th><th>Supervisor ID</th><th>User ID</th><th>Time</th><th>Subject</th><th>Description</th></tr>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["supervisor_id"] . "</td>";
            echo "<td>" . $row["user_id"] . "</td>";
            echo "<td>" . $row["time"] . "</td>";
            echo "<td>" . $row["subject"] . "</td>";
            echo "<td>" . $row["description"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No records found.";
    }
?>


<?php generate_footer(); ?>
<?php endif; ?>
