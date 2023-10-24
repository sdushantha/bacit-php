<?php
// The reason why we store the task name in a variable instead of directly
// using it in the HTML code is because this file gets inlcuded by index.php,
// which then access $task_name so that it can add it to it's list
$task_name = "Oppgave 4: nedlasting av fil";

// In index.php we import this file so that we can access $task_name.
// Without the if-statement below, the HTML code will displayed in index.php.
// __FILE__ and $_SERVER['SCRIPT_FILENAME'] explaination: https://stackoverflow.com/a/29697427/9215267
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])) :

    // index.php is included as we use the generate_footer() function from it
    include "index.php";
    if (isset($_GET["file"])) {
        $filename = $_GET["file"];
        if ($filename === "mod-9" || $filename === "mod-6") {
            $filepath = "documents/$filename.pdf";
            if (file_exists("$filepath")) {
                header("Content-Type: application/pdf");
                header("Content-Disposition: attachment; filename=\"$filename.pdf\"");

                readfile("$filepath");
                exit();
            } else {
                echo "Sry, file not found";
            }
        }
    }
?>


    <?= "<h1>$task_name</h1>" ?>
    <a href="?file=mod-6">Download mod-6.pdf</a>
    <br>
    <a href="?file=mod-9">Download mod-9.pdf</a>

    <br>
    <br>

    <?php generate_footer(); ?>
<?php endif; ?>