<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>สถานะอาหาร</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <nav class="navbar">
    <div class="container">
    <?php
    $table_id = isset($_GET['json_Table_ID']) ? $_GET['json_Table_ID'] : null;
    $session_id = isset($_GET['json_session_id']) ? $_GET['json_session_id'] : null;
    echo "<a class=\"navbar-brand\" href='index.php?json_Table_ID=" . $table_id . "&json_session_id=" . $session_id . "'>";
            ?>

        สั่งอาหาร</a>
      <!-- <a class="navbar-brand" href="#">ประวัติการสั่งซื้อ</a> -->
    </div>
  </nav>
  <div class="background-order">
    <div class="container mt-4">
      <h2 class="text-center mb-4">ประวัติการสั่งซื้อ</h2>
      <div id="orders" class="row">
        <?php
        // Database connection
        $servername = "10.30.9.139";
        $port = 3306;
        $username = "root";
        $password = "root";
        $database = "shabu";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $database, $port);

        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
        

       function createOrderCard($order) {
          $statusClass = strtolower(str_replace(" ", "-", $order['Order_status']));
          $container = "<div class='card " . $statusClass . "'>";
          $container .= "<div class='card-body'>";
          $container .= "<h5 class='card-title'>การสั่งซื้อที่ #" . $order['Order_ID'] . "</h5>";
          $container .= "<p class='card-text'>";
          // Convert 'Data' string to JSON array
          $dataArray = json_decode($order['Data'], true);
          // Check if 'Data' is a valid JSON array
          if ($dataArray) {
              // Iterate through each product in the JSON array
              foreach ($dataArray as $product) {
                  $container .= "<div class='d-flex justify-content-between'>";
                  $container .= "<div>" . $product['name'] . "</div>";
                  $container .= "<div>X " . $product['amount'] . "</div>";
                  $container .= "</div>";
              }
          } else {
              // Handle case when 'Data' is not a valid JSON array
              $container .= "Data: " . $order['Data'];
          }
          // Add Status
          $container .= "<br>สถานะ : " . $order['Order_status'] . "</p>";
          $container .= "</div>"; // Close card-body div
          $container .= "</div>"; // Close card div
          return $container;
      }

        // Query to fetch orders for a specific table from the database
        $sql = "SELECT Order_ID, Table_ID, Order_status, Data FROM `Order` WHERE Table_ID = '$table_id' ORDER BY Order_ID DESC;";
        $result = $conn->query($sql);

        if ($result) {
          // Check if there are any rows returned
          if ($result->num_rows > 0) {
            // Iterate through orders and create HTML elements
            while($row = $result->fetch_assoc()) {
              echo createOrderCard($row);
            }
          } else {
            echo "No orders found for this table.";
          }
        } else {
          // Display error message if query fails
          echo "Error retrieving orders: " . $conn->error;
        }

        // Close connection
        $conn->close();
        ?>
      </div>
    </div>
  </div>
</body>
</html>
