<?php
// รับข้อมูลจาก AJAX ที่ถูกส่งมา
$data = json_decode(file_get_contents("php://input"), true);

// เช็คว่ามีข้อมูลที่ถูกส่งมาหรือไม่
if(isset($data['table_id']) && isset($data['order_data'])) {
    $servername = "10.30.9.139";
    $port = 3306;
    $username = "root";
    $password = "root";
    $database = "shabu";

    $conn = mysqli_connect($servername, $username, $password, $database, $port);

    if (!$conn) {
        echo "Error: Unable to connect to database.";
        exit();
    }

    $table_id = $data['table_id'];
    $order_data = $data['order_data'];

    $cmd = "INSERT INTO `Order`(`Table_ID`, `Data`, `Order_Status`) VALUES ('$table_id', '$order_data', 'Empty');";

    if (mysqli_query($conn, $cmd)){
        echo "Success";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    // ถ้าไม่มีข้อมูลถูกส่งมา
    echo "ไม่มีข้อมูลที่ถูกส่งมา";
}
?>
