<?php
require_once(__DIR__ . "/../../../private/inc/essentials.php");

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

        // Redirect the user to the login page after successful registration
        header("Location: /login");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <style>
        body {
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .registration-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            max-width: 450px;
            width: 100%;
            padding: 20px;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>

<?php if (!$logged_in) : ?>

    <body>
        <div class="container">
            <div class="row">
                <div class="registration-container">
                    <h2 class="text-center"><b>Signup</b></h2>
                    <p class="text-center"></p>
                    <br>
                    <?php if (!empty($errors)) : ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php foreach ($errors as $error) : ?>
                                    <li><?php echo $error ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <form method="post" action="" class="needs-validation" novalidate>
                        <div class="row mb-3">
                            <div class="col">
                                <input type="text" name="first_name" class="form-control" placeholder="First Name" value="<?php echo htmlspecialchars($first_name); ?>" required>
                            </div>
                            <div class="col">
                                <input type="text" name="last_name" class="form-control" placeholder="Last Name" value="<?php echo htmlspecialchars($last_name); ?>" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo htmlspecialchars($username); ?>" required>
                        </div>

                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>" required>
                        </div>

                        <div class="mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>

                        <div class="d-grid gap-2 col-12 mx-auto">
                            <button type="submit" class="btn btn-primary">Signup</button>
                            <br>
                            <p class="text-center">Already have an account? <a href="/login">Login</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php else : ?>
        <!-- If the user is already logged in, redirect to /dashboard -->
        <meta http-equiv="refresh" content="3;url=/dashboard">
        <p id="redirect-message" class="text-center"></p>

        <!-- Reason for using JS instead of PHP along with flush() is so that the count down is in place and live -->
        <script>
            var seconds = 3;

            function countdown() {
                if (seconds === 0) {
                    // Redirect to the dashboard
                    window.location.href = '/dashboard';
                } else {
                    document.getElementById('redirect-message').innerHTML = 'Already logged in. Redirecting to your dashboard in ' + seconds + ' seconds...';
                    seconds--;

                    // Update every second
                    setTimeout(countdown, 1000);
                }
            }
            countdown();
        </script>
    <?php endif; ?>
    </body>

</html>