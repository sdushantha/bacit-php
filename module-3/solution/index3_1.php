<?php
// The reason why we store the task name in a variable instead of directly
// using it in the HTML code is because this file gets inlcuded by index.php,
// which then access $task_name so that it can add it to it's list
$task_name = "Oppgave 1: datosjekk";

// In index.php we import this file so that we can access $task_name.
// Without the if-statement below, the HTML code will displayed in index.php.
// __FILE__ and $_SERVER['SCRIPT_FILENAME'] explaination: https://stackoverflow.com/a/29697427/9215267
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])):

// index.php is included as we use the generate_footer() function from it
include "index.php";
?>

<?="<h1>$task_name</h1>"?>

<?php 
$eventDate = new DateTime("2023-08-04");
$currentDate = new DateTime();

// We use a one-liner if-statement to decide what response to output
echo "<p>Bursdagen til Obama er den " . $eventDate->format("d/m/Y") . ($eventDate > $currentDate ? ". Bursdagen hans er i fremtiden.":". Han har allerede hatt bursdagen sin.")
?>

<?php generate_footer();?>
<?php endif;?>
