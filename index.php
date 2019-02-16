<?php

include 'db_connect.php';
include 'templates/t_header.php';
include 'templates/t_menu.php';

function display_product($db) {
	if ($_GET != NULL)
		$category = $_GET['category'];
	else
		$category = 'all';
	$query = 'SELECT id FROM `category` WHERE name = "' . $category .'"';
	$id = mysqli_query($db, $query);
	$array = mysqli_fetch_assoc($id);
	$id = $array['id'];
	$query = 'SELECT product.* FROM product, category_product, category WHERE product.id = category_product.ID_product AND category.id = category_product.ID_category AND category_product.ID_category = "' . $id . '"';
	$product = mysqli_query($db, $query);
	$array = mysqli_fetch_all($product, MYSQLI_ASSOC);
	if ($array == NULL)
		die('No products in this category.');
	$nb_product = count($array);
	$i = 0;
	while ($i < $nb_product) {
		echo '<div class="product-card">';
		echo '	<div class="product-image">';
	 	echo '		<img src="'.$array[$i]['img'].'"></div>';
	 	echo '	<div class="product-info">';
	 	echo '		<h5>'.$array[$i]['name'].'</h5>';
	 	echo '		<div>'.$array[$i]['price'].'$</div>';
	 	echo '		<p class="add"><a href="panier.php?action=add&product='.$array[$i]['id'].'">Add to cart</a></p>';
	 	echo '	</div>';
	 	echo '</div>';
	 	$i++;
	}
	mysqli_free_result($product);
}
?>

<html>
<body>
	<div class="products">
		<?php display_product($db); ?>
	</div>
</body>
</html>

