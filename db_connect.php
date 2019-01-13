<?php

if (!$db = mysqli_connect('localhost', 'root', '123456', '42music'))
	die('Failed to connect to db: ' . mysqli_connect_error() . '<br>');

session_start();
