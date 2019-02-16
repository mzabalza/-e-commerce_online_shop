<?php

if (!$db = mysqli_connect('localhost', 'root', 'toardoui', '42music'))
	die('Failed to connect to db: ' . mysqli_connect_error() . '<br>');

session_start();
