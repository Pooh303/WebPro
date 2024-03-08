<?php
$servername = "10.30.9.139";
$port = 3306;
$username = "root";
$password = "root";
$database = "shabu";

$table_id = isset($_GET['tableID']) ? $_GET['tableID'] : null;

$conn = mysqli_connect($servername, $username, $password, $database, $port);

$sqlData = "SELECT * FROM `tables` WHERE Table_ID = $table_id;";
$resultData = mysqli_query($conn, $sqlData);

$randomString =generateRandomString();
//echo "$randomString";
$sqldatasessionupdate = "UPDATE tables SET session_id = '" . $randomString . "' WHERE Table_ID = $table_id;";
mysqli_query($conn, $sqldatasessionupdate);



while ($row = mysqli_fetch_assoc($resultData)) {
    $session_id = $row["session_id"];
    $data_session_id = json_decode($session_id, true);

    $Table_ID = $row["Table_ID"];
    // $data_Table_ID = json_decode($Table_ID, true);
//echo "$Table_ID";
}


require "QRcode/vendor/autoload.php";

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Logo\Logo;

$text = "http://10.30.9.139:8081/Project/MenuOrder/index.php?json_Table_ID=" . $Table_ID . "&json_session_id=" . $randomString;


$qrCode = new QrCode($text);

$writer = new PngWriter();

$result = $writer->write($qrCode);

header('Content-Type: ' . $result->getMimeType());

echo $result->getString();

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}



?>
 