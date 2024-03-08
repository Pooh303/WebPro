<?php

// Query to retrieve sales data for the bar chart
$sqlBarChart = "SELECT * FROM `bill`;";

// Execute the queries and fetch data
// Execute the query and fetch data
$resultBarChart = mysqli_query($conn, $sqlBarChart);

// Check for errors
if (!$resultBarChart) {
    die("Error in SQL query: " . mysqli_error($conn));
}

// Process the retrieved data
$barChartLabels = [];
$barChartData = [];
while ($row = mysqli_fetch_assoc($resultBarChart)) {
    $barChartLabels[] = $row['Number_of_Customer'];
    $barChartData[] = $row['Price'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Meta tags, CSS, JavaScript imports -->
</head>
<body>
  <?php include 'sidebar.php'; ?>

  <div class="main--content">
    <?php include 'header.php'; ?>
    <div class="wrapper-box">
      <canvas id="myChart" class="graph"></canvas>
      <canvas id="doughnutChart" class="graph"></canvas>
    </div>
  </div>

  <script>
    // Bar chart data
    const barChartData = {
      labels: <?php echo json_encode($barChartLabels); ?>,
      datasets: [{
        label: 'Units Sold',
        data: <?php echo json_encode($barChartData); ?>,
        borderWidth: 4
      }]
    };

    // Doughnut chart data
    const doughnutChartData = {
      labels: <?php echo json_encode($doughnutChartLabels); ?>,
      datasets: [{
        label: 'Total Sales Amount',
        data: <?php echo json_encode($doughnutChartData); ?>,
        backgroundColor: [
          'rgb(255, 99, 132)',
          'rgb(54, 162, 235)',
          'rgb(255, 205, 86)'
        ],
        hoverOffset: 4
      }]
    };
  </script>
</body>
</html>
