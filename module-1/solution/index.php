<h1>Innlevering 1</h1>

<?php
// Quick way to get all the .php files in the current directory for each
// task and adding a link to the file with the task name
$php_files = glob('*.php');
foreach ($php_files as $php_file){
    if ($php_file !== "index.php") {
        include $php_file;
        echo "<li><a href='$php_file'>$task_name</a></li>";
    }
}
?>