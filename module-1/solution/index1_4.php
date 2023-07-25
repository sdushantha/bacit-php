<?php
// The reason why we store the task name in a variable instead of directly
// using it in the HTML code is because this file gets inlcuded by index.php,
// which then access $task_name so that it can add it to it's list
$task_name = "Oppgave 4: liten kalkulator";

// In index.php we import this file so that we can access $task_name.
// Without the if-statement below, the HTML code will displayed in index.php.
// __FILE__ and $_SERVER['SCRIPT_FILENAME'] explaination: https://stackoverflow.com/a/29697427/9215267
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])):
?>

<?="<h1>$task_name</h1>"?>

<?php
$tall1 = 100;
$tall2 = 50;

$sum = $tall1 + $tall2;
$average = ($tall1 + $tall2)/2;
?>

<p>Summen av <?=$tall1?> og <?=$tall2?> er <?=$sum?>. Gjennom snittet av <?=$tall1?> og <?=$tall2?> er <?=$average?>

<?php endif;?>