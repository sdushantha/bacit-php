<?php
// The reason why we store the task name in a variable instead of directly
// using it in the HTML code is because this file gets inlcuded by index.php,
// which then access $task_name so that it can add it to it's list
$task_name = "Oppgave 1: sjekk av etternavn";

// In index.php we import this file so that we can access $task_name.
// Without the if-statement below, the HTML code will displayed in index.php.
// __FILE__ and $_SERVER['SCRIPT_FILENAME'] explaination: https://stackoverflow.com/a/29697427/9215267
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])):
include "index.php";
?>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // 1. Replace all characters that are not a-z or A-Z
    // 2. Make the whole string lowercase
    // 3. Upper Case First letter
    $lastname = ucfirst(strtolower(preg_replace('/[^a-zA-Z]/', '', $_POST["name"])));
    $length = strlen($lastname);

    // Store the values in the cookies. By doing this we can clear the previous submission
    // when the user reloads the page
    setcookie("lastname", $lastname, time() + 3600, "/");
    setcookie("length", $length, time() + 3600, "/");

    // Redirect back to the same page.
    header("Location: " . $_SERVER["REQUEST_URI"]);

    // Prevents further execution of code and issues
    exit();
}
?>

<?="<h1>$task_name</h1>"?>

<body>
    <p>Skriv inn etternavnet ditt</p>
    <form method="post">
        <input type="text" name="name" required>
        <input type="submit" value="Send">
    </form>
</body>

<!-- If the value exists in the cookie, then output the results, if not, dont output anything. This allows us to not show the previous submission -->
<?php if (!empty($_COOKIE["lastname"])) echo "<p>Etternavnet ditt er " . htmlspecialchars($_COOKIE['lastname']) . "</p>" ?>
<?php if (!empty($_COOKIE["length"])) echo "<p>Etternavnet ditt har ". htmlspecialchars($_COOKIE['length']) . " bokstaver</p>" ?>

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
