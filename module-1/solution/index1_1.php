<?php
// The reason why we store the task name in a variable instead of directly
// using it in the HTML code is because this file gets inlcuded by index.php,
// which then access $task_name so that it can add it to it's list
$task_name = "Oppgave 1: bli kjent med diskusjonsforumet";

// In index.php we import this file so that we can access $task_name.
// Without the if-statement below, the HTML code will displayed in index.php.
// __FILE__ and $_SERVER['SCRIPT_FILENAME'] explaination: https://stackoverflow.com/a/29697427/9215267
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])):
include "index.php";
?>

<?="<h1>$task_name</h1>"?>

<ul>
    <li>Brukernavn: sdushantha</li>
    <li>Link til min melding: <a href="https://discord.com/channels/1098589617411866624/1098589617780949007/1129307358074503238">https://discord.com/channels/1098589617411866624/1098589617780949007/1129307358074503238</a></li>
</ul>

<?php generate_footer();?>
<?php endif;?>
