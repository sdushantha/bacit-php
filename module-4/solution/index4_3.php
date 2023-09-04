<?php
// The reason why we store the task name in a variable instead of directly
// using it in the HTML code is because this file gets inlcuded by index.php,
// which then access $task_name so that it can add it to it's list
$task_name = "Oppgave 3: visning og endring av brukerprofil";

// In index.php we import this file so that we can access $task_name.
// Without the if-statement below, the HTML code will displayed in index.php.
// __FILE__ and $_SERVER['SCRIPT_FILENAME'] explaination: https://stackoverflow.com/a/29697427/9215267
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])):

// index.php is included as we use the generate_footer() function from it
include "index.php";
?>

<?="<h1>$task_name</h1>"?>

<?php
$user_info = [
    "name" => "John Doe",
    "phone" => "12345678",
    "email" => "john.doe@gmail.com"
];

$error_messages = [];
$update_messages = [];


if ($_SERVER["REQUEST_METHOD"] === "POST"){
    if (empty($_POST["name"])){
        $error_messages[] = "Du må fulle inn <b>Navn</b> feltet";
    } else {
        $valid_name_regex = "/^[A-Za-zøæåØÆÅ\s]+$/u"; 
        $error_messages[] = preg_match($valid_name_regex, $_POST["name"]) ? "" : "Navnet ditt er ikke gyldig";
    }

    if (empty($_POST["phone"])){
        $error_messages[] = "Du må fulle inn <b>Telefon</b> feltet";
    } else {
        $valid_phone_regex= "/^\d{8}$/";
        $error_messages[] = preg_match($valid_phone_regex, $_POST["phone"]) ? "" : "Telefon nummeret ditt er ikke gyldig";
    }

    if (empty($_POST["email"])){
        $error_messages[] = "Du må fulle inn <b>E-post</b> feltet";
    } else {
        $error_messages[] = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) ? "" : "E-post'en din er ikke gyldig";
    }

    // Remove blank values in the array. Since we used ternary operators above,
    // we will have blank values and they must removed. Otherwise, we'll have
    // have some empty space on the document
    $error_messages = array_filter($error_messages);

    // What values got updated? Notify the user about those values
    if (empty($error_messages)){
        if ($user_info["name"] != $_POST["name"]){
            $user_info["name"] = $_POST["name"];
            $update_messages[] = "Navnet ditt har blitt oppdatert!";
        }

        if ($user_info["phone"] != $_POST["phone"]){
            $user_info["phone"] = $_POST["phone"];
            $update_messages[] = "Telefon nummeret ditt har blitt oppdatert!";
        }

        if ($user_info["email"] != $_POST["email"]){
            $user_info["email"] = $_POST["email"];
            $update_messages[] = "Eposten din har blitt oppdatert!";
        }

        if (!empty($update_messages)) {
            echo implode("<br>", $update_messages);
        } else {
            echo "Nothing Changed :)";
        }
    } else {
        echo implode("<br>", $error_messages);
    }
}
?>

<body>
    <form method="post">
        <label for="name">Navn</label>

        <input type="text" name="name"  value="<?= $user_info['name'] ?>"><br>

        <label for="phone">Telefon</label>
        <input type="text" name="phone"  value="<?= $user_info['phone'] ?>"><br>

        <label for="email">E-post</label>
        <input type="text" name="email"  value="<?= $user_info['email'] ?>"><br>

        <input type="submit" value="Oppdater Profil">
    </form>
</body>

<?php
echo "Name: " . $user_info["name"] . "<br>";
echo "Phone: " . $user_info["phone"] . "<br>";
echo "Email: " . $user_info["email"] . "<br>";
?>


<?php generate_footer();?>
<?php endif;?>
