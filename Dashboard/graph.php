<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>สถิติ - ชาบูวาสนา</title>
  <link rel="icon" type="image/x-icon" href="../src/dashboard/dashboard.png">
  <link rel="stylesheet" href="style.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link href="../src/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<script src="../src/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
  <?php include 'sidebar.php'; ?>

  <div class="main--content">
    <?php include 'header.php'; ?>
    <div class="wrapper-box">
      <canvas id="myChart" class="graph"></canvas>
    </div>
    <div class="wrapper-box">
    <canvas id="doughnutChart" class="graph"></canvas>
    </div>
  </div>

  <script>
    // Bar chart data
    const barChartData = {
      labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
      datasets: [{
        label: '# of Votes',
        data: [12, 19, 3, 5, 2, 3],
        borderWidth: 4
      }]
    };

    // Doughnut chart data
    const doughnutChartData = {
      labels: ['Red', 'Blue', 'Yellow'],
      datasets: [{
        label: 'My First Dataset',
        data: [300, 50, 100],
        backgroundColor: [
          'rgb(255, 99, 132)',
          'rgb(54, 162, 235)',
          'rgb(255, 205, 86)'
        ],
        hoverOffset: 4
      }]
    };

    // Get canvas elements
    const ctx = document.getElementById('myChart');
    const doughnutCtx = document.getElementById('doughnutChart');

    new Chart(ctx, {
      type: 'bar',
      data: barChartData,
      options: {
        responsive: false,
        aspectRatio: 1,
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });

    new Chart(doughnutCtx, {
      type: 'doughnut',
      data: doughnutChartData,
      options: {
        responsive: false,
        aspectRatio: 1,
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>
</body>
</html>
