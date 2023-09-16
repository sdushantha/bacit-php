<?php
// The reason why we store the task name in a variable instead of directly
// using it in the HTML code is because this file gets inlcuded by index.php,
// which then access $task_name so that it can add it to it's list
$task_name = "Oppgave 4: kryptering";

// In index.php we import this file so that we can access $task_name.
// Without the if-statement below, the HTML code will displayed in index.php.
// __FILE__ and $_SERVER['SCRIPT_FILENAME'] explaination: https://stackoverflow.com/a/29697427/9215267
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])):

// index.php is included as we use the generate_footer() function from it
include "index.php";
?>

<?="<h1>$task_name</h1>"?>

<?php


// The way the encryption works is by shifting the char by one forwards
function encrypt($string, $shift = 1){
    // Reason why we have $shift as a parameter is so that we can use this
    // encrypt function to decrypt. This is done by providing a negative value
    $encrypted_string = "";
    foreach (mb_str_split($string) as $char) {
        // 1. Convert char to char code
        // 2. Add +1 to char code
        // 3. Convert back to to char
        // 4. Append to string
        $encrypted_string .= chr(ord($char) + $shift);
    }
    return $encrypted_string;
}


function decrypt($string){
    // We can use the encrypt() function to decrypt by providing a negative value
    return encrypt($string, $shift = -1);
}

// These vars are used to hide/unhide the encrypt and decrypt forms
$hide_encrypt = false;
$hide_decrypt = true;

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    if (isset($_POST["encrypt"])) {
        $hide_encrypt = true;
        $hide_decrypt = false;
        $result = encrypt($_POST["text"]);
    }

    if (isset($_POST["decrypt"])) {
        $hide_decrypt = true;
        $hide_encrypt = false;
        $result = decrypt($_POST["text"]);
    }
}
?>


<?php if (!$hide_encrypt): ?>
    <body>
        <form method="post">
            <label for="name">Tekst</label>
            <input type="text" name="text"><br><br>

            <input type="submit" name="encrypt" value="Krypter">
        </form>
    </body>
<?php endif; ?>

<?php if (!$hide_decrypt): ?>
    <body>
        <form method="post">
            <label for="name">Tekst</label>
            <input type="text" name="text"><br><br>

            <input type="submit" name="decrypt" value="Dekrypter">
        </form>
    </body>
<?php endif; ?>


<?php if (isset($result)) echo "<br>Result: " . $result; ?>



<?php generate_footer();?>
<?php endif;?>
