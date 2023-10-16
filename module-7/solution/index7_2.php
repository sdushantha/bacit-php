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
require_once(__DIR__ . "/private/inc/essentials.php");
?>

<?="<h1>$task_name</h1>"?>

<?php
// Initialize variables to store form data
$username = $first_name = $last_name = $email = "";
// Initialize an array to store error messages
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input from the form
    $username = strip_tags($_POST["username"]);
    $first_name = strip_tags($_POST["first_name"]);
    $last_name = strip_tags($_POST["last_name"]);
    $email = strip_tags($_POST["email"]);
    $password = strip_tags($_POST["password"]);

    $user_controller = new UserController($pdo);

    // Check if the username and email already exist in the database
    $username_exists = $user_controller->getUserByUsername($username);
    $email_exists = $user_controller->getUserByEmail($email);
    $errors[] = empty($username_exists) ? "" : "Username already exists";
    $errors[] = empty($email_exists) ? "" : "A user with this email already exists";

    // 'u' flag is used for Unicode support as we inlcude øæå
    $valid_name_regex = "/^[A-Za-zøæåØÆÅ\s]+$/u";
    $valid_username_regex = "/^[a-z0-9_-]{3,15}$/";

    $errors[] = filter_var($email, FILTER_VALIDATE_EMAIL) ? "" : "Your email is invalid";
    $errors[] = preg_match($valid_name_regex, $first_name) ? "" : "Your first name is invalid";
    $errors[] = preg_match($valid_name_regex, $last_name) ? "" : "Your last name is invalid";
    $errors[] = preg_match($valid_username_regex, $username) ? "" : "Your username is invalid. Valid username format: <b>[a-z0-9_-]{3,15}</b>";

    // Remove blank values in the array. Since we used ternary operators above,
    // we will have blank values and they must removed. Otherwise, we'll have
    // have some empty space on the document
    $errors = array_filter($errors);

    if (empty($errors)) {
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        $user_controller->createUser($username, $password_hash, $first_name, $last_name, $email);
        echo "Account Created!";
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

    <body>
        <div>
            <div>
                <div>
                    <h2><b>Signup</b></h2>
                    <?php if (!empty($errors)) : ?>
                        <div>
                            <ul>
                                <?php foreach ($errors as $error) : ?>
                                    <li><?php echo $error ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <form method="post" action="" novalidate>
                        <div>
                            <div>
                                <input type="text" name="first_name" placeholder="First Name" value="<?php echo htmlspecialchars($first_name); ?>" required>
                            </div>
                            <div>
                                <input type="text" name="last_name" placeholder="Last Name" value="<?php echo htmlspecialchars($last_name); ?>" required>
                            </div>
                        </div>

                        <div>
                            <input type="text" name="username" placeholder="Username" value="<?php echo htmlspecialchars($username); ?>" required>
                        </div>

                        <div>
                            <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>" required>
                        </div>

                        <div>
                            <input type="password" name="password" placeholder="Password" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Signup</button>
                    </form>
                </div>
            </div>
        </div>
    </body>

</html>
<?php generate_footer();?>
<?php endif;?>
