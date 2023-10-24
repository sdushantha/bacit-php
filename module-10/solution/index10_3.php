<?php
// The reason why we store the task name in a variable instead of directly
// using it in the HTML code is because this file gets inlcuded by index.php,
// which then access $task_name so that it can add it to it's list
$task_name = "Oppgave 3: finn API";

// In index.php we import this file so that we can access $task_name.
// Without the if-statement below, the HTML code will displayed in index.php.
// __FILE__ and $_SERVER['SCRIPT_FILENAME'] explaination: https://stackoverflow.com/a/29697427/9215267
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])):

// index.php is included as we use the generate_footer() function from it
include "index.php";
?>

<?="<h1>$task_name</h1>"?>

<?php
$latitude = 58.1638461;
$longitude = 8.0030351;

$base_url = 'https://www.openstreetmap.org/export/embed.html';

$bbox = ($longitude - 0.01) . "," . ($latitude - 0.01) . "," . ($longitude + 0.01) . "," . ($latitude + 0.01);
$map_url = $base_url . "?bbox=" . $bbox . "&layer=mapnik&marker=" . $latitude . "," . $longitude;
echo '<iframe width="600" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="' . $map_url. '"></iframe>';
?>


<?php generate_footer();?>
<?php endif;?>
