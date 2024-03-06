<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/x-icon" href="../src/give.png">
	<title>ขอบคุณที่ใช้บริการ</title>
	<link href="../src/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<script src="../src/bootstrap/js/bootstrap.min.js"></script>
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
		body{
			background-color: rgb(250, 100, 100);
		}

		.header-div {
			position: fixed;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			font-size: 1rem;
			font-weight: 400;
			color: white;
			text-align: center;
			white-space: nowrap;
		}

		.header-div h1 {
			margin: 0;
			text-shadow: 1px 1px 1rempx rgba(0, 0, 0, 1);
		}
	</style>
</head>
<body>
	<div class="container contain">
		<div class="row">
			<div class="col-md-6 header-div">
				<h1>ขอบคุณที่ใช้บริการ🙏🏽</h1>
				<h3 style='text-decoration: underline;'>ชาบูวาสนา</h3>
				<form class="myForm" id="myForm" method="POST" 
				action="https://script.google.com/macros/s/AKfycbxkKTfC3Y0sNArDPkWKg5nfl3JWQHNk_oMAHlacpvxKZSnpQLB2LpPCK5Rl3PMVyEI/exec">
					<div class="mb-3">
						<textarea class="form-control" id="message" name="Message" rows="4" required style="resize: none; caret-color: black;" placeholder="รีวิวคุณภาพการให้บริการ"></textarea>
					</div>
					<button type="submit" formnovalidate id="contact_submit_btn btnprimary" class="btn btn-primary"><i class="fa-regular fa-paper-plane"></i> ส่ง</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
