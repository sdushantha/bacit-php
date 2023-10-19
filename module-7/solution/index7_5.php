<?php
// The reason why we store the task name in a variable instead of directly
// using it in the HTML code is because this file gets inlcuded by index.php,
// which then access $task_name so that it can add it to it's list
$task_name = "Oppgave 5: gruppering";

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

// This function allows us to list out the user with the specified preference.
// This is a very hacky function. Only reason this function was created was so that
// there the number of lines of code could be reduced. Without this function, we'd
// have 4x the amount of code where each block only had a minor difference from the rest
function listUsersWithPreference($pdo, $preference_type, $preference_value, $label)
{
    $query = "SELECT firstname FROM user WHERE $preference_type = :preference_value";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":preference_value", $preference_value, PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<b><p>$label</p></b>";
    echo "<ul>";
    foreach ($rows as $row) {
        echo "<li>" . $row["firstname"] . "</li>";
    }
    echo "</ul>";
}


listUsersWithPreference($pdo, "prefered_supervisor", 1, "Bob");
listUsersWithPreference($pdo, "prefered_supervisor", 2, "Alice");
listUsersWithPreference($pdo, "prefered_room", 12, "Room 12");
listUsersWithPreference($pdo, "prefered_room", 45, "Room 45");
?>
<?php generate_footer(); ?>
<?php endif; ?>
