<!DOCTYPE html>
<html lang="en">
<?php
$servername = "10.30.9.139";
$port = 3306;
$username = "root";
$password = "root";
$database = "shabu";

session_start();
$_SESSION['count'] = 0;
if (isset($_SESSION['count'])) {
    $_SESSION['count'] = $_SESSION['count'] + 1;
} else {
    $_SESSION['count'] = 1;
}

// Save session data to a file
file_put_contents('session_data.txt', serialize($_SESSION));





// Establish connection
$conn = mysqli_connect($servername, $username, $password, $database, $port);

// Retrieve parameters from URL
$table_id = isset($_GET['json_Table_ID']) ? $_GET['json_Table_ID'] : null;
$session_id = isset($_GET['json_session_id']) ? $_GET['json_session_id'] : null;

$sqlData = "SELECT * FROM `tables` WHERE Table_ID = $table_id;";
$resultData = mysqli_query($conn, $sqlData);
// Check connection
while ($row = mysqli_fetch_assoc($resultData)) {
    $json_session_id = $row["session_id"];
    //$data_session_id = json_decode($json_session_id, true);

    $json_Table_ID = $row["Table_ID"];
    // $data_Table_ID = json_decode($json_Table_ID, true);
//echo "$json_Table_ID";
}



// Validate parameters
if ($table_id !== null && $session_id !== null) {
    if ($table_id == "$json_Table_ID" &&  $session_id == "$json_session_id") {
        // Redirect to Chefselect.php
        
    } else {
        // Redirect to Finish.php
        header("Location: thanks.php");
        
        exit(); // Ensure that script stops executing after the redirect
    }
} else {
    // Handle case where parameters are not provided
    header("Location: thanks.php");
        exit();echo "Invalid parameters";
}
?>

<style>
    @font-face {
        font-family: "Noto Sans Thai";
        src: url('../src/font/NotoSansThai.ttf');
        font-style: normal;
    }

    *{
        margin: 0;
        padding: 0;
        border: none;
        outline: none;
        box-sizing: border-box;
        caret-color: transparent;
        font-family: "Noto Sans Thai", sans-serif;
    }

    .header{
        text-align: center;
        padding: 20px;
        background-color: #D70040;
        color: white;
    }

    .form-popup {
        display: none;
        position: fixed;
        top: 0;
        right: 0;
        width: 25%;
        height: 100%;
        z-index: 9;
        background-color: rgb(250, 250, 250, 1);
    }

    .form-popup .close-button {
        position: absolute;
        top: 10px;
        right: 10px;
        cursor: pointer;
        font-size: 20px;
        font-weight: bold;
    }

    /* body.menu-selected {
        background-color: rgba(0, 0, 0, 0.3);
    } */

    @media only screen and (max-width: 767px) {
        .form-popup {
            width: 100%; /* ให้ .form-popup เต็มจอในกรณีมือถือ */
        }
    }

    .menubox-2-border{
        border-bottom: 1px solid black;
        /* margin-top: 5px;
        margin-bottom: 10px; */
        margin: 40px;
    }

    .menubox-2 {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .menubox-2 img {
        order: 1;
    }

    .menubox-3{
        order: 2;
        margin-left: 10px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .menubox-3 p {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .button {
        cursor: pointer;
        background-color: #D70040;
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 20px;
        box-sizing: border-box;
        margin: 0;
        font-size: 18px;
        color: white;
    }

    image {
        cursor: pointer;
    }

    .basket {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 5);
        z-index: 10;
        background-color: white;
    }

    .basket .close-button {
        position: absolute;
        top: 10px;
        right: 10px;
        cursor: pointer;
        font-size: 20px;
        font-weight: bold;
    }

    .cart-item {
        z-index: 0;
        border-bottom: 1px solid black;
        margin-top: 5px;
        margin-left: 10px;
        margin-bottom: 10px;
        margin-right: 10px;
    }

    #basketLabel{
        z-index: -1;
    }

    .basketbutton{
        display: none;
    }

    .menulist{
        margin-bottom: 70px;
    }

    /* .bttn2{
        background-color: transparent;
        border: none;
        margin: 10px;
    } */
    .menubox-2 img{
        border-radius: 50%;
    }
    .empty-basket{
        text-align: center;
        margin-top: 20%;
    }
    .close-button{
        cursor: pointer;
        font-size: 30px !important;
    }
    .fa-minus, .fa-plus{
        width: 40px;
        height: 40px;
        cursor: pointer;
        font-size: 20px;
        padding: 10px;
        color: white;
        background-color: rgb(220, 53, 69);
        border-radius: 50%;
        margin: 20px 10px 10px 10px;
    }
    #amount{
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        margin: 20px 2px;
    }
    label{
        font-size: 20px;
        font-style: bold;
        font-weight: 700;
    }

    .menubox-3 p{
        font-size: 15px;
        color: #6c757d;
        margin-top: 4px;
    }

    #overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 1);
    z-index: 9999;

    justify-content: center;
    align-items: center;
}

#overlay-text {
    position: absolute;
    top: 40%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: black;
    white-space: nowrap;
    font-size: 24px;
}
.basket{
    overflow: auto;
}
#basketLabel{
    margin-bottom: 80px;
}

</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../src/menu.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="../src/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<script src="../src/bootstrap/js/bootstrap.min.js"></script>
    <title>เมนู</title>
</head>
<body>
    <div class="header">
    <nav style="color: white;">
    <h1>รายการอาหาร<h1>
    <?php
    echo "<a href='Order_history.php?json_Table_ID=" . $table_id . "&json_session_id=" . $session_id . "'>";
?>ประวัติการสั่งซื้อ</a>
</h1>
</h1>
</nav>

    </div>
    <?php
        echo"<div id=\"table_id\" value=\"$table_id\"></div>";
    ?>
    <div class="cart" id="butt">
        <button class="button" onclick="showBasket()"><i class="fa-solid fa-cart-shopping"></i> ตะกร้าสินค้า</button>
    </div>

    <div class="basket" id="basketform">
        <i onclick="closeBasketForm()" class="fa-solid fa-xmark close-button"></i>
        <div id="basketLabel"></div>
        <div class="basketbutton" id="basketbutton">
            <button class="button" onclick="confirm(<?php echo $table_id; ?>)" name="confirm" id="confirm">ยืนยัน</button>
        </div>
    </div>

    <div class="form-popup" id="myForm">
        <div style="margin: 5%;">
            <h1 id="menu-id" hidden></h1>
            <div class="image_crop" hidden>
                <img id="menu-image" src="">
            </div>
            <h1 id="menu-name"></h1>
            <p id="menu-description"></p>
            <i class="fa-solid fa-minus" onclick="minamount()"></i>
            <!-- <button type="button" onclick="minamount()" style="background-color: transparent; border: none; margin: 10px;">-</button> -->
            <label id="amount">1</label>
            <i class="fa-solid fa-plus" onclick="plusamount()"></i>
            <!-- <button type="button" onclick="plusamount()" style=" background-color: transparent; border: none; margin: 10px;">+</button> -->
            <br><button class="btn btn-danger" onclick="order()" style="margin: 10px;"><i class="fa-solid fa-basket-shopping"></i> เพิ่มใส่ตะกร้า</button>
            <i onclick="closeForm()" class="fa-solid fa-xmark close-button"></i>
        </div>
    </div>

    <div id="overlay">
        <div id="overlay-text">สั่งอาหารเรียบร้อย!</div>
        <script src="https://cdn.lordicon.com/lordicon.js"></script>
        <lord-icon
            src="https://cdn.lordicon.com/cosvjkbu.json"
            trigger="loop"
            delay="1000"
            colors="primary:#e83a30,secondary:#646e78,tertiary:#3a3347"
            style="width:120px;height:120px">
        </lord-icon>
    </div>

    <label id="confirmorder" hidden></label>
    <?php
        $servername = "10.30.9.139";
        $port = 3306;
        $username = "root";
        $password = "root";
        $database = "shabu";

        $conn = mysqli_connect($servername,  $username, $password, $database, $port);

        // if (!$conn) {
        //     die("Connection failed: " . mysqli_connect_error());
        //   }
        //   echo "Connected successfully";

        $sql = "SELECT * FROM Menu";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo '<div class="menulist"><div class="menubox-1">';
            while ($row = mysqli_fetch_assoc($result)) {
                $menuId = $row["Menu_ID"];
                $menuName = $row["Menu_Name"];
                $menuDescription = $row["Menu_Description"];
                $menuImage = $row["Menu_Image"];

                echo "<div class='menubox-2-border'><div class='menubox-2' data-menu-id='$menuId' data-menu-name='$menuName' data-menu-description='$menuDescription' data-menu-image='$menuImage' onclick='showForm(this)'>
                <img src='img/menu/$menuImage' width='100' height='100'>
                <div class='menubox-3'><label>$menuName</label>
                <p>$menuDescription</p>
                        </div>
                    </div>
                </div>";
            }
            echo "</div></div>";
        } 
        else {
            echo "0 results";
        }
        // close connection
        mysqli_close($conn);
    
    ?>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="control.js"></script>

    
</body>
</html>
