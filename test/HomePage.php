<?php
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: thanks.php');
    }
    else {

        $servername = "10.30.9.139";
        $port = 3306;
        $username = "root";
        $password = "root";
        $database = "shabu";

        $conn = mysqli_connect($servername, $username, $password, $database, $port);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT table_status FROM tables WHERE Table_ID = 2";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        if ($row['table_status'] == 0) {
            header('Location: thanks.php');
        }
        // $now = time();

        // if ($now > $_SESSION['expire']) {
        //     session_destroy();
        // }
        else {
?>
            <html>
                Welcome
                <?php
                    header('Location: http://10.30.9.139:8081/Project/MenuOrder/?'. $_SESSION['user']);
                    echo $_SESSION['user'];
                    echo "<a href='thanks.php'>Log out</a>";
                ?>
            </html>
<?php
        }
    }
?>
