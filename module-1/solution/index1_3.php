<?php
// The reason why we store the task name in a variable instead of directly
// using it in the HTML code is because this file gets inlcuded by index.php,
// which then access $task_name so that it can add it to it's list
$task_name = "Oppgave 3: alderen til en person";

// In index.php we import this file so that we can access $task_name.
// Without the if-statement below, the HTML code will displayed in index.php.
// __FILE__ and $_SERVER['SCRIPT_FILENAME'] explaination: https://stackoverflow.com/a/29697427/9215267
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])):
?>

<?="<h1>$task_name</h1>"?>

<?php
$navn = "Bob";
$alder = 42;
?>

<style>
 table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>

<!-- Table -->
 <table>
  <tr>
    <th>Name</th>
    <th>Age</th>
  </tr>
  <tr>
    <td><?=$navn?></td>
    <td><?=$alder?></td>
  </tr>
</table> 

<br>

<!-- Numbered list -->
 <ol>
  <li><?=$navn?></li>
  <li><?=$alder?></li>
</ol> 

<br>

<!-- Bullet point list -->
<ul>
  <li><?=$navn?></li>
  <li><?=$alder?></li>
</ul> 

<br>

<!-- Paragraph -->
<p>Hei, jeg heter <?=$navn?> og jeg er <?=$alder?> år gammel</p>

<?php endif;?>