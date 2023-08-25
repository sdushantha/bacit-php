<?php
// The reason why we store the task name in a variable instead of directly
// using it in the HTML code is because this file gets inlcuded by index.php,
// which then access $task_name so that it can add it to it's list
$task_name = "Oppgave 2: teller med pause";

// In index.php we import this file so that we can access $task_name.
// Without the if-statement below, the HTML code will displayed in index.php.
// __FILE__ and $_SERVER['SCRIPT_FILENAME'] explaination: https://stackoverflow.com/a/29697427/9215267
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])):

// index.php is included as we use the generate_footer() function from it
include "index.php";
?>

<?="<h1>$task_name</h1>"?>
    <?php
    $sum = 0;
    
    for ($i = 0; $i <= 9; $i++) {
        echo $i . "<br>";
        $sum += $i;

        // This flushes the system write buffers of PHP to the Browser.
        // So whatever that is going to be written onto the page gets written
        // before it acutally is supposed to. This way we get the effect of having
        // each answer being displayed one by one
        // Source: https://www.php.net/manual/en/function.flush.php
        flush();
        sleep(1);
    }

    sleep(2);

    echo "Total sum: " . $sum;
    ?>

<?php generate_footer();?>
<?php endif;?>
