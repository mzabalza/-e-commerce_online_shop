<?php

include 'templates/t_header.php';
include 'db_connect.php';

if ($_GET == NULL) {
	header('Location: index.php');
	exit ;
}

$id = $_GET['id'];
$check = false;

$product = mysqli_query($db, 'SELECT id FROM product');
while ($array = mysqli_fetch_assoc($product)) {
	if ($array['id'] == $id) {
		$check = true;
		break ;
	}
}

if (!$check) {
	die('Cette page n\'existe pas');
}

$query = 'SELECT  * FROM product WHERE id = "'.$id.'"';
$product = mysqli_query($db, $query);
$array = mysqli_fetch_all($product, MYSQLI_ASSOC);
print_r($array[0]);
$name = $array[0]['name'];
$price = $array[0]['price'];
$description = $array[0]['description'];
$img = $array[0]['img'];

?>

<html>
</head>
<body>

</body>
</html>
