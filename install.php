<?php

// Connect to mysql
if ($db = mysqli_connect('localhost', 'root', 'shirakawa252mmE'))
	echo 'Connection to mysql successfull<br>';
else
	die('Failed to connect to db: ' . mysqli_connect_error() . '<br>');

// Create and select db
if (mysqli_query($db, 'CREATE DATABASE 42music'))
	echo 'Database created successfully<br>';
else
	echo('Failed to create db: ' . mysqli_error($db));

mysqli_select_db($db, '42music');

// Create tables from sql script
$tmp = '';
$error = '';
$script = file('42music.sql');
foreach ($script as $line) {
	if(substr($line, 0, 2) == '--' || $line == '')
		continue ;
	$tmp .= $line;
	if (substr(trim($line), -1, 1) == ';') {
		if(!mysqli_query($db, $tmp)) {
			$error .= 'Error performing query "<b>' . $tmp . '</b>": ' . mysqli_error($db) . '<br>';
		}
		$tmp = '';
	}
}
if (empty($error))
	echo 'Tables created successfully<br>';
