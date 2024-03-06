<?php

$table_id = $_GET['table_id'];

require "vendor/autoload.php";

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Logo\Logo;

$text = "http://10.30.9.139:8081/Project/MenuOrder?table_id=1";

$qrCode = new QrCode($text);

$writer = new PngWriter();

$result = $writer->write($qrCode);

header('Content-Type: ' . $result->getMimeType());

echo $result->getString();

