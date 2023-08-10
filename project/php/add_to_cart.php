<?php
session_start();
$servername = "localhost";
$username = "sjyoon";
$password = "2022103991";
$database = "sjyoon";
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $member_id = $_SESSION['member_id']; 
    $item_id = $_POST['제품_id'];
    $item_name = $_POST["제품명"];
    $price = $_POST["가격"];
    $syrup = $_POST['syrup'];
    $water = $_POST['water'];
    $size = $_POST['size'];
    $cup = $_POST['cup'];

    // Insert into database
    $sql = "INSERT INTO P_cart (회원_id, 제품_id, 제품명, 가격, syrup, water, size, cup) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisissss", $member_id, $item_id, $item_name, $price, $syrup, $water, $size, $cup);


	if ($stmt->execute()) {
    	$_SESSION['Cart_num'] = $conn->insert_id; // Get last inserted id
    	echo "Item added to cart successfully";
	} else {
    	echo "Error: " . $stmt->error;
}

}

// Redirect to the cart page
header('Location: menu.php');
