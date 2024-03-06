<div class="header--wrapper">
	<div class="header--title">
		<span></span>
		<h2>ชาบูวาสนา</h2>
	</div>
	<div class="user--info">
		<?php 
		session_start();
		if(!$_SESSION['admin_name']){Header('Location:login.html');exit;};
		echo "<span>{$_SESSION['admin_name']} {$_SESSION['admin_surename']}</span>";
		echo "<img src='{$_SESSION['admin_profile']}' />";
		?>
	</div>
</div>
