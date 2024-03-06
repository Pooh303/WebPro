<?php
    $servername = "10.30.9.139";
    $port = 3306;
    $username = "root";
    $password = "root";
    $database = "shabu";

    $conn = mysqli_connect($servername, $username, $password, $database, $port);

    $data_order_ID_array = json_decode($_GET['data_order_ID'], true);

    $new = "UPDATE `Order` SET `Order_Status` = 'Finish' WHERE `Order_ID` = $data_order_ID_array";

    mysqli_query($conn, $new);
    
    header("Location: Chefselect.php");
    exit();
    ?>