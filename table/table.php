<!-- table.php -->
<?php
$servername = "10.30.9.139";
$port = 3306;
$username = "root";
$password = "root";
$database = "shabu";

$connect = mysqli_connect($servername, $username, $password, $database, $port) or die(mysqli_error($connect));

session_start();

if (isset($_POST['reserve_table'])) {
    $table_id = $_POST['table_id'];

    $check_query = "SELECT * FROM tables WHERE Table_ID = '$table_id'";
    $check_result = mysqli_query($connect, $check_query) or die(mysqli_error($connect));
    $table_info = mysqli_fetch_assoc($check_result);

    if ($table_info['table_status'] == "full") {
       
        echo '<script>alert("ลบสถานะและ Bill_ID เรียบร้อยแล้ว")</script>';

        $_SESSION['table_id'] = $table_id;

        header("Location: payment.php");
        exit();
    } else {
        echo '<script>alert("โต๊ะนี้ว่างอยู่ กรุณาเลือกโต๊ะอื่น")</script>';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>เลือกโต๊ะ</title>
    <link rel="icon" type="image/x-icon" href="../src/cells.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
        input{
            caret-color: black !important;
        }
        .btn{
            font-size: 1.2rem;
            border-radius: 12px;
        }
        #status{
            font-size: 1.1rem;
            padding: 5px 15px;
            border-radius: 30px;
        }
        h1{
            font-size: 2.5rem;
            font-weight: bold;
            border-radius: 12px;
            text-align: center;
        }
        th{
            font-size: 1.2rem;
            font-weight: bold;
            text-align: center;
        }
        .title p{
            font-size: 1.2rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>รายการโต๊ะ</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>หมายเลขโต๊ะ</th>
                    <th>จำนวนที่นั่ง</th>
                    <th>สถานะ</th>
                    <th>จัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM tables";
                $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td class='title'>" . "<p>". $row['Table_ID'] ."</p>" . "</td>";
                    echo "<td class='title'>" . "<p>". $row['table_seat'] ."</p>" . "</td>";
                    echo "<td class='title'>" ."<p>" ."<button id='status' class='btn " . ($row['table_status'] == "full" ? "btn-danger'> เต็ม" : "btn-success'> ว่าง") . "</button>" ."</p>" . "</td>";
                    if ($row['table_status'] == "full") {
                        echo "<td>
                                <form method='POST'>
                                    <input type='hidden' name='table_id' value='" . $row['Table_ID'] . "'>
                                    <button type='submit' name='reserve_table' class='btn btn-danger'>ลบสถานะ</button>
                                </form>
                              </td>";
                    } else {
                        echo "<td>
                                <form><button type='button' class='btn btn-primary reserve-btn' data-toggle='modal' data-target='#reserveModal' data-table-id='" . $row['Table_ID'] . "'>จอง</button></form>
                              </td>";
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="reserveModal" tabindex="-1" role="dialog" aria-labelledby="reserveModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reserveModalLabel">จองโต๊ะ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="reserve.php">
                        <div class="form-group">
                            <label for="guests">จำนวนลูกค้า:</label>
                            <input type="number" class="form-control" id="guests" name="guests" required>
                        </div>
                        <input type="hidden" name="table_id" id="table_id">
                        <button type="submit" class="btn btn-primary" name="confirm_reservation">ยืนยันการจอง</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.reserve-btn').click(function(e){
                e.preventDefault();
                var tableId = $(this).data('table-id');
                $('#table_id').val(tableId);
            });
        });
    </script>
</body>
</html>
