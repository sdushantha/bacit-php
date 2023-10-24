<?php
// The reason why we store the task name in a variable instead of directly
// using it in the HTML code is because this file gets inlcuded by index.php,
// which then access $task_name so that it can add it to it's list
$task_name = "Oppgave 5: faktura";

// In index.php we import this file so that we can access $task_name.
// Without the if-statement below, the HTML code will displayed in index.php.
// __FILE__ and $_SERVER['SCRIPT_FILENAME'] explaination: https://stackoverflow.com/a/29697427/9215267
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])):

// index.php is included as we use the generate_footer() function from it
include "index.php";
require_once('fpdf/fpdf.php');
require_once('fpdi2/src/autoload.php');

$pdf = new \setasign\Fpdi\Fpdi();

$pdf->AddPage();

$pdf->setSourceFile("template.pdf");

$fs = $pdf->importPage(1);

$pdf->useTemplate($fs);

$pdf->setFont("Arial", "", 10);

$pdf->Image('happy.png', 100, 40, 20);

$pdf->setY(45);

$pdf->setX(13);
$pdf->cell(100, 5, "Bob Smith", 0, 1, "L");

$pdf->setX(13);
$pdf->cell(100, 5, "Storbyen 30, Norge", 0, 1, "L");

$pdf->setY(65);
$pdf->setX(95);
$pdf->cell(100, 5, "Maskine Salg AS", 0, 1, "L");

$pdf->setY(88);
$pdf->setX(13);
$pdf->cell(90, 5, "Vaskemaskin", 0, 0, "L");
$pdf->cell(90, 5, "2000kr", 0, 1, "R");

$pdf->setY(187);
$pdf->cell(105, 5, "2000kr", 0, 1, "R");
$pdf->output("out.pdf", "I");
?>

<?="<h1>$task_name</h1>"?>


<?php generate_footer();?>
<?php endif;?>
