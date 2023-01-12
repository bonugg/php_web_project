<?php 
    $con = mysqli_connect("210.223.77.117", "doowon", "1234", "final_test");

    mysqli_query($con, "set session character_set_connection=utf8;");
    mysqli_query($con, "set session character_set_results=utf8;");
    mysqli_query($con, "set session character_set_client=utf8;");
?>