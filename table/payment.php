<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ตาราง</title>
  <link rel="icon" type="image/x-icon" href="../src/cells.png">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    @font-face {
      font-family: "Noto Sans Thai";
      src: url('../src/font/NotoSansThai.ttf');
      font-style: normal;
    }
    *{
      margin: 0;
      padding: 10px;
      border: none;
      outline: none;
      box-sizing: border-box;
      caret-color: transparent;
      font-family: "Noto Sans Thai", sans-serif;
    }
    .contain{
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      white-space: nowrap;
    }
    h1{
      font-size: 3rem;
      font-weight: bold;
      margin: 10px 0;
    }
    .contain p{
      font-size: 2.5rem;
      font-weight: bold;
      margin: 2px 0;
    }
    .btn{
      font-size: 1.5rem;
      padding: 5px 15px;
      margin: 10px 5px;
      border-radius: 15px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 mt-5 contain">
        <?php
        session_start();

        $servername = "10.30.9.139";
        $port = 3306;
        $username = "root";
        $password = "root";
        $database = "shabu";

        $conn = mysqli_connect($servername, $username, $password, $database, $port);

        if(isset($_SESSION['table_id'])) {
            $table_id = $_SESSION['table_id'];
            echo '<h1>QR Code สำหรับชำระเงิน</h1>';

            $sqlData = "SELECT Price FROM `bill` WHERE Table_ID = '$table_id'";
            $resultData = mysqli_query($conn, $sqlData);

            $row = mysqli_fetch_assoc($resultData);

            $json_Order_ID = $row["Price"];
            $Order_ID_array = json_decode($json_Order_ID, true);

            echo '<img src="http://promptpay.io/0931012808/'.$Order_ID_array.'.png" alt="QR Code for Payment" class="img-fluid">';
            echo "<p>$Order_ID_array บาท</p>";

            echo '<form method="POST">';
            echo '<input type="hidden" name="table_id" value="'.$table_id.'">';
            echo '<button type="submit" name="cancel_bill" class="btn btn-secondary mt-3"><i class="fa-solid fa-xmark"></i>ยกเลิก</button>';
            echo '<button type="submit" name="delete_bill" class="btn btn-danger mt-3"><i class="fa-solid fa-trash"></i>ลบข้อมูล</button>';
            echo '</form>';

            if(isset($_POST['delete_bill'])) {
                $table_id = $_POST['table_id'];

                $delete_bill_query = "DELETE FROM bill WHERE Table_ID = '$table_id'";
                mysqli_query($conn, $delete_bill_query) or die(mysqli_error($conn));

                $delete_session_query = "UPDATE tables SET session_id = NULL WHERE Table_ID = '$table_id'";
                mysqli_query($conn, $delete_session_query) or die(mysqli_error($conn));

                header("Location: table.php");
                exit();

            } else if(isset($_POST['cancel_bill'])) {
                $table_id = $_POST['table_id'];
                header("Location: table.php");
                exit();
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">ไม่พบข้อมูลโต๊ะที่ต้องการ</div>';
            echo '<a href="table.php" class="btn btn-primary">กลับสู่หน้าตาราง</a>';
        }
        ?>
      </div>
    </div>
  </div>
</body>
</html>
