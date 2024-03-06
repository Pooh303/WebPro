<?php
$servername = "10.30.9.139";
$port = 3306;
$username = "root";
$password = "root";
$database = "shabu";

$conn = mysqli_connect($servername, $username, $password, $database, $port);

$sqlData = "SELECT * FROM `tables` WHERE Table_ID = 4;";
$resultData = mysqli_query($conn, $sqlData);

//$table_id = $_GET['table_id'];

while ($row = mysqli_fetch_assoc($resultData)) {
    $json_session_id = $row["session_id"];
    $data_session_id = json_decode($json_session_id, true);

    $json_Table_ID = $row["Table_ID"];
    // $data_Table_ID = json_decode($json_Table_ID, true);
//echo "$json_Table_ID";
}


require "vendor/autoload.php";

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Logo\Logo;

$text = "http://10.30.9.139:8081/Project/MenuOrder_copy/index.php?json_Table_ID=" . $json_Table_ID . "&json_session_id=" . $json_session_id;

echo "$text";
// $qrCode = new QrCode($text);

// $writer = new PngWriter();

// $result = $writer->write($qrCode);

// header('Content-Type: ' . $result->getMimeType());

// echo $result->getString();

?>