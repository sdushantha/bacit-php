<?php
// The reason why we store the task name in a variable instead of directly
// using it in the HTML code is because this file gets inlcuded by index.php,
// which then access $task_name so that it can add it to it's list
$task_name = "Oppgave 1: kontaktskjema";

// In index.php we import this file so that we can access $task_name.
// Without the if-statement below, the HTML code will displayed in index.php.
// __FILE__ and $_SERVER['SCRIPT_FILENAME'] explaination: https://stackoverflow.com/a/29697427/9215267
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])):

// index.php is included as we use the generate_footer() function from it
include "index.php";
?>

<?="<h1>$task_name</h1>"?>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Clean up the input
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars($_POST["subject"]);
    $message = htmlspecialchars($_POST["message"]);

    // Check if any required fields are empty
    if (empty($email) || empty($subject) || empty($message)) {
        echo "Please fill in all fields.";
    } else {
        $headers = [
            "Content-Type: application/json",
            "Authorization: Bearer re_YZtRniEs_GmLKdeXffXdNJGE62ZmZ77tD",
        ];

        $data = [
            "from" => "onboarding@resend.dev",
            "to" => $email,
            "subject" => $subject,
            "html" => $message,
        ];

        // Create context options with headers for the API request
        $api_options = [
            "http" => [
                "method" => "POST",
                "header" => implode("\r\n", $headers),
                "content" => json_encode($data),
            ],
        ];

        // Create a stream context for the API request
        $api_context = stream_context_create($api_options);

        // Send the API POST request and get the response
        $api_response = file_get_contents("https://api.resend.com/emails", false, $api_context);

        if ($api_response === false) {
            echo "Email failed to send";
        } else {
            echo "Email sent!";
        }
    }
}
?>

<body>
    <form method="post">

        <label for="email">Email</label>
        <input type="email" name="email"><br>

        <label for="subject">Subject</label>
        <input type="text" name="subject"><br>

        <label for="message">Body</label>
        <textarea name="message"></textarea><br>

        <input type="submit" value="Send">
    </form>
</body>


<?php generate_footer();?>
<?php endif;?>
