<?php
// This index.php file gets inlcuded by the other task pages so that the generate_footer()
// function can be used. Therefore we must make sure the contents of index.php is not shown
// when its get inlcuded by other pages
// __FILE__ and $_SERVER['SCRIPT_FILENAME'] explaination: https://stackoverflow.com/a/29697427/9215267
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])){
    echo "<h1>Innlevering 6: Objektorientert programmering</h1>";

    // Quick way to get all the .php files in the current directory for each
    // task and adding a link to the file with the task name
    $php_files = glob('*.php');
    foreach ($php_files as $php_file){
        if ($php_file !== "index.php") {
            include $php_file;
            echo "<li><a href='$php_file'>$task_name</a></li>";
        }
    }
}

function generate_footer(){
    /**
     * Automatically generate a footer
     */

    echo "<footer><div>";

    // Get all files in the current dir that ends with .php
    // Since the file names are all numbered, we dont have to mess around with the 
    // order of the array that is returned as they will already be in order.
    $pages = glob('*.php');

    // Get the name of this PHP file
    $current_page = basename($_SERVER['PHP_SELF']);

    // Get the index of where the name of this PHP file is in the array
    $current_page_index = array_search($current_page, $pages);

    echo '<a href="index.php">[Hjem]</a>&nbsp';

    // If current page index is 1, we can't have a previous page that has a task
    if ($current_page_index > 1) {
        $prev_page = $pages[$current_page_index - 1];
        echo '<a href="' . $prev_page . '">[Forrige Oppgave]</a>&nbsp';
    }

    // If current page index is at max, we can't possibly have a next page
    if ($current_page_index < count($pages) - 1) {
        $next_page = $pages[$current_page_index + 1];
        echo '<a href="' . $next_page . '">[Neste Oppgave]</a>';
    }

    echo "</div></footer>";
}
?>
