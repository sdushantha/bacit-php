<?php
// The reason why we store the task name in a variable instead of directly
// using it in the HTML code is because this file gets inlcuded by index.php,
// which then access $task_name so that it can add it to it's list
$task_name = "Oppgaver 4: valideringsklasse I";

// In index.php we import this file so that we can access $task_name.
// Without the if-statement below, the HTML code will displayed in index.php.
// __FILE__ and $_SERVER['SCRIPT_FILENAME'] explaination: https://stackoverflow.com/a/29697427/9215267
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])):

// index.php is included as we use the generate_footer() function from it
include "index.php";
?>

<?="<h1>$task_name</h1>"?>

<?php

Class Validate {
    // By using a method function, we can use this method without creating an object
    public static function email($email){
            // We use !== false as filter_var() returns the email or false
            // In order to only get a boolean value, we can check if the value is not
            // equal to false
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
}

if (Validate::email("bob@mail.com")) {
    echo "bob@mail.com is valid<br>";
} else {
    echo "bob@mail.com is not valid<br>";
}


if (Validate::email("bob@--mail.com")) {
    echo "bob@--mail.com is valid<br>";
} else {
    echo "bob@--mail.com is not valid<br>";
}
?>

<?php generate_footer();?>
<?php endif;?>
