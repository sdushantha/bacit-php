<?php
// The reason why we store the task name in a variable instead of directly
// using it in the HTML code is because this file gets inlcuded by index.php,
// which then access $task_name so that it can add it to it's list
$task_name = "Oppgave 4: visning av jobbannonser eller veiledningsbookinger";

// In index.php we import this file so that we can access $task_name.
// Without the if-statement below, the HTML code will displayed in index.php.
// __FILE__ and $_SERVER['SCRIPT_FILENAME'] explaination: https://stackoverflow.com/a/29697427/9215267
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])):

// index.php is included as we use the generate_footer() function from it
include "index.php";
?>

<?="<h1>$task_name</h1>"?>
    
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>

<table>
   <tr><th>Overskrift</th><th>Beskrivelse</th><th>Frist</th><th>Sted</th></tr>
   <?php
      $jobs = [
          [
              "overskrift" => "Utivkler",
              "beskrivelse" => "Noen som kan utvikle",
              "frist" => "11.11.2023",
              "sted" => "Oslo"
          ],
          [
              "overskrift" => "UX Deisgner",
              "beskrivelse" => "Noen som kan jobbe med UX for appen",
              "frist" => "23.11.2023",
              "sted" => "Stavanger"
          ],
          [
              "overskrift" => "UI Designer",
              "beskrivelse" => "Noen som kan jobbe med UI for appen",
              "frist" => "14.11.2023",
              "sted" => "Bergen"
          ]
          ];
      
      foreach ($jobs as $job) {
          echo "<tr>";
          foreach ($job as $info) {
              echo "<td>$info</td>";
          }
          echo "</tr>";
      }
      ?>
</table>
<br>


<?php generate_footer();?>
<?php endif;?>
