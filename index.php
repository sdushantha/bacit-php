<h1>Innleveringer</h1>

<?php
$pattern = '';
$modules = glob("module-[0-9]*", GLOB_ONLYDIR);
foreach ($modules as $module) {
    echo "<li><a href='$module/solution'>$module</a></li>";
}
?>