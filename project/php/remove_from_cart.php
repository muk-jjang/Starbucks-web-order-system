<?php
session_start();

// Database connection
$servername = "localhost";
$username = "sjyoon";
$password = "2022103991";
$database = "sjyoon";
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if(isset($_SESSION['member_id'], $_POST["제품명"])) {


    $member_id = $_SESSION['member_id'];
    $item_name = $_POST["제품명"];


    $syrup = isset($_POST['syrup']) ? $_POST['syrup'] : null;
    $water = isset($_POST['water']) ? $_POST['water'] : null;
    $size = isset($_POST['size']) ? $_POST['size'] : null;
    $cup = isset($_POST['cup']) ? $_POST['cup'] : null;

    $sql = "DELETE FROM P_cart WHERE 회원_id = ? AND 제품명 = ? AND (syrup = ? OR syrup IS NULL) AND (water = ? OR water IS NULL) AND (size = ? OR size IS NULL) AND (cup = ? OR cup IS NULL)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $member_id, $item_name, $syrup, $water, $size, $cup);

    if ($stmt->execute()) {
        echo "Item has been deleted from the cart successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

} else {
    echo "All necessary parameters to delete an item are not set.";
}

// Redirect to the cart page
header('Location: cart.php');
?>
