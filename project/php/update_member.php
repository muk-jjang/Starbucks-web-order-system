<?php
session_start();
$servername = "localhost";
$username = "sjyoon";
$password = "2022103991";
$database = "sjyoon";

// Connect to database
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['id'];
$currentPassword = $_POST['currentPassword'];
$newPassword = $_POST['newPassword'];

// Check if the current password is correct
$sql = "SELECT * FROM P_member WHERE 회원_id = ? AND 회원_password = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Failed to prepare SQL query: " . $conn->error);
}
$stmt->bind_param("ss", $id, $currentPassword);
if (!$stmt->execute()) {
    die("Failed to execute SQL query: " . $stmt->error);
}

// Get the result object
$result = $stmt->get_result();
if ($result === false) {
    die("Failed to get result: " . $stmt->error);
}

// Now you can use num_rows:
if ($result->num_rows == 0) {
    echo "The current password is incorrect.";
    exit();
}


// Update the password
$sql = "UPDATE P_member SET 회원_password = ? WHERE 회원_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $newPassword, $id);

if ($stmt->execute()) {
 		echo "<script type='text/javascript'>alert('회원정보가 수정되었습니다.'); setTimeout(function() { window.location.href = 'login.htm'; }, 500);</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

//header('Location: profile.php');
exit();
?>
