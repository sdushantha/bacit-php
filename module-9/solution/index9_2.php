<?php
// The reason why we store the task name in a variable instead of directly
// using it in the HTML code is because this file gets inlcuded by index.php,
// which then access $task_name so that it can add it to it's list
$task_name = "Oppgave 2: loggfunksjon";

// In index.php we import this file so that we can access $task_name.
// Without the if-statement below, the HTML code will displayed in index.php.
// __FILE__ and $_SERVER['SCRIPT_FILENAME'] explaination: https://stackoverflow.com/a/29697427/9215267
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])):

// index.php is included as we use the generate_footer() function from it
include "index.php";
?>

<?="<h1>$task_name</h1>"?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $log_file = "mouse-movement-log.txt";
    
    if (isset($_POST["getLog"])){
        if (file_exists($log_file)){
            $log_data = file($log_file);
            $last_ten_events = array_slice(array_reverse($log_data), 0, 10);
            echo "<h2>Last 10 Mouse Movements</h2>";
            echo "<ul>";
            foreach ($last_ten_events as $event) {
                echo "<li>$event</li>";
            }
            echo "</ul>";
        }
    } else {
        $x = $_POST["x"];
        $y = $_POST["y"];

        $timestamp = date("Y-m-d H:i:s");
        
        // https://www.php.net/manual/en/function.file-put-contents.php
        // Instead of locking the file using flock(), we can pass LOCK_EX into file_put_contents
        file_put_contents($log_file, "[$timestamp] User moved mouse to X:$x, Y:$y\n", FILE_APPEND | LOCK_EX);
    }
}
?>

<form method="post">
  <input type="submit" name="getLog" value="Get log">
</form> 


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
document.addEventListener('mousemove', logMouseMovement);

function logMouseMovement(event) {
    $.post("index9_2.php", {
        x: event.clientX,
        y: event.clientY
    });
}
</script>
<?php generate_footer();?>
<?php endif;?>
