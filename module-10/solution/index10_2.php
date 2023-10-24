<?php
// The reason why we store the task name in a variable instead of directly
// using it in the HTML code is because this file gets inlcuded by index.php,
// which then access $task_name so that it can add it to it's list
$task_name = "Oppgave 2: e-post i HTML-format";

// In index.php we import this file so that we can access $task_name.
// Without the if-statement below, the HTML code will displayed in index.php.
// __FILE__ and $_SERVER['SCRIPT_FILENAME'] explaination: https://stackoverflow.com/a/29697427/9215267
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])) :

    // index.php is included as we use the generate_footer() function from it
    include "index.php";
?>

<?= "<h1>$task_name</h1>" ?>

<?php
    $html = '
        <body>
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td align="center">
                        <img src="https://i.imgur.com/VZxKVNz.png" width="200" height="100">
                    </td>
                </tr>
                <tr>
                    <td>
                        <h1>Daily News</h1>
                        <p>Greetings, here is your daily news:</p>
                        <ul>
                            <li><a href="https://example.com">News Article 1</a></li>
                            <li><a href="https://example.com">News Article 2</a></li>
                            <li><a href="https://example.com">News Article 3</a></li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Sent by Daily News AS</p>
                        <p>Contact us at: support@dailynews.no</p>
                    </td>
                </tr>
            </table>
        </body>';

    $headers = [
        "Content-Type: application/json",
        "Authorization: Bearer re_YZtRniEs_GmLKdeXffXdNJGE62ZmZ77tD",
    ];

    $data = [
        "from" => "onboarding@resend.dev",
        "to" => "siddharth.dushantha@gmail.com",
        "subject" => "Daily News - Your Daily Update",
        "html" => $html,
    ];

    // Create context options with headers for the API request
    $options = [
        "http" => [
            "method" => "POST",
            "header" => implode("\r\n", $headers),
            "content" => json_encode($data),
        ],
    ];

    // Create a stream context for the API request
    $context = stream_context_create($options);

    // Send the API POST request and get the response
    $response = file_get_contents("https://api.resend.com/emails", false, $context);

    if ($response === false) {
        echo "Email failed to send";
    } else {
        echo "<b>Email sent! Check your email</b>";
    }
?>


<?php generate_footer(); ?>
<?php endif; ?>
