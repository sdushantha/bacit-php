<?php
// The reason why we store the task name in a variable instead of directly
// using it in the HTML code is because this file gets inlcuded by index.php,
// which then access $task_name so that it can add it to it's list
$task_name = "Oppgave 1: skriv ut innholdet i en matrise";

// In index.php we import this file so that we can access $task_name.
// Without the if-statement below, the HTML code will displayed in index.php.
// __FILE__ and $_SERVER['SCRIPT_FILENAME'] explaination: https://stackoverflow.com/a/29697427/9215267
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])):

// index.php is included as we use the generate_footer() function from it
include "index.php";
?>

<?="<h1>$task_name</h1>"?>

<?php
$myarr = array(
    0 => "null",
    3 => "tre",
    5 => "fem",
    7 => "syv",
    8 => "åtte",
    15 => "femten"
);

echo "<b>Ved å bruke print_r()</b><br>";
print_r($myarr);

echo "<br><br><b>Ved å bruke foreach</b><br>";
foreach ($myarr as $key => $value) {
    echo "$key - $value<br>";
}
?>


<?php generate_footer();?>
<?php endif;?>
