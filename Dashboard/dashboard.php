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
			<h3 class="main--title">สถิติรายวัน</h3>
			<div class="card--wrapper">
				<div class="payment--card light-red">
					<div class="card--header">
						<div class="amount">
							<span class="title">
								จำนวนออเดอร์
							</span>
							<span class="amount--value">32</span>
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
							<span class="amount--value">17</span>
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
							<span class="amount--value">2537.00</span>
						</div>
						<i class="fas fa-dollar-sign icon dark-blue"></i>
					</div>
					<span class="card--detail">
						บาท
					</span>
				</div>
				<div class="payment--card light-green">
					<div class="card--header">
						<div class="amount">
							<span class="title">
								รายการที่สำเร็จ
							</span>
							<span class="amount--value">8</span>
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
					ข้อมูลการเงิน
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
							<th>ไอดี</th>
							<th>วันที่</th>
							<th>ประเภท</th>
							<th>จำนวนเงิน</th>
							<th>สถานะ</th>
							<th>การดำเนินการ</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td id="ids">49024</td>
							<td>2023-02-01 12:21</td>
							<td>รายจ่าย</td>
							<td>500.00</td>
							<td>กำลังดำเนินการ</td>
							<td>
								<button class="action--btn edit" onclick="open_edit(this)">
									<i class="fas fa-edit"></i>
								</button>
								<button class="action--btn delete">
									<i class="fas fa-trash"></i>
								</button>
							</td>
						</tr>
						<tr>
							<td id="ids">25021</td>
							<td>2023-03-01 12:34</td>
							<td>รายจ่าย</td>
							<td>500.00</td>
							<td>กำลังดำเนินการ</td>
							<td>
								<button class="action--btn edit" onclick="open_edit(this)">
									<i class="fas fa-edit"></i>
								</button>
								<button class="action--btn delete">
									<i class="fas fa-trash"></i>
								</button>
							</td>
						</tr>
						<tr>
							<td id="ids">15080</td>
							<td>2023-05-01 01:23</td>
							<td>รายจ่าย</td>
							<td>500.00</td>
							<td>กำลังดำเนินการ</td>
							<td>
								<button class="action--btn edit" onclick="open_edit(this)">
									<i class="fas fa-edit"></i>
								</button>
								<button class="action--btn delete">
									<i class="fas fa-trash"></i>
								</button>
							</td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="6">ยอดรวมสุทธิ : 1500.00 บาท</td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
	<?php include 'edit-panel.php'; ?>
<script>
    function open_edit(btn) {
        var row = btn.closest("tr");
        var date = row.cells[0].innerText;
        var type = row.cells[1].innerText;
        var category = row.cells[2].innerText;
        var amount = row.cells[3].innerText;
        var status = row.cells[4].innerText;

        document.getElementById("transactionDate").value = date;
        document.getElementById("transactionType").value = type;
        document.getElementById("transactionCategory").value = category;
        document.getElementById("transactionAmount").value = amount;
        document.getElementById("transactionStatus").value = status;

        document.getElementById("editWindow").style.display = "block";
    }

	function formatDateForInput(dateString) {
    	// Input format: "YYYY-MM-DD HH:MM"
		var dateParts = dateString.split(' ')[0].split('-');
		var timeParts = dateString.split(' ')[1].split(':');
		// Create a date object with the date parts
		var dateObject = new Date(dateParts[0], dateParts[1] - 1, dateParts[2], timeParts[0], timeParts[1]);
		// Format to "YYYY-MM-DDTHH:MM"
		var formattedDate = dateObject.toISOString().slice(0, 16);

		return formattedDate;
	}

    function close_edit() {
        document.getElementById("editWindow").style.display = "none";
    }

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
