<link rel="stylesheet" href="css/homestyle.css">
  <header>
        <nav>
            <ul>
                <li><a href="menu.php">Menu</a></li>
                <li><a href="store_info.php">Locations</a></li>
                <li><a href="starbucks_info.htm">Introduce</a></li>
                <li><a href="cart.php">Cart</a></li>
            </ul>
        </nav>
    </header>
<?php
session_start();

if (!isset($_SESSION['order_confirmed']) || !$_SESSION['order_confirmed']) {
    // If no order was confirmed, redirect to home page
    header('Location: index.php');
    exit();
}

$pickup_store = $_SESSION['pickup_store'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
<style>
        body {
            text-align: center;
        }
        header nav {
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Thank you for your order!</h1>
    <p>Your order has been successfully placed. Please pick it up at <?php echo $pickup_store; ?>.</p>
    <form action="cancel_order.php" method="post">
    <input type="submit" value="Cancel Order">
		</form>

</body>
</html>
