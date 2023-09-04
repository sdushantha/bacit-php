<?php
// The reason why we store the task name in a variable instead of directly
// using it in the HTML code is because this file gets inlcuded by index.php,
// which then access $task_name so that it can add it to it's list
$task_name = "Oppgave 2: registrering av ny bruker";

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

        <input type="text" name="name" placeholder="John Doe" value=<?= isset($_POST["name"]) ? $_POST["name"] : ""?>><br>

        <label for="phone">Telefon</label>
        <input type="text" name="phone" placeholder="12345678" value=<?= isset($_POST["phone"]) ? $_POST["phone"] : ""?>><br>

        <label for="email">E-post</label>
        <input type="text" name="email" placeholder="john.doe@gmail.com" value=<?= isset($_POST["email"]) ? $_POST["email"] : ""?>><br>

        <input type="submit" value="Send">
    </form>
</body>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];

    // Store the form values in an array with norweigan keys so that we can
    // give output in the correct language
    $user_info = [
        "Navn" => $name,
        "Telefon" => $phone,
        "E-post" => $email,
    ];

    // We wil store all values that are missing this in this array
    // so that we can notify the user about them after checking all of them
    $missing_info = [];

    // Check if any is empty
    foreach ($user_info as $key => $value){
        if (empty($value)){
            $missing_info[] = $key;
        }
    }

    // Notify the user about missing values, if any
    if (!empty($missing_info)){
        echo "<p>Du må fulle inn <b>" . implode(", ", $missing_info) . "</b></p>";
    }
    
    if (empty($missing_info)){
        // We store all the error messages in this array so that we
        // can notify the user about them afterwards if needed
        $error_messages = [];

        // 'u' flag is used for Unicode support as we inlcude øæå
        $valid_name_regex = "/^[A-Za-zøæåØÆÅ\s]+$/u"; 
        $valid_phone_regex= "/^\d{8}$/";

        $error_messages[] = preg_match($valid_name_regex, $name) ? "" : "Navnet ditt er ikke gyldig";
        $error_messages[] = preg_match($valid_phone_regex, $phone) ? "" : "Telefon nummeret ditt er ikke gyldig";
        $error_messages[] = filter_var($email, FILTER_VALIDATE_EMAIL) ? "" : "E-post'en din er ikke gyldig";

        // Remove blank values in the array. Since we used ternary operators above,
        // we will have blank values and they must removed. Otherwise, we'll have
        // have some empty space on the document
        $error_messages = array_filter($error_messages);

        if (!empty($error_messages)) {
            echo implode("<br> ", $error_messages);
        } else {

            // Output user's information as a table
            echo "<b>Info om deg</b><br><table>";
            foreach ($user_info as $key => $value){
                echo "<tr><td>$key</td><td>$value</td></tr>";
            }
            echo "</table>";
        }
    }
}
?>


<?php generate_footer();?>
<?php endif;?>
