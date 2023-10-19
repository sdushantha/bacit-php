<?php
require_once(__DIR__ . "/../../../private/inc/essentials.php");
// Initialize an array to store error messages
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input from the form.
    //
    // Reason why we fetch all values:
    //  Even if the user did not update their email, it will still be in the POST request
    //  as we insert values from the DB into the form so that the user can see what the
    //  current values are
    $first_name = strip_tags($_POST["first_name"]);
    $last_name = strip_tags($_POST["last_name"]);
    $email = strip_tags($_POST["email"]);

    $user_controller = new UserController($pdo);

    $userByEmail = $user_controller->getUserByEmail($email);

    // Check if any user with the provided email exists
    if ($userByEmail) {
        // If that user's ID is not the same as the ID of the user who is trying to
        // change their email, let them know this is not possible as an email address
        // can only be connected to ONE account
        if ($userByEmail->getId() !== $_SESSION["user_id"]) {
            $errors[] = "A user with this email already exists";
        }
    }

    // 'u' flag is used for Unicode support as we inlcude øæå
    $valid_name_regex = "/^[A-Za-zøæåØÆÅ\s]+$/u";

    $errors[] = filter_var($email, FILTER_VALIDATE_EMAIL) ? "" : "Your email is invalid";
    $errors[] = preg_match($valid_name_regex, $first_name) ? "" : "Your first name is invalid";
    $errors[] = preg_match($valid_name_regex, $last_name) ? "" : "Your last name is invalid";

    // Remove blank values in the array. Since we used ternary operators above,
    // we will have blank values and they must removed. Otherwise, we'll have
    // have some empty space on the document
    $errors = array_filter($errors);

    // The user only gets updated if the there are no errors or else our DB will get messed up 
    if (empty($errors)) {
        $user_controller->updateUser($_SESSION["user_id"], first_name: $first_name, last_name: $last_name, email: $email);

        // Once the user has been updated, reload the page so that the user can see the updated values.
        // This is done by directing th user to the current page. This simulates a reload.
        header("Location: " . $_SERVER["REQUEST_URI"]);
        exit();
    }
}

// Reason for including the navbar at the bottom is because we have code before this
// where header() is used. header() does not work if HTML is outputted before the function
// is called
require_once(__DIR__ . "/../../../private/inc/navbar.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>

    <style>
        .container {
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

<body>
    <div class="container">
        <div class="row">
            <div class="registration-container">
                <h2 class="text-center"><b>Hey <?= $user->getFirstname() ?>!</b></h2>
                <p class="text-center">Feel free to edit your profile here</p>
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
                            <input type="text" name="first_name" class="form-control" placeholder="First Name" value="<?= $user->getFirstname() ?>" required>
                        </div>
                        <div class="col">
                            <input type="text" name="last_name" class="form-control" placeholder="Last Name" value="<?= $user->getLastname() ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" value="<?= $user->getEmail() ?>" required>
                    </div>

                    <div class="d-grid gap-2 col-12 mx-auto">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>