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
// Establish a database connection
$servername = "localhost";
$username = "sjyoon";
$password = "2022103991";
$dbname = "sjyoon";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve store data
$sql = "SELECT 매장명, 주소, 위도, 경도, 전화번호, 리뷰 FROM P_store";
$result = $conn->query($sql);

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/store_info_new.css">
    <title>Starbucks Store List</title>
</head>
<body>
    <div class="content">
        <h1 class="title">Starbucks Store List</h1>

        <?php if ($result->num_rows > 0) : ?>
            <table>
                <tr>
                    <th>매장명</th>
                    <th>주소</th>
                    <th>위도</th>
                    <th>경도</th>
                    <th>전화번호</th>
                    <th>리뷰</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $row["매장명"]; ?></td>
                        <td><?php echo $row["주소"]; ?></td>
                        <td><?php echo $row["위도"]; ?></td>
                        <td><?php echo $row["경도"]; ?></td>
                        <td><?php echo $row["전화번호"]; ?></td>
                        <td><?php echo $row["리뷰"]; ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else : ?>
            <p>No stores found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
