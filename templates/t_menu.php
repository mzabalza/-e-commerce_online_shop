<html>
<body>
	<div class="lower-header">
		<div class="selector">
			<form action="" method="post" class=selector>
				<div class="dropdown">
					<select name="category" class="dropdown-select" >
						<?php
						$query = 'SELECT name FROM category';
						$category = mysqli_query($db, $query);
						while ($array = mysqli_fetch_assoc($category)) {
							if ($array['name'] == 'all') //dont get it
								echo '<option selected="selected" value="'.$array['name'].'">'.$array['name'].'</option>';
							else
								echo '<option value="'.$array['name'].'">'.$array['name'].'</option>';
						}
						mysqli_free_result($category);
						?>
					</select>
				</div>
				<div class="search_butt">
					<input id="ok" type="submit" value="OK">
				</div>
			</form>
		</div>
		<div class="basket">
			<div class="icon">
				<a class="basket_a" href="panier.php"><img class="login_img" src="https://www.freeiconspng.com/uploads/basket-cart-icon-27.png"></a>
			</div>
		</div>
	</div>
</body>
</html>
