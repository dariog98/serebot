<?php
    header("Content-Type: application/json");
    $CommandsFile = file_get_contents('../data/commands.json', true);
    echo $CommandsFile;
?>