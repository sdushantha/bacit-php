<?php
// The reason why we store the task name in a variable instead of directly
// using it in the HTML code is because this file gets inlcuded by index.php,
// which then access $task_name so that it can add it to it's list
$task_name = "Oppgave 3: valider e-post";

// In index.php we import this file so that we can access $task_name.
// Without the if-statement below, the HTML code will displayed in index.php.
// __FILE__ and $_SERVER['SCRIPT_FILENAME'] explaination: https://stackoverflow.com/a/29697427/9215267
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])):
include "index.php";
?>

<?="<h1>$task_name</h1>"?>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST["email"];

    // Source: https://www.php.net/manual/en/filter.filters.validate.php
    $is_valid = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);

    // Set the values into the cookies
    setcookie("email", $email, time() + 3600, "/");
    setcookie("is_valid", $is_valid, time() + 3600, "/");

    // Redirect back to the same page.
    header("Location: " . $_SERVER["REQUEST_URI"]);

    // Prevents further execution of code and issues
    exit();

}
?>


<body>
    <p>Skriv inn e-posten din</p>
    <form method="post">
        <input type="text" name="email" required>
        <input type="submit" value="Send">
    </form>
</body>


<?php
if (!empty($_COOKIE["email"])) {
    // We must use htmlentities to prevent XSS/HTML injection
    // Fun fact, the following XSS payload is a valid email address: "><svg/onload=confirm(1)>"@x.y
    echo "<p>" .  htmlentities($_COOKIE['email']) . " er " . (!empty($_COOKIE['is_valid']) ? 'gyldig' : 'ikke gyldig') .  "</p>";
}
?>

<?php
// Remove cookies when the user reloads the page
// This way the previous results wont be shown on the page after reloading
if (isset($_COOKIE["email"])) {
    // Removes email from the $_COOKIE array
    unset($_COOKIE["email"]);

    // Removes email from browser's cookie storage 
    setcookie("email", "", time() - 3600, "/");
}

if (isset($_COOKIE["is_valid"])) {
    // Removes is_valid from the $_COOKIE array
    unset($_COOKIE["is_vaild"]);

    // Removes is_valid from browser's cookie storage 
    setcookie("is_valid", "", time() - 3600, "/");
}
?>

<?php generate_footer();?>
<?php endif;?>
