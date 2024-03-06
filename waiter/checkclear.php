<?php
    $servername = "10.30.9.139";
    $port = 3306;
    $username = "root";
    $password = "root";
    $database = "shabu";

    $conn = mysqli_connect($servername, $username, $password, $database, $port);

    $data_table_ID_array = json_decode($_GET['data_table_ID'], true);


    $new = "UPDATE `tables` SET `cleaner` = 0 WHERE `Table_ID` = $data_table_ID_array";

    mysqli_query($conn, $new);
    
    header("Location: cleaner.php");
    exit();
    ?>