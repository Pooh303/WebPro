<div id="editWindow" class="edit-panel">
	<div class="">
		<form id="editForm">
			<h2>แก้ไขธุรกรรม</h2>
			<label for="transactionDate">ไอดี :</label>
			<input type="text" id="transactionDate" name="transactionDate" readonly style="caret-color:transparent">
			<div class="form-group">
				<label for="transactionType">วัน/เวลา :</label>
				<input type="datetime-local" id="transactionType" name="transactionType" class="form-control">
			</div>

				<label for="transactionCategory">ประเภท :</label>
				<select id="transactionCategory" name="transactionCategory" class="form-control">
					<option value="รายรับ">รายรับ</option>
					<option value="รายจ่าย">รายจ่าย</option>
				</select>

			<label for="transactionAmount">จำนวนเงิน :</label>
			<input type="text" id="transactionAmount" name="transactionAmount" class="form-control">
			<label for="transactionStatus">สถานะ :</label>
			<select id="transactionStatus" name="transactionStatus" class="form-control">
				<option value="กำลังดำเนินการ">กำลังดำเนินการ</option>
				<option value="เสร็จสิ้น">เสร็จสิ้น</option>
				<option value="ยกเลิก">ยกเลิก</option>
			</select>
			<button type="submit" class="save_button">บันทึก</button>
			<button type="button" class="close_button" onclick="close_edit()">ยกเลิก</button>
		</form>
	</div>
</div>
