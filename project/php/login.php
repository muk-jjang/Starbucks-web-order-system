<?php
session_start();
    // configuration
    $host = 'localhost';
    $db   = 'sjyoon';
    $user = 'sjyoon';
    $pass = '2022103991';

    // create connection
    $conn = new mysqli($host, $user, $pass, $db);

    // check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Take care to make sure these inputs are sanitized
    $id = $_POST['id'];  // Match this with the name attribute of your input tag
    $password = $_POST['password'];  // Match this with the name attribute of your input tag

    // create SQL query string
    $sql = sprintf(
        "SELECT * FROM P_member WHERE 회원_id='$id' AND 회원_password='$password'",
        mysqli_real_escape_string($conn, $id),
        mysqli_real_escape_string($conn, $password)
    );

    // execute query and get result
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    		$_SESSION['member_id'] = $id;
        // login successful - redirect to menu.html
        header('Location: menu.php');
        exit();
    } else {
        // login failed - display an error message
        echo "<script type='text/javascript'>alert('로그인 정보가 없습니다'); setTimeout(function() { window.location.href = 'login.htm'; }, 500);</script>";
		}

    // close connection
    $conn->close();
?>
