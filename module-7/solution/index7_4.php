<?php
// The reason why we store the task name in a variable instead of directly
// using it in the HTML code is because this file gets inlcuded by index.php,
// which then access $task_name so that it can add it to it's list
$task_name = "Oppgave 4: datostyring";

// In index.php we import this file so that we can access $task_name.
// Without the if-statement below, the HTML code will displayed in index.php.
// __FILE__ and $_SERVER['SCRIPT_FILENAME'] explaination: https://stackoverflow.com/a/29697427/9215267
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])) :

    // index.php is included as we use the generate_footer() function from it
    include "index.php";
    require_once(__DIR__ . "/private/inc/essentials.php");
?>

    <?= "<h1>$task_name</h1>" ?>
    <form method="POST">
        <p>Select sort method</p>
        <select name="sort">
            <option value="ASC">Ascending</option>
            <option value="DESC">Decending</option>
        </select>
        <button type="submit">Sort</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $current_date = date("Y-m-d");
        $order = $_POST["sort"];
        // The sorting method cant be apart of the prepare statement. It has to directly in the query
        $stmt = $pdo->prepare("SELECT * FROM booking WHERE time >= :current_date ORDER BY time $order");
        $stmt->execute(["current_date" => $current_date]);
        echo "<table border='1'>
            <tr>
                <th>Time</th>
                <th>Subject</th>
                <th>Description</th>
            </tr>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row["time"] . "</td>";
            echo "<td>" . $row["subject"] . "</td>";
            echo "<td>" . $row["description"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "Method using: " . $_POST["sort"];
    }

    ?>
    <?php generate_footer(); ?>
<?php endif; ?>