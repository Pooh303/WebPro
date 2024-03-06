<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../src/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../src/chef.png">
    <script src="../src/bootstrap/js/bootstrap.min.js"></script>
    <title>page2</title>
    <style>
        @font-face {
            font-family: "Noto Sans Thai";
            src: url('../src/font/NotoSansThai.ttf');
            font-weight: 480;
            font-style: normal;
        }

        * {
            font-family: "Noto Sans Thai", sans-serif;
            font-size: large;
        }

        .cardbig {
    border: 1px solid #ccc;
    border-radius: 10px;
    padding: 10px; /* Adjust padding as needed */
    margin: 0 auto; /* Center the card using auto margins */
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 80%; /* Set the width as needed */
    max-width: 600px; /* Limit the maximum width if necessary */
    /* Add any additional styles or adjustments here */
    transition: transform 0.
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
    <?php
    $servername = "10.30.9.139";
    $port = 3306;
    $username = "root";
    $password = "root";
    $database = "shabu";

    $conn = mysqli_connect($servername, $username, $password, $database, $port);

    $sqlData = "SELECT * FROM `Order`;";
    $resultData = mysqli_query($conn, $sqlData);

    $data_order_ID_array = json_decode($_GET['data_order_ID'], true);

    $data_array = json_decode($_GET['data'], true);

    $sql = "UPDATE `Order` SET Order_Status = 'Doing' WHERE $data_order_ID_array = `Order_ID`";
    mysqli_query($conn, $sql);


    echo "<h1 class=\"head\" style=\"text-align: center;\">กำลังทำ ของ โต๊ะ $data_order_ID_array</h1>";





    echo "<div class='cardbig'>";

    if (is_array($data_array)) {
        echo "<table class=\"table\">
            <thead>
                <tr>
                    <th  scope=\"col\">เมนู</th>
                    <th  scope=\"col\">จำนวน</th>
                </tr>
            </thead>
            <tbody>";
    
        foreach ($data_array as $item) {
            $id = isset($item['id']) ? $item['id'] : 'N/A';
            $name = isset($item['name']) ? $item['name'] : 'N/A';
            $amount = isset($item['amount']) ? $item['amount'] : 'N/A';
    
            echo "<tr>
                    <td>$name</td>
                    <td >$amount</td>
                </tr>";
        }
    
        echo "</tbody>
        </table>";
    }
    

        
    else {
        echo "Failed to decode JSON data.";
    }

    echo "<div style='text-align: center;'><a href='Finish.php?data=" . urlencode(json_encode($data_array)) . "&data_order_ID=" . urlencode(json_encode($data_order_ID_array)) . "'><button class=\"btn btn-outline-success\">ทำอาหารเสร็จแล้ว</button></a></div><br>";


    echo "</div>";


    mysqli_close($conn);
    ?>
    <p class="namemenu"></p>
</body>

</html>