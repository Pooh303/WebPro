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
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>แดชบอร์ด - ชาบูวาสนา</title>
	<link rel="icon" type="image/x-icon" href="../src/dashboard/dashboard.png">
	<link rel="stylesheet" href="style.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link href="../src/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<script src="../src/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
	<?php include 'sidebar.php'; ?>
	<div class="main--content">
		<?php include 'header.php'; ?>
		<div class="card--container">
			<h3 class="main--title">สถิติ</h3>
			<div class="card--wrapper">
				<div class="payment--card light-red">
					<div class="card--header">
						<div class="amount">
							<span class="title">
								จำนวนออเดอร์
							</span>
							<span class="amount--value"><?php 
								$sql = "SELECT COUNT(`Order_ID`) FROM `order`;";
								$result = mysqli_query($conn, $sql);
								$row = mysqli_fetch_assoc($result);
								$total = $row['COUNT(`Order_ID`)'];
								echo $total;
							?></span>
						</div>
						<i class="fas fa-shopping-cart icon dark-red"></i>
					</div>
					<span class="card--detail">
						คำสั่งซื้อ
					</span>
				</div>
				<div class="payment--card light-purple">
					<div class="card--header">
						<div class="amount">
							<span class="title">
								จำนวนผู้เข้าใช้บริการ
							</span>
							<span class="amount--value"><?php 
								$sql = "SELECT SUM(`Number_of_Customer`) FROM `bill`;";
								$result = mysqli_query($conn, $sql);
								$row = mysqli_fetch_assoc($result);
								$total = $row['SUM(`Number_of_Customer`)'];
								echo $total;
							?></span>
						</div>
						<i class="fas fa-users icon dark-purple"></i>
					</div>
					<span class="card--detail">
						คน
					</span>
				</div>
				<div class="payment--card light-blue">
					<div class="card--header">
						<div class="amount">
							<span class="title">
								จำนวนเงิน
							</span>
							<span class="amount--value"><?php 
								$sql = "SELECT SUM(`Price`) FROM `bill`;";
								$result = mysqli_query($conn, $sql);
								$row = mysqli_fetch_assoc($result);
								$total = $row['SUM(`Price`)'];
								echo $total;
							?>
							</span>
						</div>
						<i class="fas fa-dollar-sign icon dark-blue"></i>
					</div>
					<span class="card--detail">
						บาท
					</span>
				</div>
				<div class="payment--card light-red">
					<div class="card--header">
						<div class="amount">
							<span class="title">
								เมนูขายดี
							</span>
							<span class="amount--value">
								<?php
									$sql = "select menuName , SUM(amount) from menuhis m group by menuName order by amount desc limit 1;";
									$result = mysqli_query($conn, $sql);
									$row = mysqli_fetch_assoc($result);
									echo $row['menuName'];
								?>
							</span>
						</div>
						<i class="fa-solid fa-bowl-food icon dark-red"></i>
					</div>
					<span class="card--detail">
						อันดับ#1
					</span>
				</div>
				<div class="payment--card light-green">
					<div class="card--header">
						<div class="amount">
							<span class="title">
								รายการที่สำเร็จ
							</span>
							<span class="amount--value"><?php 
								$sql = "SELECT COUNT(`Order_Status`) FROM `order` WHERE order_Status = 'serve';";
								$result = mysqli_query($conn, $sql);
								$row = mysqli_fetch_assoc($result);
								$total = $row['COUNT(`Order_Status`)'];
								echo $total;
							?></span>
						</div>
						<i class="fas fa-check-circle icon dark-green"></i>
					</div>
					<span class="card--detail">
						รายการ
					</span>
				</div>
			</div>
		</div>
		<div class="table-wrapper">
			<div class="table-header">
				<h3 class="main--title">
					ข้อมูลรายการสั่งอาหาร
				</h3>
				<div class="search--box">
					<i class="fa-solid fa-magnifying-glass"></i>
					<input type="text" placeholder="ค้นหาด้วยเลขไอดี" id="searchByIdInput" onkeyup="searchById()"/>
				</div>
			</div>
			<div class="table-container">
				<table id="dataTable">
					<thead>
						<tr>
							<th>ไอดีออเดอร์</th>
							<th>ไอดีโต๊ะ</th>
							<th>รายการ</th>
							<th>สถานะ</th>
						</tr>
					</thead>
					<tbody>
					<?php

						$statusMapping = array(
							'Empty' => 'ว่าง',
							'Doing' => 'กำลังทำ',
							'Finish' => 'เสร็จแล้ว',
							'Serve' => 'บริการ',
						);

						$sqlData = "SELECT * FROM `Order` ORDER BY Order_ID DESC;";
						$resultData = mysqli_query($conn, $sqlData);
						if ($resultData && mysqli_num_rows($resultData) > 0) {
							while ($row = mysqli_fetch_assoc($resultData)) {
								echo "<tr>";
								echo "<td id='ids'>" . $row['Order_ID'] . "</td>";
								echo "<td>" . $row['Table_ID'] . "</td>";

								$Data = json_decode($row['Data'], true);
								if (is_array($Data)) {
									$itemString = "";
									foreach ($Data as $item) {
										$itemString .= $item['name'] . " x" . $item['amount'] . ", ";
									}
									$itemString = rtrim($itemString, ", ");
									echo "<td>" . $itemString . "</td>";
								} else {
									echo "<td></td>";
								}

								$status = isset($statusMapping[$row['Order_Status']]) ? $statusMapping[$row['Order_Status']] : $row['Order_Status'];
        						echo "<td>" . $status . "</td>";
								echo "</tr>";
							}
						} else {
							echo "<tr><td colspan='5'>No food items found</td></tr>";
						}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<?php include 'edit-panel.php'; ?>
<script>
	function searchById() {
		var input, filter, table, tr, td, i, txtValue;
		input = document.getElementById("searchByIdInput");
		filter = input.value.toUpperCase();
		table = document.getElementById("dataTable");
		tr = table.getElementsByTagName("tr");

		for (i = 0; i < tr.length; i++) {
			td = tr[i].getElementsByTagName("td")[0];
			if (td) {
				txtValue = td.textContent || td.innerText;
				if (txtValue.toUpperCase().indexOf(filter) > -1) {
					tr[i].style.display = "";
				} else {
					tr[i].style.display = "none";
				}
			}
		}
	}
</script>
</body>
</html>
