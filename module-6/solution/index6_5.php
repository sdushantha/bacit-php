<?php
// The reason why we store the task name in a variable instead of directly
// using it in the HTML code is because this file gets inlcuded by index.php,
// which then access $task_name so that it can add it to it's list
$task_name = "Oppgave 5: valideringsklasse II";

// In index.php we import this file so that we can access $task_name.
// Without the if-statement below, the HTML code will displayed in index.php.
// __FILE__ and $_SERVER['SCRIPT_FILENAME'] explaination: https://stackoverflow.com/a/29697427/9215267
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])):

// index.php is included as we use the generate_footer() function from it
include "index.php";
?>

<?="<h1>$task_name</h1>"?>

<?php
class Validate {
    public static function input($input){
        if (self::isEmail($input)){
            return "This is a valid email";
        } elseif (self::isPhoneNumber($input)){
            return "This is a valid phone number";
        } elseif (self::isPassword($input)){
            return "This is a valid password";
        } else {
            return "Input is not valid";
        }

    }

    private static function isEmail($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    private static function isPhoneNumber($phonenumber){
    }

    private static function isPassword($password){
        // Passordkrav:
        //  - minst én stor bokstav
        //  - minst to tall
        //  - minst ett spesialtegn
        //  - minst ni tegn totalt
        // https://regex101.com/r/48GvrV/1
        return preg_match("/^(?=.*[A-Za-z])(?=.*\d.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{9,}$/", $password);
    }
}


$valid_email = "bob@gmail.com";
$valid_phonenr = "12345678";
$valid_password = "A12!jdjdj";

$invalid_email = "bob@--gmail.com";
$invalid_phonenr = "1234";
$invalid_password = "A2!jdjdj";


echo "<b>$valid_email: </b>" . Validate::input($valid_email) . "<br>";
echo "<b>$invalid_email: </b>" . Validate::input($invalid_email) . "<br><br>";

echo "<b>$valid_phonenr: </b>" . Validate::input($valid_phonenr) . "<br>";
echo "<b>$invalid_phonenr: </b>" . Validate::input($invalid_phonenr) . "<br><br>";


echo "<b>$valid_password: </b>" . Validate::input($valid_password) . "<br>";
echo "<b>$invalid_password: </b>" . Validate::input($invalid_password) . "<br><br>";
?>

<?php generate_footer();?>
<?php endif;?>
