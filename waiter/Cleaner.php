<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../src/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../src/waiter.png">
	<script src="../src/bootstrap/js/bootstrap.min.js"></script>
    <title>ทำความสะอาดโต๊ะ</title>
    <style>
    @font-face {
	font-family: "Noto Sans Thai";
	src: url('../src/font/NotoSansThai.ttf');
	font-weight: 480;
	font-style: normal;
    }.card {
    border: 1px solid #ccc;
    border-radius: 10px;
    padding: 20px;
    margin : 25px 0 0 0;
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 300px; /* ปรับขนาดของการ์ดตามต้องการ */
    transition: transform 0.3s ease;
}* {
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

    </style>
<head>
</head>
<body>
<nav style="color: white;">
<a href="waiter.php">เลือกโต๊ะเสริฟ</a>
<a href="#">โต๊ะว่าง</a>
</nav>
<div class="container">
<?php
    $servername = "10.30.9.139";
    $port = 3306;
    $username = "root";
    $password = "root";
    $database = "shabu";

    $conn = mysqli_connect($servername, $username, $password, $database, $port);

    $sqlData = "SELECT * FROM `tables`;";
    $resultData = mysqli_query($conn, $sqlData);

   
    
    if ($resultData && mysqli_num_rows($resultData) > 0) {
        
        while ($row = mysqli_fetch_assoc($resultData)) {
            $json_cleaner = $row["cleaner"];
            $data_cleaner = json_decode($json_cleaner, true);
    
            $json_Table_ID = $row["Table_ID"];
            $data_Table_ID = json_decode($json_Table_ID, true);
            
            
            if ($row['cleaner'] == 1 ) {
                echo "<div class='card'>";
                echo "<h3>โต๊ะ $data_Table_ID</h3>";
                echo "<button class=\"btn btn-outline-danger\" onclick=\"confirmAction()\">ทำความสะอาดโต๊ะแล้ว</button><br>";
                    echo "</div>";
                }
        
    }
}   
    mysqli_close($conn);
    


   
?>
  </div>      
</div>
<script>
function confirmAction() {
    if (confirm("ทำความสะอาดโต๊ะเสร็จแล้ว")) {
        window.location.href = 'checkclear.php?data=<?php echo urlencode(json_encode($data_Table_ID)); ?>&data_table_ID=<?php echo urlencode(json_encode($data_Table_ID)); ?>';
    }
}
</script>

</body>
</html>