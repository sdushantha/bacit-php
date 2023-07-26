<?php
// The reason why we store the task name in a variable instead of directly
// using it in the HTML code is because this file gets inlcuded by index.php,
// which then access $task_name so that it can add it to it's list
$task_name = "Oppgave 2: innstillinger i php.ini";

// In index.php we import this file so that we can access $task_name.
// Without the if-statement below, the HTML code will displayed in index.php.
// __FILE__ and $_SERVER['SCRIPT_FILENAME'] explained: https://stackoverflow.com/a/29697427/9215267
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])):
include "index.php";
?>

<?="<h1>$task_name</h1>"?>
<ul>
    <li>Ved å sjekke verdien for <code>display_errors</code>, så ser jeg at Local og Master verdien er sastt til <code>Off</code></li>
    <li>Veriden for <code>document_root</code> er <code><?=$_SERVER['DOCUMENT_ROOT']?></code>. Det er lurt å sjekke  <code>phpinfo()</code> hvis man ser at det at programmet ikke funker som det skal. F.eks kan man sjekke om det som ligger i <code>php.ini</code> er riktig fordi den konfigurasjons filen kan påvirke veldig hvordan programmet oppfører seg.</li>
</ul>

<?php generate_footer();?>
<?php endif;?>