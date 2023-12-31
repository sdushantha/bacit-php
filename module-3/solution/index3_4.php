<?php
// The reason why we store the task name in a variable instead of directly
// using it in the HTML code is because this file gets inlcuded by index.php,
// which then access $task_name so that it can add it to it's list
$task_name = "Oppgave 4: sjekk av fylkestilhørighet";

// In index.php we import this file so that we can access $task_name.
// Without the if-statement below, the HTML code will displayed in index.php.
// __FILE__ and $_SERVER['SCRIPT_FILENAME'] explaination: https://stackoverflow.com/a/29697427/9215267
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])):

// index.php is included as we use the generate_footer() function from it
include "index.php";
?>

<?="<h1>$task_name</h1>"?>

<body>
    <label>Velg kommune</label>
    <form method="post">
        <select name="kommune">
            <?php
            $kommuner = array("Kristiansand", "Lillesand", "Birkenes", "Harstad", "Kvæfjord", "Tromsø", "Bergen", "Trondheim", "Bodø", "Alta");

            // We go through each kommune in the array and create an option in our drop-down menu with kommune
            foreach ($kommuner as $kommune){
                echo "<option value=\"$kommune\">$kommune</option>";
            }
            ?>
        </select>
        <input type="submit" value="Send">
    </form>
</body>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST["kommune"])) {
        $kommune = $_POST["kommune"];

        // We could use case-statement, but since some keys have same values, match-statements are better suited
        $fylke = match ($kommune) {
            "Kristiansand", "Lillesand", "Birkenes" => "Agder",
            "Harstad", "Kværfjord", "Tromsø" => "Troms og Finnmark",
            "Bergen" => "Vestland",
            "Trondheim" => "Trønderlag",
            "Bodø" => "Nordland",
            "Alta" => "Finnmark"
        };

        echo "<p>" . $kommune . " ligger i " . "$fylke" . " fylke</p>";
    }
}
?>

<?php generate_footer();?>
<?php endif;?>
