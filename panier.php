<?php

include 'db_connect.php';
include 'templates/t_header.php';
include 'templates/t_menu.php';
include 'lib_basket.php';

if ($_GET != NULL) {
	bt_create_basket();
	$query = 'SELECT * FROM product WHERE id='.$_GET['product'];
	$result = mysqli_query($db, $query);
	$array = mysqli_fetch_assoc($result);
	if ($array == NULL)
		die("Product doesn't exist.");
	switch ($_GET['action']) {
		case 'add':
			bt_add_product($array['name'], $array['price']);
			break;
		case 'del':
			bt_rm_product($array['name']);
			break;
		default:
			die("Error.");
			break;
	}
	header('Location: panier.php');
}
else if ($_POST != NULL) {

	if (!isset($_SESSION['logged_user']))
		die("You need to be connected to order.");
	$nb_product = count($_SESSION['basket']['name']);
	if ($nb_product <= 0) {
		header('Location: panier.php');
		exit ;
	}
	$query = 'INSERT INTO order_archive VALUES (NULL, '.$_SESSION['logged_user_id'].','.bt_do_total().')';
	mysqli_query($db, $query);
	$query = 'SELECT id FROM order_archive WHERE id = LAST_INSERT_ID()';
	$id_order = mysqli_fetch_assoc(mysqli_query($db, $query));
	for ($i=0; $i < $nb_product; $i++) {
		$query = 'SELECT id FROM product WHERE name="'.$_SESSION['basket']['name'][$i].'"';
		$id_product = mysqli_fetch_assoc(mysqli_query($db, $query));
		$query = 'INSERT INTO order_product VALUES (NULL, '.$id_order['id'].','.$id_product['id'].','.$_SESSION['basket']['nb'][$i].')';
		mysqli_query($db, $query);
	}
	bt_rm_basket();
	header('Location: panier.php');
}

?>

<html>
	<body>
		<form action="panier.php" method="post">
		<table style="width: 100vw">
		<tr>
			<td>Name</td>
			<td>Amount</td>
			<td>Price</td>
			<td>Action</td>
		</tr>
		<?php
		if (bt_create_basket()) {
			$nb_product = count($_SESSION['basket']['name']);
			if ($nb_product <= 0)
				die("Your basket is empty, go to <a href='index.php'>home</a>.");
			else {
				for ($i=0; $i < $nb_product; $i++) {
					echo '<tr>';
					echo '<td>'.$_SESSION['basket']['name'][$i].'</td>';
					echo '<td>'.$_SESSION['basket']['nb'][$i].'</td>';
					echo '<td>'.$_SESSION['basket']['price'][$i].'$</td>';
					$array = mysqli_fetch_assoc(mysqli_query($db, 'SELECT id FROM product WHERE name="'.$_SESSION['basket']['name'][$i].'"'));
					echo '<td><a href="panier.php?action=del&product='.$array['id'].'">DELETE</a></td>';
				}
				echo '<tr><td colspan="2"></td>';
				echo '<td colspan="2">';
				echo 'Total: '.bt_do_total().'$';
				echo '</td></tr>';
			}
		}
		?>
		<tr><td colspan="4">
			<input type="submit" value="Order">
			<input type="hidden" name="action" value="refresh">
		</td></tr>
		</table>
		</form>
	</body>
</html>
