<?php
// The reason why we store the task name in a variable instead of directly
// using it in the HTML code is because this file gets inlcuded by index.php,
// which then access $task_name so that it can add it to it's list
$task_name = "Oppgave 4: liten kalkulator";

// In index.php we import this file so that we can access $task_name.
// Without the if-statement below, the HTML code will displayed in index.php.
// __FILE__ and $_SERVER['SCRIPT_FILENAME'] explaination: https://stackoverflow.com/a/29697427/9215267
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])):
include "index.php";
?>

<?="<h1>$task_name</h1>"?>

<?php
$tall1 = 100;
$tall2 = 50;


function sum($num1, $num2){
    /**
     * Calculate the sum of two numbers
     * 
     * @param integer  $num1 first number to sum
     * @param integer  $num2 first number to sum
     */

    return $num1 + $num2;
}

function average($num1, $num2){
    /**
     * Calculate the average of two numbers
     * 
     * @param integer  $num1 first number to average
     * @param integer  $num2 first number to average
     */
    return ($num1 + $num2)/2;
}
?>

<p>Summen av <?=$tall1?> og <?=$tall2?> er <?=sum($tall1, $tall2);?>. Gjennom snittet av <?=$tall1?> og <?=$tall2?> er <?=average($tall1, $tall2);?>

<?php generate_footer();?>
<?php endif;?>