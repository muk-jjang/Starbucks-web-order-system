<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST["id"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $gender = $_POST["gender"];
    $tel = $_POST["tel"];
    $email = $_POST["email"];

    // Validate and sanitize the data
    // Add your validation logic here

    // Connect to the database
    $servername = "localhost";
    $username = "sjyoon";
    $db_password = "2022103991";
    $dbname = "sjyoon";
    $conn = new mysqli($servername, $username, $db_password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check for duplicate ID
    $checkQuery = "SELECT * FROM P_member WHERE 회원_id = '$id'";
    $result = $conn->query($checkQuery);
    if ($result->num_rows > 0) {
        echo "<script>alert('이미 존재하는 ID입니다. 다른 ID를 사용해주세요!'); window.location.href = 'sign_up.htm';</script>";
    } else {
        // Prepare the SQL statement
        $sql = "INSERT INTO P_member (회원_id, 회원_password, 이름, 이메일, 성별, 전화번호) VALUES ('$id', '$password', '$name', '$email', '$gender', '$tel')";

        // Execute the SQL statement
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('정상적으로 가입되었습니다!'); setTimeout(function() { window.location.href = 'login.htm'; }, 500);</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    

    // Close the database connection
    $conn->close();
}
?>
