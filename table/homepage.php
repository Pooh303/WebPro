<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: thanks.php');
    exit(); // Always exit after redirecting
} else {
    $servername = "10.30.9.139";
    $port = 3306;
    $username = "root";
    $password = "root";
    $database = "shabu";

    $conn = mysqli_connect($servername, $username, $password, $database, $port);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prevent SQL injection using prepared statements
    $sql = "SELECT table_status FROM tables WHERE Table_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_SESSION['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['table_status'] == NULL) {
            header('Location: thanks.php');
            exit(); // Always exit after redirecting
        } else {
            // Second query to get session_id
            $sql = "SELECT session_id FROM tables WHERE Table_ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $_SESSION['id']);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if ($_SESSION['user'] == $row['session_id']) {
                    // Redirect using proper URL encoding
                    $redirect_url = 'http://10.30.9.139:8081/Project/MenuOrder/?' . urlencode($_SESSION['user']);
                    header('Location: ' . $redirect_url);
                    exit(); // Always exit after redirecting
                }
            }
        }
    }
}
?>
