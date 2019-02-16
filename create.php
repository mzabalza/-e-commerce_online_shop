<?php

include 'db_connect.php';
include 'templates/t_header.php';
include 'templates/t_menu.php';
include 'templates/t_create.php';

if ($_POST != NULL) {
	if ($_POST['submit'] == "S'inscrire") {
		$user = mysqli_query($db, 'SELECT email FROM user');
		while ($array = mysqli_fetch_assoc($user)) {
			if ($array['email'] == $_POST['mail'])
				die("Un compte avec l'adresse <b>" . $_POST['mail'] . "</b> existe deja.");
		}
		$passwd = hash('whirlpool', $_POST['passwd']);
		$query = 'INSERT INTO user VALUES (NULL, false,"'.$_POST['mail'].'","'.$passwd.'","'.$_POST['name'].'","'.$_POST['first_name'].'","'.$_POST['adress'].'","'. $_POST['zip'].'","'.$_POST['city'].'")';
		if (mysqli_query($db, $query))
			echo 'Account created';
		else
			die('Error creating account:' . mysqli_error($db));
		mysqli_free_result($user);
	}
	else if ($_POST['submit'] == "Se connecter") {
		$login = $_POST['mail'];
		$passwd = hash('whirlpool', $_POST['passwd']);
		$query = 'SELECT COUNT(*) FROM user WHERE email = "'.$login.'" AND passwd = "'.$passwd.'"';

		$count = mysqli_query($db, $query);
		$test = mysqli_fetch_assoc($count);
		if ($test['COUNT(*)']) {
			header('Location: index.php');
			$_SESSION['logged_user'] = $login;
			$query = 'SELECT name FROM user WHERE email = "'.$login.'"';
			$name = mysqli_fetch_assoc(mysqli_query($db, $query));
			$_SESSION['logged_user_name'] = $name['name'];
			$query = 'SELECT admin FROM user WHERE email = "'.$login.'"';
			$admin = mysqli_fetch_assoc(mysqli_query($db, $query));
			$_SESSION['logged_user_admin'] = $admin['admin'];
			$query = 'SELECT id FROM user WHERE email = "'.$login.'"';
			$id = mysqli_fetch_assoc(mysqli_query($db, $query));
			$_SESSION['logged_user_id'] = $id['id'];
		}
		else {
			die("<p class=error>Wrong username/password.</p>");
		}
		mysqli_free_result($user);
	}

}
?>

