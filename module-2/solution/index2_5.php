<?php
// The reason why we store the task name in a variable instead of directly
// using it in the HTML code is because this file gets inlcuded by index.php,
// which then access $task_name so that it can add it to it's list
$task_name = "Oppgave 5: passordgenerator";

// In index.php we import this file so that we can access $task_name.
// Without the if-statement below, the HTML code will displayed in index.php.
// __FILE__ and $_SERVER['SCRIPT_FILENAME'] explaination: https://stackoverflow.com/a/29697427/9215267
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])):
include "index.php";
?>

<?="<h1>$task_name</h1>"?>

<?php
function generateRandomPassword(){
    // We could seperate the uppsercase, lowercase and the numbers but having them all combined
    // decreases the lines of code
    $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    $password = "";

    // We generate a random integer so that we can fetch a random uppercase character
    $password .= $chars[rand(0,25)];

    // We could use the same method above as $chars includes integers but its shorter
    // to just use rand()
    $password .= rand(0,9);

    // Logic: 
    // We already have 2 characters for our password
    // 6 more is needed
    // These will be fetched from $chars and appended to $password
    for ($i = 0; $i < 6; $i ++){
        $password .= $chars[rand(0, strlen($chars) - 1)];
    }

    // Shuffle the password so to make it seem more random
    // If this is not done, the first two characters will always be an uppercase character and an integer
    return str_shuffle($password);
}

echo "<p><b>Ditt tilfeldig passord er:</b> " . generateRandomPassword() . "</p>";
?>

<!-- This button just reloads the page -->
<form method="get">
    <input type="submit" value="Generer tilfeldig passord" />
</form>

<?php generate_footer();?>
<?php endif;?>
