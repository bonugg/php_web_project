<?php
    $type = $_GET["type"];

    include "../include/board_setup.php";
    include "../include/header.php";
    include $type.".php";
?>