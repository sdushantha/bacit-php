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
    $new_password = strip_tags($_POST["new_password"]);
    $repeat_password = strip_tags($_POST["repeat_password"]);

    if ($new_password !== $repeat_password){
        $errors[] = "The passwords do not match each other";
    }

    $user_controller = new UserController($pdo);

    // The user only gets updated if the there are no errors or else our DB will get messed up 
    if (empty($errors)) {
        $password_hash = password_hash($new_password, PASSWORD_BCRYPT);

        $user_controller->updateUser($_SESSION["user_id"], password_hash:$password_hash);

        $successMessage = "Password changed successfully!";
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
                <h2 class="text-center"><b>Change Password</b></h2>
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

                <?php if (!empty($successMessage)) : ?>
                    <div class="alert alert-success">
                        <?php echo $successMessage; ?>
                    </div>
                <?php endif; ?>

                <form method="post" action="" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <input type="password" name="new_password" class="form-control" placeholder="New Password" required>
                    </div>

                    <div class="mb-3">
                        <input type="password" name="repeat_password" class="form-control" placeholder="Repeat Password" required>
                    </div>

                    <div class="d-grid gap-2 col-12 mx-auto">
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>