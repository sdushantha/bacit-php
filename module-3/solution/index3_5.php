<?php
// The reason why we store the task name in a variable instead of directly
// using it in the HTML code is because this file gets inlcuded by index.php,
// which then access $task_name so that it can add it to it's list
$task_name = "Oppgave 5: sjakk og hvete";

// In index.php we import this file so that we can access $task_name.
// Without the if-statement below, the HTML code will displayed in index.php.
// __FILE__ and $_SERVER['SCRIPT_FILENAME'] explaination: https://stackoverflow.com/a/29697427/9215267
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])):

// index.php is included as we use the generate_footer() function from it
include "index.php";
?>

<?="<h1>$task_name</h1>"?>

<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>

<table>
<tr><th>Rute</th><th>Hvetekorn</th><th>Tonn</th></tr>

<?php
$chess_board_size = 64;
$grain_gram= 0.035;
$total_grains = 1;

for ($i = 1; $i <= $chess_board_size; $i++) {
    $grains = 2 ** ($i - 1); 

    // Append currrent amount of grains to the total
    // This value will be used in the end to evaluate total weight of
    // all grains in tonnes
    $total_grains += $grains;

    // grams to tonnes is gram/1,000,000
    $tonnes = $total_grains * $grain_gram / 1000000;

    echo "<tr><td>$i</td><td>$grains</td><td>$tonnes</td></tr>";
}
?>
</table>

<?php
echo "<br>";
echo "Total antall korn: " . $total_grains;
echo "<br>";
echo "Total vekt i tonn: " . $total_grains*$grain_gram/1000000 . " tonn";
echo "<br>";
echo "<br>";
?>

<?php generate_footer();?>
<?php endif;?>
