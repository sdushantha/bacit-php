<?php
// The reason why we store the task name in a variable instead of directly
// using it in the HTML code is because this file gets inlcuded by index.php,
// which then access $task_name so that it can add it to it's list
$task_name = "Oppgave 4: differanse";

// In index.php we import this file so that we can access $task_name.
// Without the if-statement below, the HTML code will displayed in index.php.
// __FILE__ and $_SERVER['SCRIPT_FILENAME'] explaination: https://stackoverflow.com/a/29697427/9215267
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])):
include "index.php";
?>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $tall1 = preg_replace('/[^0-9\-]/', '', $_POST["tall1"]);
    $tall2 = preg_replace('/[^0-9\-]/', '', $_POST["tall2"]);
    $diff = $tall1 - $tall2;

    // Store the values in the cookies. By doing this we can clear the previous submission
    // when the user reloads the page
    setcookie("tall1", $tall1, time() + 3600, "/");
    setcookie("tall2", $tall2, time() + 3600, "/");
    setcookie("diff", $diff, time() + 3600, "/");

    // Redirect back to the same page.
    header("Location: " . $_SERVER["REQUEST_URI"]);

    // Prevents further execution of code and issues
    exit();
}
?>

<?="<h1>$task_name</h1>"?>

<body>
    <p>Skriv inn to tall</p>
    <form method="post">
        <input type="number" name="tall1" required>
        <input type="number" name="tall2" required>
        <input type="submit" value="Send">
    </form>
</body>

<?php if (!empty($_COOKIE["tall1"])) echo "<p>Differansen mellom " . htmlspecialchars($_COOKIE['tall1']) . " og " . htmlspecialchars($_COOKIE['tall2']) . " er " . htmlspecialchars($_COOKIE['diff']) . "</p>" ?>

<?php
// Remove cookies when the user reloads the page
// This way the previous results wont be shown on the page after reloading
foreach ($_COOKIE as $key => $value){
    // Removes the value from the $_COOKIE array
    unset($_COOKIE[$key]);

    // Removes the value from browser's cookie storage 
    setcookie($key, "", time() - 3600, "/");
}
?>
<?php generate_footer();?>
<?php endif;?>
