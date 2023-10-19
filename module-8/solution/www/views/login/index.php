<?php
require_once(__DIR__ . "/../../../private/inc/essentials.php");

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $user_controller = new UserController($pdo);
        $user = $user_controller->getUserByUsername($username);

        // Check if the user exists and if the password is valid before allowing
        // further access to the web app.
        //
        // The reason why return "Wrong Password" if the username does not exist,
        // is so that an attacker will be unable to do username enumeration
        if ($user && password_verify($password, $user->getPasswordHash())) {
            $_SESSION['user_id'] = $user->getId();
            $_SESSION['username'] = $user->getUsername();

            header("Location: /dashboard");
            exit();
        } else {
            $errorMessage = "Wrong username or password";
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <style>
        body {
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            max-width: 400px;
            width: 100%;
            padding: 20px;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <?php if (!$logged_in) : ?>
        <div class="container">
            <div class="row">
                <div class="login-container">
                    <h2 class="text-center"><b>Welcome!</b></h2>
                    <p class="text-center">Log in to your account</p>
                    <br>
                    <form method="post" action="">
                        <?php if (isset($errorMessage)) : ?>
                            <div class="alert alert-danger alert-dismissible show" role="alert">
                                <?php echo $errorMessage; ?>
                            </div>
                        <?php endif; ?>

                        <?php if (isset($_SESSION["logout"])) : ?>
                            <div class="alert alert-primary text-center" role="alert">
                                <?php
                                echo "You have been logged out";
                                unset($_SESSION["logout"]);
                                ?>
                            </div>
                        <?php endif; ?>
                        <div class="mb-3">
                            <input type="text" name="username" class="form-control" placeholder="Username" required>
                        </div>

                        <div class="mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>

                        <div class="d-grid gap-2 col-12 mx-auto">
                            <button type="submit" class="btn btn-primary">Login</button>
                            <br>
                            <p class="text-center">Don't have an account? <a href="/signup">Signup</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php else : ?>
        <!-- If the user is already logged in, redirect to /dashboard -->
        <meta http-equiv="refresh" content="3;url=/dashboard">
        <p id="redirect-message" class="text-center"></p>

        <!-- Reason for using JS instead of PHP along flush() is so that the count down is in place and live -->
        <script>
            var seconds = 3;

            function countdown() {
                if (seconds === 0) {
                    window.location.href = '/dashboard';
                } else {
                    document.getElementById('redirect-message').innerHTML = 'Already logged in. Redirecting to your dashboard in ' + seconds + ' seconds...';
                    seconds--;
                    setTimeout(countdown, 1000);
                }
            }
            countdown();
        </script>
    <?php endif; ?>
</body>

</html>