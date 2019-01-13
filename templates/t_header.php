<html>
<head>
	<title>42music</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="upper-header">
	<div class="icon"><a href="index.php" title="home"><img class="logo_img" src="https://vignette.wikia.nocookie.net/logopedia/images/5/52/NU_Music.png/revision/latest?cb=20160927040426"></a></div>
	<div class="left">
		<div class="icon">
			<?php
			if (isset($_SESSION['logged_user'])) {
				if ($_SESSION['logged_user_admin'] == true)
					echo '<a href="admin.php" class="login_a"><img class="login_img" src="https://img.icons8.com/ios/1600/admin-settings-male-filled.png"></a>';
			}
			?>
		</div>
		<div class="icon">
			<?php
			if (isset($_SESSION['logged_user'])) {
				echo '<a href="logout.php" class="login_a"><img class="login_img" src="http://icons.iconarchive.com/icons/icons8/windows-8/512/User-Interface-Logout-icon.png"></a>';
			}
			else
				echo '<a href="create.php" class="login_a"><img class="login_img" src="https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-ios7-contact-outline-128.png"></a>';
			?>
		</div>
	</div>
</div>
</body>
</html>
