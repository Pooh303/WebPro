<?php
$servername = "10.30.9.139";
$port = 3306;
$username = "root";
$password = "root";
$database = "shabu";

$conn = mysqli_connect($servername, $username, $password, $database, $port);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Edit action
if(isset($_POST['edit_submit'])){
    $editMenuId = $_POST['edit_menuId'];
    $editMenuName = $_POST['edit_menuName'];
    $editMenuDescription = $_POST['edit_menuDescription'];

    $sql = "UPDATE Menu SET Menu_Name='$editMenuName', Menu_Description='$editMenuDescription' WHERE Menu_ID='$editMenuId'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: menu.php");
        exit();
    } else {
        header("Location: menu.php");
        exit();
    }
}

// Delete action
if(isset($_POST['delete_submit'])){
    $deleteMenuId = $_POST['delete_menuId'];

    $sql = "DELETE FROM Menu WHERE Menu_ID='$deleteMenuId'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: menu.php");
        exit();
    } else {
        header("Location: menu.php");
        exit();
    }
}
?>
