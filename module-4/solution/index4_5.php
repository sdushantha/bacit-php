<?php
// The reason why we store the task name in a variable instead of directly
// using it in the HTML code is because this file gets inlcuded by index.php,
// which then access $task_name so that it can add it to it's list
$task_name = "Oppgave 5: kontaktskjema";

// In index.php we import this file so that we can access $task_name.
// Without the if-statement below, the HTML code will displayed in index.php.
// __FILE__ and $_SERVER['SCRIPT_FILENAME'] explaination: https://stackoverflow.com/a/29697427/9215267
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])):

// index.php is included as we use the generate_footer() function from it
include "index.php";
?>

<?="<h1>$task_name</h1>"?>

<body>
    <form method="post">
        <label for="name">Navn</label>
        <input type="text" name="name"><br>

        <label for="email">E-post</label>
        <input type="email" name="email"><br>

        <label for="subject">Emnetittel</label>
        <input type="text" name="subject"><br>

        <label for="message">Melding</label>
        <input type="textbox" name="message"><br>

        <input type="submit" value="Send">
    </form>
</body>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST"){
    echo "<b>DIN MELDING</b><br>";
    echo implode("<br>", $_POST);
}
?>


<br>
<?php generate_footer();?>
<?php endif;?>
