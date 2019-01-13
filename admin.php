<?php

include 'db_connect.php';
include 'templates/t_header.php';
include 'templates/t_menu.php';
include 'templates/t_admin.php';

function modif_user($id, $key, $value, $db) {
	if ($key == 'passwd')
		$value = hash('whirlpool', $value);
	$query = 'UPDATE user SET '.$key.'="'.$value.'" WHERE email="'.$id.'"';
	mysqli_query($db, $query);
}

function modif_product ($id, $key, $value, $db) {
	if ($key == 'categories') {
		$query = 'SELECT id FROM product WHERE name ="'.$id.'"';
		$result = mysqli_fetch_assoc(mysqli_query($db, $query));
		$id = $result['id'];
		mysqli_query($db, 'DELETE FROM category_product WHERE ID_product = "'.$id.'"');
		$id_categories = explode(';', $value);
		$check_all = 0;
		foreach ($id_categories as $test) {
			if ($test == 'all'){
				$check_all = 1;
				break ;
			}
		}
		if (!$check_all)
			array_unshift($id_categories, 'all');
		$i = 0;
		foreach ($id_categories as $replace) {
			$result = mysqli_fetch_assoc(mysqli_query($db, 'SELECT id FROM category WHERE name="'.$replace.'"'));
			$id_categories[$i] = $result['id'];
			$i++;
		}
		foreach ($id_categories as $insert) {
			mysqli_query($db, 'INSERT INTO category_product VALUES (NULL, "'.$insert.'","'.$id.'")');
		}
		return ;
	}
	$query = 'UPDATE product SET '.$key.'="'.$value.'" WHERE name="'.$id.'"';
	mysqli_query($db, $query);
}

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

if ($_SESSION['logged_user_admin'] == false) {
	header('Location: index.php');
	exit();
}

if ($_POST != NULL) {
	switch ($_POST['submit']) {
		case 'Confirm user datas modification':
			$password = hash('whirlpool', $_POST['passwd']);
			switch ($_POST['s_user']) {
				case 'add':
					$user = mysqli_query($db, 'SELECT email FROM user');
					while ($array = mysqli_fetch_assoc($user)) {
						if ($array['email'] == $_POST['mail'])
							die("An account whit this email already exist.");
					}
					$passwd = hash('whirlpool', $_POST['passwd']);
					$query = 'INSERT INTO user VALUES (NULL, false,"'.$_POST['mail'].'","'.$passwd.'","'.$_POST['name'].'","'.$_POST['first_name'].'","'.$_POST['adress'].'","'. $_POST['zip'].'","'.$_POST['city'].'")';
					mysqli_query($db, $query);
					echo 'User created';
					break;
				case 'modif':
					$test = 0;
					$user = mysqli_query($db, 'SELECT email FROM user');
					while ($array = mysqli_fetch_assoc($user)) {
						if ($array['email'] != $_POST['mail']) {
							$test = 1;
							continue ;
						}
						$test = 0;
					}
					if ($test)
						die("This account doesn't exist.");
					foreach ($_POST as $key => $value) {
						if ($key == 's_user' || $key == 'submit' || $key == 'mail')
							continue ;
						if (isset($key) && $value != "") {
							modif_user($_POST['mail'], $key, $value, $db);
						}
					}
					echo "User modified.";
					break;
				case 'del':
					$test = 0;
					$user = mysqli_query($db, 'SELECT email FROM user');
					while ($array = mysqli_fetch_assoc($user)) {
						if ($array['email'] != $_POST['mail']) {
							$test = 1;
							continue ;
						}
						else {
							$test = 0;
							break ;
						}
					}
					if ($test)
						die("This account doesn't exist.");
					mysqli_query($db, 'DELETE FROM user WHERE email="'.$_POST['mail'].'"');
					echo "User deleted.";
					break;
			}
			break;
		case 'Confirm product datas modification':
			switch ($_POST['s_product']) {
				case 'add':
					$result = mysqli_query($db, 'SELECT name FROM product');
					while ($array = mysqli_fetch_assoc($result)) {
						if ($array['name'] == $_POST['name'])
							die("This product already exist.");
					}
					$query = 'INSERT INTO product VALUES (NULL, "'.$_POST['name'].'","'.$_POST['price'].'","'.$_POST['img'].'")';
					mysqli_query($db, $query);
					$query = 'SELECT id FROM product WHERE id = LAST_INSERT_ID()';
					$id_product = mysqli_fetch_assoc(mysqli_query($db, $query));
					$id_categories = explode(';', $_POST['categories']);
					$check_all = 0;
					foreach ($id_categories as $value) {
						if ($value == 'all'){
							$check_all = 1;
							break ;
						}
					}
					if (!$check_all)
						array_unshift($id_categories, 'all');
					$i = 0;
					foreach ($id_categories as $value) {
						$result = mysqli_fetch_assoc(mysqli_query($db, 'SELECT id FROM category WHERE name="'.$value.'"'));
						$id_categories[$i] = $result['id'];
						$i++;
					}
					foreach ($id_categories as $value) {
						mysqli_query($db, 'INSERT INTO category_product VALUES (NULL, "'.$value.'","'.$id_product['id'].'")');
					}
					break;
				case 'modif':
					$test = 0;
					$user = mysqli_query($db, 'SELECT name FROM product');
					while ($array = mysqli_fetch_assoc($user)) {
						if ($array['name'] != $_POST['name']) {
							$test = 1;
							continue ;
						}
						else {
							$test = 0;
							break ;
						}
					}
					if ($test)
						die("This product doesn't exist.");
					foreach ($_POST as $key => $value) {
						if ($key == 's_product' || $key == 'submit' || $key == 'name')
							continue ;
						if (isset($key) && $value != "") {
							modif_product($_POST['name'], $key, $value, $db);
						}
					}
					echo "Product modified.";
					break;
				case 'del':
					$test = 0;
					$user = mysqli_query($db, 'SELECT name FROM product');
					while ($array = mysqli_fetch_assoc($user)) {
						if ($array['name'] != $_POST['name']) {
							$test = 1;
							continue ;
						}
						else {
							$test = 0;
							break ;
						}
					}
					if ($test)
						die("This product doesn't exist.");
					$query = 'SELECT id FROM product WHERE name ="'.$_POST['name'].'"';
					$result = mysqli_fetch_assoc(mysqli_query($db, $query));
					mysqli_query($db, 'DELETE FROM category_product WHERE ID_product = "'.$result['id'].'"');
					mysqli_query($db, 'DELETE FROM product WHERE name="'.$_POST['name'].'"');
					echo "Product deleted.";
					break ;
			}
			break;
		case 'Confirm category datas modification':
			switch ($_POST['s_category']) {
				case 'add':
					$result = mysqli_query($db, 'SELECT name FROM category');
					while ($array = mysqli_fetch_assoc($result)) {
						if ($array['name'] == $_POST['name'])
							die("This category already exist.");
					}
					$query = 'INSERT INTO category VALUES (NULL, "'.$_POST['name'].'")';
					mysqli_query($db, $query);
					echo 'Category created';
					break;
				case 'modif':
					if ($_POST['name'] == 'all')
						die("Can't edit this category.");
					$test = 0;
					$user = mysqli_query($db, 'SELECT name FROM category');
					while ($array = mysqli_fetch_assoc($user)) {
						if ($array['name'] != $_POST['name']) {
							$test = 1;
							continue ;
						}
						$test = 0;
					}
					if ($test)
						die("This category doesn't exist.");
					$query = 'UPDATE category SET name="'.$_POST['new_name'].'" WHERE name="'.$_POST['name'].'"';
					mysqli_query($db, $query);
					echo "Category modified.";
					break;
				case 'del':
					if ($_POST['name'] == 'all')
						die("Can't delete this category.");
					$test = 0;
					$user = mysqli_query($db, 'SELECT name FROM category');
					while ($array = mysqli_fetch_assoc($user)) {
						if ($array['name'] != $_POST['name']) {
							$test = 1;
							continue ;
						}
						else {
							$test = 0;
							break ;
						}
					}
					if ($test)
						die("This category doesn't exist.");
					mysqli_query($db, 'DELETE FROM category WHERE name="'.$_POST['name'].'"');
					echo "Category deleted.";
				break;
			}
	}
}
