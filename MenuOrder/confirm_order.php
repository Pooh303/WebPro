<?php
    // รับข้อมูลจาก AJAX ที่ถูกส่งมา
    $data = json_decode(file_get_contents("php://input"), true);

// เช็คว่ามีข้อมูลที่ถูกส่งมาหรือไม่
if(isset($data)) {
    $servername = "10.30.9.139";
    $port = 3306;
    $username = "root";
    $password = "root";
    $database = "shabu";

    $conn = mysqli_connect($servername,  $username, $password, $database, $port);

    if (!$conn) {
        echo "Error: Unable to connect to database.";
        exit();
    }

    
    $requestData = json_decode(file_get_contents("php://input"), true);
    $table = $requestData['tableNumber'];
    $data = $requestData['orderData'];
    $cmd = "INSERT INTO `Order`(`Table_ID`, `Data`, `Order_Status`) VALUES ('$table', '$data', 'Empty');";
    
    if (mysqli_query($conn, $cmd)){
        echo "Success";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    // echo "Confirm Order สำเร็จมั้ง";
    $conn = mysqli_connect($servername, $username, $password, $database, $port);
    $data = json_decode($data, true);
    foreach ($data as $item) {
        $name = $item['name'];
        $amount = $item['amount'];

        $sql = "INSERT INTO `menuhis` (`menuName`, `amount`) VALUES ('$name', '$amount');";
        if (mysqli_query($conn, $sql)) {
            // echo "Record added successfully<br>";
        } else {
            echo "Error adding record: " . mysqli_error($conn) . "<br>";
        }
    }
} else {
    // ถ้าไม่มีข้อมูลถูกส่งมา
    echo "ไม่มีข้อมูลที่ถูกส่งมา";
}
mysqli_close($conn);
?>
