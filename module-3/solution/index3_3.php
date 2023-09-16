<?php
// The reason why we store the task name in a variable instead of directly
// using it in the HTML code is because this file gets inlcuded by index.php,
// which then access $task_name so that it can add it to it's list
$task_name = "Oppgave 3: ny saldo";

// In index.php we import this file so that we can access $task_name.
// Without the if-statement below, the HTML code will displayed in index.php.
// __FILE__ and $_SERVER['SCRIPT_FILENAME'] explaination: https://stackoverflow.com/a/29697427/9215267
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])):

// index.php is included as we use the generate_footer() function from it
include "index.php";
?>

<?="<h1>$task_name</h1>"?>

<body>
    <p>Skriv inn saldo, rente, og antall år</p>
    <form method="post">
        <input type="number" name="saldo" placeholder="10000" required>
        <input type="number" name="rente" step=".1" placeholder="2.2" required>
        <input type="number" name="år" placeholder="3" required>
        <input type="submit" value="Send">
    </form>
</body>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $saldo = $_POST["saldo"];

    // Divide by 100 to turn % into decimal
    $rente = $_POST["rente"]/100;
    $år = $_POST["år"];

    // number_format() allows us to display the number with decimals
    echo "Startsaldo: ". number_format($saldo, 2, '.', '') . "<br>";
    echo "Rente: ". $_POST["rente"] . "% <br>";
    echo "Antall år: ". $år . "<br>";

    for($i = 0; $i < $år+1; $i++){
        // number_format() allows us to display the number with decimals
        echo "$i.År - Saldo: " . number_format($saldo, 2, '.', '') . "<br>";

        // Calculate next saldo
        // We round the number to 2 decimals places
        $saldo = round(($saldo * $rente) + $saldo, 2);
    }
}
?>

<br>

<?php generate_footer();?>
<?php endif;?>
