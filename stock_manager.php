<?php

include 'db_connect.php';
include 'templates/t_header.php';
include 'templates/t_menu2.php';

function display_orders($db) {
	$query = 'SELECT * FROM order_archive';
	$result = mysqli_fetch_all(mysqli_query($db, $query), MYSQLI_ASSOC);
	for ($i=0; $i < count($result); $i++) {
		$query = 'SELECT name FROM user WHERE id="'.$result[$i]['ID_user'].'"';
		$user = mysqli_fetch_assoc(mysqli_query($db, $query));
		echo '<tr><td>'.$result[$i]['id'].'</td>';
		echo '<td>'.$user['name'].'</td>';
		echo '<td>'.$result[$i]['price'].'$</td></tr>';
	}
}

function display_stock($db) {
	$query = 'SELECT name, quantity from product';

	$result = mysqli_fetch_all(mysqli_query($db, $query), MYSQLI_ASSOC);
	for ($i=0; $i < count($result); $i++) {
		$query = 'SELECT name FROM user WHERE id="'.$result[$i]['ID_user'].'"';
		$user = mysqli_fetch_assoc(mysqli_query($db, $query));
		echo '<tr class="stock_info"><th>'.$result[$i]['name'].'</th>';
		echo '<th>'.$result[$i]['quantity'].'</th>';
		echo '<th class="add"><a href="stock_manager.php?product='.$result[$i]['name'].'"</a>Add</td>';
	}
	if ($_POST != NULL) {
		$mike = 'MIKE';
	}
}
?>

<html>
<body>
	<h2>STOCK MANAGER</h2>
	<table class="orders" method="post" action="stock_manager.php">
		<tr>
			<th class="order_no">Product</th>
			<th class="order_cust">Stock</th>
			<th class="order_cust"></th>

		</tr>
		<?php display_stock($db) ?>
	</table>
</body>
</html>

<?php

if ($_GET != NULL) {
	$query = 'SELECT quantity FROM product WHERE name="'.$_GET['product'].'"';
	$quantity = mysqli_fetch_assoc(mysqli_query($db, $query));
	$quantity =  $quantity['quantity'] + 1;
	$query = 'UPDATE product SET quantity='.$quantity.' WHERE name="'.$_GET['product'].'"';
	mysqli_query($db, $query);
	header('Location: stock_manager.php');
}

?>