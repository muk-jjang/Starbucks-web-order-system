<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/homestyle.css">
    <title>Shopping Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #00704A;
            padding: 10px;
            color: #FFF;
        }
        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }
        nav ul li {
            display: inline;
            margin-right: 10px;
        }
        nav ul li a {
            color: #FFF;
            text-decoration: none;
        }
        main {
            text-align: center;
            padding: 50px;
        }
        h1 {
            font-size: 36px;
            margin-bottom: 20px;
        }
        p {
            font-size: 18px;
            margin-bottom: 10px;
        }
        img {
            padding: 10px;
        }
        .login {
            display: inline-block;
            background-color: #00704A;
            color: #FFF;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 18px;
        }
        footer {
            background-color: #F5F5F5;
            height: 130px;
            padding: 20px;
            text-align: center;
            color: #999;
        }
        .align-center {
            text-align: center;
        }
        .cart-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #000;
            padding: 15px 0;
            margin-bottom: 10px;
        }
        .cart-item-info {
            display: flex;
            justify-content: space-between;
            padding: 10px;
        }
        .cart-item-info > * {
            margin-bottom: 5px;
            margin-right: 10px;
        }
        .cart-item h2 {
            margin: 0;
            font-size: 24px;
        }
        .cart-item p {
            margin: 0;
            font-size: 16px;
        }
        .cart-item .price {
            font-weight: bold;
        }
        .order-button {
            display: block;
            margin-top: 20px;
            background-color: #00704A;
            color: #FFF;
            padding: 10px 30px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
            margin: 0 auto;
        }
    </style>
</head>
<body>
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

    <main>
        <h1>Your Shopping Cart</h1>
<?php
session_start();

$servername = "localhost";
$username = "sjyoon";
$password = "2022103991";
$dbname = "sjyoon";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT 매장명 FROM P_store";
$result_store = $conn->query($sql);

$member_id = $_SESSION['member_id']; 

$sql = "SELECT * FROM P_cart WHERE 회원_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $member_id); 
$stmt->execute();
$result = $stmt->get_result();

$total_price = 0;

while ($item = $result->fetch_assoc()) {
    echo "<div class='cart-item'>";
    echo "<div class='cart-item-info'>";
    echo "<h2>". $item["제품명"]. "</h2>";
    echo "<p class='price'>Price: $" . $item['가격'] . "</p>";
    echo "<p>Syrup: " . $item['syrup'] . "</p>";
    echo "<p>Water: " . $item['water'] . "</p>";
    echo "<p>Size: " . $item['size'] . "</p>";
    echo "<p>Cup: " . $item['cup'] . "</p>";
    echo "</div>";
		echo "<form action='remove_from_cart.php' method='post'>";
		echo "<input type='hidden' name='제품명' value='" . $item["제품명"] . "'>";
		echo "<input type='hidden' name='syrup' value='" . $item['syrup'] . "'>";
		echo "<input type='hidden' name='water' value='" . $item['water'] . "'>";
		echo "<input type='hidden' name='size' value='" . $item['size'] . "'>";
		echo "<input type='hidden' name='cup' value='" . $item['cup'] . "'>";
		echo "<input type='submit' value='Delete'>";
		echo "</form>";
    echo "</div>";
    $total_price += $item['가격'];
}

echo "<h2>Total Price: $" . $total_price . "</h2>";

$conn->close();
?>


        <form action="order.php" method="post">
            <label for="store">Pickup Store:</label>
            <select id="store" name="store">
                <?php while ($row = $result_store->fetch_assoc()) : ?>
                    <option value="<?php echo $row['매장명']; ?>"><?php echo $row['매장명']; ?></option>
                <?php endwhile; ?>
            </select>
            <br><br>
            <input class="order-button" type="submit" value="Place Order">
        </form>
    </main>

    <footer>
        <div class="info">
            <span>사업자등록번호 201-81-21515</span><br>
            <span>(주)스타벅스 코리아 대표이사 손정현</span><br>
            <span>TEL : 1522-3232</span><br>
            <span>개인정보 책임자 : 이찬우</span>
        </div>
    </footer>
</body>
</html>
