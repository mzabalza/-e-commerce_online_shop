<html>
<body>
	<h2>Users</h2>
	<form method="post" action="admin.php" id=f_user>
		<table>
			<tr>
				<td>Action</td>
				<td>Email</td>
				<td>Admin</td>
				<td>Password</td>
				<td>Name</td>
				<td>First Name</td>
				<td>Adress</td>
				<td>Zip Code</td>
				<td>City</td>
			</tr>
			<tr>
				<td><select name="s_user" form="f_user">
					<option value="add">Add</option>
					<option value="modif">Edit</option>
					<option value="del">Delete</option>
				</select></td>
				<td><input type="email" name="mail"></td>
				<td><input type="number" name="admin"></td>
				<td><input type="password" name="passwd"></td>
				<td><input type="text" name="name"></td>
				<td><input type="text" name="first_name"></td>
				<td><input type="text" name="adress"></td>
				<td><input type="number" name="zip"></td>
				<td><input type="text" name="city"></td>
				<td><input type="submit" name="submit" value="Confirm user datas modification"></td>
			</tr>
		</table>
	</form>
	<h2>Products</h2>
	<form method="post" action="admin.php" id="f_product">
		<table>
			<tr>
				<td>Action</td>
				<td>Name</td>
				<td>Price</td>
				<td>Img</td>
				<td>Categories</td>
			</tr>
			<tr>
				<td><select name="s_product" form="f_product">
					<option value="add">Add</option>
					<option value="modif">Edit</option>
					<option value="del">Delete</option>
				</select></td>
				<td><input type="text" name="name"></td>
				<td><input type="number" name="price"></td>
				<td><input type="text" name="img"></td>
				<td><input type="text" name="categories"></td>
				<td><input type="submit" name="submit" value="Confirm product datas modification"></td>
			</tr>
		</table>
	</form>
	<h2>Categories</h2>
	<form method="post" action="admin.php" id="f_category">
		<table>
			<tr>
				<td>Action</td>
				<td>Name</td>
				<td>New Name</td>
			</tr>
			<tr>
				<td><select name="s_category" form="f_category">
					<option value="add">Add</option>
					<option value="modif">Edit</option>
					<option value="del">Delete</option>
				</select></td>
				<td><input type="text" name="name"></td>
				<td><input type="text" name="new_name"></td>
				<td><input type="submit" name="submit" value="Confirm category datas modification"></td>
			</tr>
		</table>
	</form>
	<h2>Orders</h2>
	<table class="orders">
		<tr>
			<th class="order_no">Order no.</th>
			<th class="order_cust">Customer</th>
			<th class="order_price">Price</th>
		</tr>
		<?php display_orders($db) ?>
	</table>
</body>
