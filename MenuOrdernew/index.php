<?php
$servername = "10.30.9.139";
$port = 3306;
$username = "root";
$password = "root";
$database = "shabu";

// Establish connection
$conn = mysqli_connect($servername, $username, $password, $database, $port);


$sqlData = "SELECT * FROM `tables` WHERE Table_ID = 4;";
$resultData = mysqli_query($conn, $sqlData);
// Check connection
while ($row = mysqli_fetch_assoc($resultData)) {
    $json_session_id = $row["session_id"];
    //$data_session_id = json_decode($json_session_id, true);

    $json_Table_ID = $row["Table_ID"];
    // $data_Table_ID = json_decode($json_Table_ID, true);
//echo "$json_Table_ID";
}

// Retrieve parameters from URL
$table_id = isset($_GET['json_Table_ID']) ? $_GET['json_Table_ID'] : null;
$session_id = isset($_GET['json_session_id']) ? $_GET['json_session_id'] : null;

// Validate parameters
if ($table_id !== null && $session_id !== null) {
    if ($table_id == "$json_Table_ID" &&  $session_id == "$json_session_id") {
        // Redirect to Chefselect.php
        header("Location: http://10.30.9.139:8081/Project/MenuOrder_copy/index.php");
        exit(); // Ensure that script stops executing after the redirect
    } else {
        // Redirect to Finish.php
        header("Location: http://10.30.9.139:8081/Project/Chef/gg.php");
        exit(); // Ensure that script stops executing after the redirect
    }
} else {
    // Handle case where parameters are not provided
    echo "Invalid parameters";
}
?>
