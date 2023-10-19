<?php
session_start();
// Users will most likely visit the root directory instead of /login or /dashboard.
// Therefore, we can redirect them to the correct depending on if they are logged in or not
if (isset($_SESSION["user_id"])){
    header("Location: /dashboard");
    exit();

} else {
    header("Location: /login");
    exit();
}

?>