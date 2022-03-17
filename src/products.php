<?php
session_start();
if (!isset($_SESSION["cart"])) {
	$_SESSION["cart"] = array();
}
require("config.php");

$amt = 0;
foreach ($_SESSION["cart"] as $prod) {
	foreach ($products as $key => $val) {
		if ($products[$key]["id"] == $prod["id"]) {
			$product = $products[$key];
			break;
		}
	}
	$amt += ($product["price"] * $prod["quantity"]);
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>
		Products
	</title>
	<link href="css/style.css" type="text/css" rel="stylesheet">
</head>

<body>
	<?php include "header.php"; ?>
	<div id="main">
		<div id="products">
			<?php foreach ($products as $prod) { ?>
				<div id="<?php echo $prod["id"]; ?>" class="product">
					<img src="images/<?php echo $prod["image"]; ?>">
					<h3 class="title"><a href="#"><?php echo $prod["name"]; ?></a></h3>
					<span>Price: $<?php echo $prod["price"]; ?></span>
					<a class="add-to-cart" href="addToCart.php?id=<?php echo $prod["id"]; ?>&action=add">Add To Cart</a>
				</div>
			<?php } ?>

		</div>
		<div id="cartList">
			<?php if (count($_SESSION["cart"]) > 0) { ?>
				<h1 style="margin-left: 40%;">Selected Cart Items</h1>
				<table style="width:100%; border:1px solid black;">
					<thead>
						<th style="border:1px solid black;">Product</th>
						<th style="border:1px solid black;">Product-name</th>
						<th style="border:1px solid black;">Product-price</th>
						<th style="border:1px solid black;">Product-quantity</th>
						<th style="border:1px solid black;">Product-amount</th>
						<th style="border:1px solid black;">Action</th>
					</thead>
				<?php foreach ($_SESSION["cart"] as $prod) {
					foreach ($products as $key => $val) {
						if ($products[$key]["id"] == $prod["id"]) {
							$product = $products[$key];
							break;
						}
					} ?>
					<tr>
						<td style="border:1px solid black;">
					<div id="product-<?php echo $prod["id"]; ?>" class="product">
						<img src="images/<?php echo $product["image"]; ?>">
						<a href="addToCart.php?id=<?php echo $prod["id"]; ?>&action=remove" class="removeBtn" title="Remove">X</a></td>
						<td style="border:1px solid black;"><h3 class="title"><a href="#"><?php echo $product["name"]; ?></a></h3></td>
						<td style="border:1px solid black;"><span>Price: $<?php echo $product["price"]; ?></span></td>
						<td style="border:1px solid black;"><span>
							Quantity : <?php echo $prod["quantity"]; ?>
						</span></td>
						<td style="border:1px solid black;"><span>Amount :$<?php echo ($product["price"] * $prod["quantity"]); ?></span></td>
						<td style="border:1px solid black;"><div>
							<form action="update.php" method="post">
								<input type="number" name="qty-<?php echo $prod['id']; ?>" id="">
								<input type="hidden" name="Prodid" value="<?php echo $prod['id']; ?>">
								<input type="submit" value="Add" name="submit">
							</form>
						</div></td>
					</div>
				<?php }
			} else { ?><?php
									} ?>
	         </tr>
          </table>									
		</div>
		<h3>Total Price: $<?php echo $amt; ?></h3><br>
		<button type="submit" style="margin-left: 40%;"><a href="addToCart.php?id=&action=empty">Empty</a></button>
	</div>
	<?php include "footer.php"; ?>
</body>

</html>