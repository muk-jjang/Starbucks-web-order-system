<!DOCTYPE html>
<html>
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
<script>
    function toggle(itemId) {
      var itemInfo = document.getElementById(itemId);
      if (itemInfo.style.display === "none") {
        itemInfo.style.display = "block";
      } else {
        itemInfo.style.display = "none";
      }
    }
</script>
<head>
		<meta charset='UTF-8'>
     <style>
        body {
            background-color: #006241;
            color: #fff;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 900px;
            margin: auto;
            padding: 20px;
        }
        .menu-item {
            border-bottom: 1px solid #fff;
            padding: 10px 0;
        }
        .menu-item h2 {
            margin: 0;
            font-size: 24px;
        }
        .menu-item p {
            margin: 0;
            font-size: 16px;
        }
        .menu-item .price {
            float: right;
            font-weight: bold;
        }
        .button {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px;
            background-color: #fff;
            color: #006241;
            font-size: 18px;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
		
    <div class="container">
        <?php
        $servername = "localhost";
        $username = "sjyoon";
        $password = "2022103991";
        $database = "sjyoon";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // SQL to fetch menu items
        $sql = "SELECT * FROM P_product";
        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                if($row["카테고리_id"]==1){
    								echo "<div class='menu-item' id='item" . $row['제품_id'] . "'>";
    								echo "<h2 onclick='toggle(\"info" . $row['제품_id'] . "\")'>" . $row['제품명'] ." (" . $row["제품명_영문"]. ")</h2>";
    								echo "<div id='info" . $row['제품_id'] . "' style='display: none;'>";
    									echo "<p>" . $row['제품소개'] . "</p>";
    									echo "<p> Price: $" . $row['가격'] . "</p>";
										echo "<form action='add_to_cart.php' method='post'>";
										echo "<input type='hidden' name='제품_id' value='" . $row['제품_id'] . "'>";
										echo "<input type='hidden' name='제품명' value='". $row ['제품명']. "'>";
										echo "<input type='hidden' name='가격' value='" . $row['가격'] . "'>";
										echo "<div class='options select-left'>";
											echo "<label for='syrup'>시럽:</label>";
												echo "<select id='syrup' name='syrup'>";
													echo "<option value='vanilla'>바닐라시럽</option>";
													echo "<option value='caramel'>카라멜시럽</option>";
													echo "<option value='hazelnut'>헤이즐넛시럽</option>";
											echo "</select>";
										echo "</div>";
										echo "<div class='options select-left'>";
											echo "<label for='water'>물:</label>";
												echo "<select id='water' name='water'>";
													echo "<option value='no-water'>물 없음</option>";
													echo "<option value='light'>물 적게</option>";
													echo "<option value='normal'>물 보통</option>";
													echo "<option value='extra'>물 많이</option>";
												echo "</select>";
										echo "</div>";
										echo "<div class='options select-left'>";
											echo "<label for='size'>사이즈:</label>";
												echo "<select id='size' name='size'>";
													echo "<option value='tall'>Tall 355ml</option>";
													echo "<option value='grande'>Grande 473ml</option>";
													echo "<option value='venti'>Venti 591ml</option>";
												echo "</select>";
										echo "</div>";
										echo "<div class='options select-left'>";
											echo "<label for='cup'>cup:</label>";
												echo "<select id='cup' name='cup'>";
													echo "<option value='plastic'>매장컵</option>";
													echo "<option value='personal'>개인컵</option>";
													echo "<option value='paper'>일회용컵컵</option>";
												echo "</select>";		
										echo "</div>";																																						
											echo "<input type='submit' value='Order'>";
											echo "</form>";
										echo "</div>";	
										echo "</div>";

                } else if($row["카테고리_id"]==2){
    								echo "<div class='menu-item' id='item" . $row['제품_id'] . "'>";
    								echo "<h2 onclick='toggle(\"info" . $row['제품_id'] . "\")'>" . $row['제품명'] ." (" . $row["제품명_영문"]. ")</h2>";
    								echo "<div id='info" . $row['제품_id'] . "' style='display: none;'>";
    								echo "<p>" . $row['제품소개'] . "</p>";
    								echo "<p> Price: $" . $row['가격'] . "</p>";
    								echo "<form action='add_to_cart.php' method='post'>";
    									echo "<input type='hidden' name='제품_id' value='" . $row['제품_id'] . "'>";
   								  	echo "<input type='hidden' name='제품명' value='" . $row['제품명'] . "'>";
    									echo "<input type='hidden' name='가격' value='" . $row['가격'] . "'>";
    									echo "<input type='submit' value='Order'>";
    								echo "</form>";
    								echo "</div>";
    								echo "</div>"; 
               } else if($row["카테고리_id"] == 3){
    								echo "<div class='menu-item' id='item" . $row['제품_id'] . "'>";
    								echo "<h2 onclick='toggle(\"info" . $row['제품_id'] . "\")'>" . $row['제품명'] ." (" . $row["제품명_영문"]. ")</h2>";
    								echo "<div id='info" . $row['제품_id'] . "' style='display: none;'>";
    								echo "<p>" . $row['제품소개'] . "</p>";
    								echo "<p> Price: $" . $row['가격'] . "</p>";
    								echo "<form action='add_to_cart.php' method='post'>";
    								echo "<input type='hidden' name='제품_id' value='" . $row['제품_id'] . "'>";
   								  echo "<input type='hidden' name='제품명' value='" . $row['제품명'] . "'>";
    								echo "<input type='hidden' name='가격' value='" . $row['가격'] . "'>";
    								echo "<input type='submit' value='Order'>";
    								echo "</form>";
    								echo "</div>";
    								echo "</div>";
               }
            }
        } else {
            echo "No results";
        }
        $conn->close();
        ?>
        <a href="cart.php" class="button">Go to Cart</a>
    </div>
</body>
</html>
