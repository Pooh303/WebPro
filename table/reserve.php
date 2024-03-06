<?php
session_start();

$servername = "10.30.9.139";
$port = 3306;
$username = "root";
$password = "root";
$database = "shabu";

$connect = mysqli_connect($servername, $username, $password, $database, $port) or die(mysqli_error($connect));

if (isset($_POST['confirm_reservation'])) {
    $table_id = $_POST['table_id'];
    $guests = $_POST['guests'];
    $price_per_person = 399;
    $price = $guests * $price_per_person;

    try {
        $bill_query = "SELECT MAX(Bill_ID) AS max_bill_id FROM bill";
        $bill_result = mysqli_query($connect, $bill_query);
        $bill_row = mysqli_fetch_assoc($bill_result);
        $current_bill_id = $bill_row['max_bill_id'];
        $new_bill_id = $current_bill_id + 1;

        $update_table_query = "UPDATE tables SET table_status = 'full', Bill_ID = $new_bill_id WHERE Table_ID = '$table_id'";
        mysqli_query($connect, $update_table_query);

        $insert_bill_query = "INSERT INTO bill (Table_ID, Bill_ID, Price, Number_of_Customer) VALUES ('$table_id', $new_bill_id, $price, $guests)";
        mysqli_query($connect, $insert_bill_query);

        header("Location: table.php");
        exit();
    } catch (Exception $e) {
        echo "An error occurred: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>จองโต๊ะ</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        @font-face {
            font-family: "Noto Sans Thai";
            src: url('../src/font/NotoSansThai.ttf');
            font-style: normal;
        }

        *{
            margin: 10px 0 0 0;
            padding: 0;
            border: none;
            outline: none;
            box-sizing: border-box;
            caret-color: transparent;
            font-family: "Noto Sans Thai", sans-serif;
        }

        input{
            margin: 10px 0 0 0;
            padding: 10px;
            width: 20% !important;
            border: 1px solid #ccc;
            border-radius: 10px !important;
            outline: none;
            box-sizing: border-box;
            caret-color: black;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>จองโต๊ะ</h2>
        <form method="POST">
            <div class="form-group">
                <label for="guests">จำนวนลูกค้า:</label>
                <input type="number" class="form-control" id="guests" name="guests" required>
            </div>
            <!-- Adding a hidden input field to pass the table_id -->
            <input type="hidden" name="table_id" value="<?php echo $_SESSION['table_id']; ?>">
            <button type="submit" class="btn btn-primary" name="confirm_reservation">ยืนยันการจอง</button>
        </form>
    </div>
</body>
</html>
