<?php
session_start();
$servername = "localhost";
$username = "sjyoon";
$password = "2022103991";
$database = "sjyoon";

// // Connect to database
$conn = new mysqli($servername, $username, $password, $database);

// // Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$member_id = $_SESSION['member_id'];


$sql = "DELETE FROM P_order WHERE 회원_id = ? ORDER BY 주문시간 DESC LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $member_id);

if ($stmt->execute()) {
    echo "Your order was successfully cancelled.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();


header('Location: cart.php');
exit();
?>
