<?php
    session_start();
    $_SESSION['id'] = $_POST['table_id'];
    $user_id = session_id();
    // $_SESSION['start'] = time();
    // $_SESSION['expire'] = $_SESSION['start'] + (3);
    
    $servername = "10.30.9.139";
    $port = 3306;
    $username = "root";
    $password = "root";
    $database = "shabu";
    
    $conn = mysqli_connect($servername, $username, $password, $database, $port);
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "UPDATE tables SET session_id = ? WHERE Table_ID = $_SESSION['id']";
    $result = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($result, "s", $user_id);
    mysqli_stmt_execute($result);

    if (!$result) {
        echo "Error updating record: " . mysqli_error($conn);
    } else {
        header('Location: homepage.php');
        exit();
    }
?>
