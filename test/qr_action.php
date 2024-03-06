<?php
    session_start();
    // $_SESSION['id'] = $_GET['table_id'];
    $_SESSION['user'] = session_id();
    // $_SESSION['start'] = time();
    // $_SESSION['expire'] = $_SESSION['start'] + (3);
    // header('Location: homepage.php');
    
    $servername = "10.30.9.139";
    $port = 3306;
    $username = "root";
    $password = "root";
    $database = "shabu";

    $conn = mysqli_connect($servername, $username, $password, $database, $port);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "UPDATE tables SET session_id = '".$_SESSION['user']."' WHERE Table_ID = 1";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        echo "Error updating record: " . mysqli_error($conn);
    }
?>
