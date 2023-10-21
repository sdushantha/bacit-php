<?php
// The reason why we store the task name in a variable instead of directly
// using it in the HTML code is because this file gets inlcuded by index.php,
// which then access $task_name so that it can add it to it"s list
$task_name = "Oppgave 1: lese informasjon om filer";

// In index.php we import this file so that we can access $task_name.
// Without the if-statement below, the HTML code will displayed in index.php.
// __FILE__ and $_SERVER["SCRIPT_FILENAME"] explaination: https://stackoverflow.com/a/29697427/9215267
if (realpath(__FILE__) === realpath($_SERVER["SCRIPT_FILENAME"])) :

    // index.php is included as we use the generate_footer() function from it
    include "index.php";
?>

<?= "<h1>$task_name</h1>" ?>

<?php
    $directory = "folder9_1";
    $iterator = new FilesystemIterator($directory);

    echo '<table border="1">';
    echo "<tr><th>Filename</th><th>Filetype</th><th>Size</th><th>Last modified</th><th>Executable</th><th>Readable</th><th>Writeable</th></tr>";
    foreach ($iterator as $file_path) {
        if ($file_path->isFile()) {
            $type = mime_content_type($file_path->getPathname());
            $size = $file_path->getSize();
            $timestamp = date("Y-m-d H:i:s", $file_path->getMTime());
            $is_executable = $file_path->isExecutable() ? "Yes" : "No";
            $is_readable = $file_path->isReadable() ? "Yes" : "No";
            $is_writable = $file_path->isWritable() ? "Yes" : "No";

            echo "<tr>";
            echo "<td>" . $file_path->getFilename() . "</td>";
            echo "<td>$type</td>";
            echo "<td>$size bytes</td>";
            echo "<td>$timestamp</td>";
            echo "<td>$is_executable</td>";
            echo "<td>$is_readable</td>";
            echo "<td>$is_writable</td>";
            echo "</tr>";
        }
    }

?>

<?php generate_footer(); ?>
<?php endif; ?>
