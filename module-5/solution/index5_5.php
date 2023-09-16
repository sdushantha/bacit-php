<?php
// The reason why we store the task name in a variable instead of directly
// using it in the HTML code is because this file gets inlcuded by index.php,
// which then access $task_name so that it can add it to it's list
$task_name = "Oppgave 5: temperaturkonverterer";

// In index.php we import this file so that we can access $task_name.
// Without the if-statement below, the HTML code will displayed in index.php.
// __FILE__ and $_SERVER['SCRIPT_FILENAME'] explaination: https://stackoverflow.com/a/29697427/9215267
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])):

// index.php is included as we use the generate_footer() function from it
include "index.php";
?>

<?="<h1>$task_name</h1>"?>


<!-- HTML form forconvertin C to F and the other way around -->
<form method="post">
    <label for="temp">Temperatur </label>
    <input type="text" name="temp" id="temp">

    <select name="scale">
        <option value="celsius">Celsius</option>
        <option value="fahrenheit">Fahrenheit</option>
    </select>

    <input type="submit" name="convert" value="Konverter">
</form>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Input temp value from user
    $temp = $_POST["temp"];

    // Scale to be used. Selected through drop down menu
    $scale = $_POST["scale"];

    if ($scale == "celsius") {
        // Formula taken from: https://www.almanac.com/temperature-conversion-celsius-fahrenheit
        $fahrenheit = ($temp * 9/5) + 32;
        echo "<p>$temp °C er lik $fahrenheit °F</p>";

    } elseif ($scale == "fahrenheit") {
        // Formula taken from: https://www.almanac.com/temperature-conversion-celsius-fahrenheit
        $celsius = ($temp - 32) * 5/9;
        echo "<p>$temp °F er lik $celsius °C</p>";
    }
}
?>

<?php generate_footer();?>
<?php endif;?>
