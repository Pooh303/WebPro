<?php
// Database connection
$servername = "10.30.9.139";
$port = 3306;
$username = "root";
$password = "root";
$database = "shabu";

$conn = mysqli_connect($servername, $username, $password, $database, $port);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['submit'])){
    $editMenuName = $_POST['add_menuName'];
    $editMenuDescription = $_POST['add_menuDescription'];

    if(isset($_FILES['menuImage']) && $_FILES['menuImage']['error'] === UPLOAD_ERR_OK) {
        $menuImage = $_FILES['menuImage']['name'];
        $tempName = $_FILES['menuImage']['tmp_name'];

        $targetDir = "../MenuOrder/img/menu/";
        $targetFile = $targetDir . basename($menuImage);

        if(move_uploaded_file($tempName, $targetFile)){
            $sql = "INSERT INTO Menu (Menu_Name, Menu_Description, Menu_Image) VALUES ('$editMenuName', '$editMenuDescription', '$menuImage')";
        } else {
            $sql = "INSERT INTO Menu (Menu_Name, Menu_Description, Menu_Image) VALUES ('$editMenuName', '$editMenuDescription', 'spoon.png')";
        }
    } else {
        
        $sql = "INSERT INTO Menu (Menu_Name, Menu_Description, Menu_Image) VALUES ('$editMenuName', '$editMenuDescription', 'spoon.png')";
    }

    $result = mysqli_query($conn, $sql);
    if(!$result) {
        echo "Error: " . mysqli_error($conn);
    } else {
        header("Location: menu.php");
        exit();
    }
}

$sqlData = "SELECT * FROM `Menu`;";
$resultData = mysqli_query($conn, $sqlData);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เซอร์วิส - ชาบูวาสนา</title>
    <link rel="stylesheet" href="style.css"/>
    <link rel="icon" type="image/x-icon" href="../src/dashboard/dashboard.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="../src/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../src/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        input, textarea {
            caret-color: black !important;
        }
    </style>
</head>
<body>
    <?php include 'sidebar.php'; ?>

    <div class="main--content">
        <?php include 'header.php'; ?>
        <div class="wrapper-box">
            <div class="container">
                <h1>รายการอาหาร</h1>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addMenuModal"><i class="fa-solid fa-plus"></i> เพิ่มรายการ</button>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" class="table_header">ไอดี</th>
                                    <th scope="col" class="table_header">รูปภาพ</th>
                                    <th scope="col" class="table_header">ชื่อเมนู</th>
                                    <th scope="col" class="table_header">รายละเอียด</th>
                                    <th scope="col" class="table_header">จัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($resultData && mysqli_num_rows($resultData) > 0) {
                                    while ($row = mysqli_fetch_assoc($resultData)) {
                                        echo "<tr>";
                                        echo "<th scope='row'>" . $row["Menu_ID"] . "</th>";
                                        echo "<td ><img src='" . "../MenuOrder/img/menu/" . $row["Menu_Image"] . "' alt='Menu Photo' class='menu-photo'></td>";
                                        echo "<td class='menu_name'>" . $row["Menu_Name"] . "</td>";
                                        echo "<td>" . $row["Menu_Description"] . "</td>";
                                        echo "<td>";
                                        echo "<div class='fbutton'><button class='btn btn-sm btn-primary edit-btn' data-toggle='modal' data-target='#editMenuModal' data-id='" . $row["Menu_ID"] . "' data-name='" . $row["Menu_Name"] . "' data-description='" . $row["Menu_Description"] . "'>แก้ไข</button>";
                                        echo "<form method='post' action='menu_actions.php'>";
                                        echo "<input type='hidden' name='delete_menuId' value='" . $row["Menu_ID"] . "'>";
                                        echo "<button type='submit' class='btn btn-sm btn-danger delete-btn' name='delete_submit'>ลบ</button></div>";
                                        echo "</form>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='5'>ไม่พบรายการอาหาร</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Popup -->
    <div class="modal fade" id="addMenuModal" tabindex="-1" role="dialog" aria-labelledby="addMenuModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMenuModalLabel">เพิ่มรายการอาหารใหม่</h5>
                    <i class="fa-solid fa-xmark close" data-dismiss="modal" aria-label="Close"></i>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" id="addMenuForm" method="post">
                        <div class="form-group">
                            <label for="add_menuName">ชื่อเมนู</label>
                            <input type="text" class="form-control" name="add_menuName" id="add_menuName" placeholder="ชื่อเมนู">
                        </div>
                        <div class="form-group">
                            <label for="add_menuDescription">รายละเอียด</label>
                            <textarea class="form-control" name="add_menuDescription" id="add_menuDescription" placeholder="รายละเอียด"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="menuImage">รูปภาพ</label>
                            <input type="file" class="form-control-file" name="menuImage" id="menuImage" accept="image/*">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                            <button type="submit" class="btn btn-primary" id="saveMenuBtn" name="submit">บันทึก</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Popup -->
    <div class="modal fade" id="editMenuModal" tabindex="-1" role="dialog" aria-labelledby="editMenuModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editMenuModalLabel">แก้ไขรายการอาหาร</h5>
                    <i class="fa-solid fa-xmark close" data-dismiss="modal" aria-label="Close"></i>
                </div>
                <div class="modal-body">
                    <form action="menu_actions.php" method="post">
                        <div class="form-group">
                            <label for="editMenuName">ชื่อเมนู</label>
                            <input type="text" class="form-control" id="editMenuName" name="edit_menuName" placeholder="ชื่อเมนู">
                        </div>
                        <div class="form-group">
                            <label for="editMenuDescription">รายละเอียด</label>
                            <textarea class="form-control" id="editMenuDescription" name="edit_menuDescription" placeholder="รายละเอียด"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                            <button type="submit" class="btn btn-primary" id="saveEditMenuBtn" name="edit_submit">บันทึก</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function() {
        // Edit button click event
        $('.edit-btn').click(function() {
            var menuId = $(this).data('id');
            var menuName = $(this).data('name');
            var menuDescription = $(this).data('description');

            // Set data to modal fields
            $('#editMenuName').val(menuName);
            $('#editMenuDescription').val(menuDescription);

            // Append menu ID to form
            $('#editMenuModal form').append('<input type="hidden" name="edit_menuId" value="' + menuId + '">');
        });
    });
    </script>
</body>
</html>
