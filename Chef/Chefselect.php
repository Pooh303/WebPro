<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../src/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../src/chef.png">
	<script src="../src/bootstrap/js/bootstrap.min.js"></script>
    <title>พ่อครัว</title>
    <style>
    @font-face {
	font-family: "Noto Sans Thai";
	src: url('../src/font/NotoSansThai.ttf');
	font-weight: 480;
	font-style: normal;
}
* {
    cursor: pointer;
    caret-color: transparent;
    font-family: "Noto Sans Thai", sans-serif;
}
    .container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); /* ระบุขนาดของ column ให้เป็น auto-fill และ minmax เพื่อให้คอลัมน์ปรับขนาดตามหน้าจอ */
    gap: 20px; /* เพิ่มช่องว่างระหว่างการ์ด */
    justify-content: center; /* จัดการ์ดให้อยู่ตรงกลาง */
    align-items: center; /* จัดการ์ดให้อยู่ตรงกลาง */
}

.card {
    border: 1px solid #ccc;
    border-radius: 10px;
    padding: 20px;
    margin : 25px 0 0 0;
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 300px; /* ปรับขนาดของการ์ดตามต้องการ */
    transition: transform 0.3s ease;
}


.card:hover {
    transform: translateY(-5px); /* เพิ่มการเคลื่อนไหวเมื่อ hover */
}
.head{
    text-align: center;
        padding: 20px;
    background-color : rgba(8, 120, 255, 0.8);
        color: white;
}
    </style>
</head>

<body>
<h1 class="head" >รายการอาหารที่ต้องทำ</h1>
<div class="container">
    <?php
    $servername = "10.30.9.139";
    $port = 3306;
    $username = "root";
    $password = "root";
    $database = "shabu";

    $conn = mysqli_connect($servername, $username, $password, $database, $port);

    $sqlData = "SELECT * FROM `Order` ;";
    $resultData = mysqli_query($conn, $sqlData);

    if ($resultData && mysqli_num_rows($resultData) > 0) {
        while ($row = mysqli_fetch_assoc($resultData)) {
            $json_data = $row["Data"];
            $data_array = json_decode($json_data, true);

            $json_Order_ID = $row["Order_ID"];
            $Order_ID_array = json_decode($json_Order_ID, true);
            

            if ($row['Order_Status'] !== "Finish" && $row['Order_Status'] !== "Serve") {
                echo "<div class='card'>";
                echo "<h3>ออเดอร์ $Order_ID_array</h3>";
    
                if ($row['Order_Status'] !== "Doing" ) {   echo "<button class=\"btn btn-outline-danger\" onclick=\"window.location.href='Doing.php?data=" . urlencode(json_encode($data_array)) . 
                    "&data_order_ID=" . urlencode(json_encode($Order_ID_array)) . "'\">ยังไม่มีคนทำ</button><br>";
                } else {
                    echo "<button class=\"btn btn-warning\" disabled>กำลังทำ</button><br>";
                }
                echo "</div>";
            }
        }
    } else {
        echo "No results found.";
    }
    
    mysqli_close($conn);

    

    ?>
 </div>
</body>

</html>







