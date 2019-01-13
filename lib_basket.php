<?php

function bt_create_basket() {
	if (!isset($_SESSION['basket'])) {
		$_SESSION['basket'] = array();
		$_SESSION['basket']['name'] = array();
		$_SESSION['basket']['nb'] = array();
		$_SESSION['basket']['price'] = array();
	}
	return true;
}

function bt_add_product($name, $price) {
	if (bt_create_basket()) {
		$i = array_search($name, $_SESSION['basket']['name']);
		if ($i !== false) {
			$_SESSION['basket']['nb'][$i] += 1;
		}
		else {
			array_push($_SESSION['basket']['name'], $name);
			array_push($_SESSION['basket']['nb'], 1);
			array_push($_SESSION['basket']['price'], $price);
		}
	}
	else
		echo "Error.";
}

function bt_rm_product($name) {
	if (bt_create_basket()) {
		$tmp = array();
		$tmp['name'] = array();
		$tmp['nb'] = array();
		$tmp['price'] = array();

		for ($i=0; $i < count($_SESSION['basket']['name']); $i++) {
			if ($_SESSION['basket']['name'][$i] !== $name) {
				array_push($tmp['name'], $_SESSION['basket']['name'][$i]);
				array_push($tmp['nb'], $_SESSION['basket']['nb'][$i]);
				array_push($tmp['price'], $_SESSION['basket']['price'][$i]);
			}
		}
		$_SESSION['basket'] = $tmp;
		unset($tmp);
	}
	else
		echo "Error.";
}

function bt_modify_nb($name, $nb) {
	if (bt_create_basket()){
		if ($nb > 0) {
			$i = array_search($name, $_SESSION['basket']['name']);

			if ($i !== false) {
				$_SESSION['basket']['nb'][$i] = $nb;
			}
		}
		else
			bt_rm_product($name);
	}
	else
		echo "Error.";
}

function bt_do_total() {
	$total = 0;
	for ($i=0; $i < count($_SESSION['basket']['name']); $i++)
		$total += $_SESSION['basket']['nb'][$i] * $_SESSION['basket']['price'][$i];
	return $total;
}

function bt_count_products() {
	if (isset($_SESSION['basket']))
		return count($_SESSION['basket']['name']);
	return 0;
}

function bt_rm_basket() {
	unset($_SESSION['basket']);
}
