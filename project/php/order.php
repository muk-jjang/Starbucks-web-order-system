<?php
session_start();

// Connect to database
$servername = "localhost";
$username = "sjyoon";
$password = "2022103991";
$database = "sjyoon";
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$member_id = $_SESSION['member_id'];
$store_name = $_POST['store'];


$sql = "SELECT COUNT(*) as count, SUM(가격) as total_price FROM P_cart WHERE 회원_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $member_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$count = $row['count'];
$total_price = $row['total_price'];

if ($count > 0) {
    $sql = "INSERT INTO P_order (회원_id, 매장명, 최종금액) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $member_id, $store_name, $total_price);

    if ($stmt->execute()) {
        echo "New record created successfully";
        $_SESSION['order_confirmed'] = true;
        $_SESSION['pickup_store'] = $store_name;
        // Clear the cart
        $sql = "DELETE FROM P_cart WHERE 회원_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $member_id);
        $stmt->execute();
        // Redirect to order confirmation page
        header('Location: order_confirmation.php');
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
} else {
    echo "<script type='text/javascript'>alert('장바구니에 담긴 메뉴가 없습니다.'); window.location.href = 'menu.php';</script>";
    exit();
}

$conn->close();
?>
