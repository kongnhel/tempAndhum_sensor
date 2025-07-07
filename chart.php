<?php

include'db.php';

// Get latest 20 records
$sql = "SELECT * FROM sensor_data ORDER BY created_at DESC LIMIT 100";
$result = $conn->query($sql);

$timestamps = [];
$temperatures = [];
$humidities = [];

while($row = $result->fetch_assoc()) {
    $timestamps[] = $row['created_at'];
    $temperatures[] = $row['temperature'];
    $humidities[] = $row['humidity'];
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Sensor Chart</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <h2>Temperature and Humidity Chart</h2>

  <canvas id="tempChart" width="600" height="300"></canvas>
  <canvas id="humidChart" width="600" height="300"></canvas>

  <script>
    const labels = <?php echo json_encode(array_reverse($timestamps)); ?>;
    const tempData = <?php echo json_encode(array_reverse($temperatures)); ?>;
    const humidData = <?php echo json_encode(array_reverse($humidities)); ?>;

    // Temperature Chart
    new Chart(document.getElementById('tempChart'), {
      type: 'line',
      data: {
        labels: labels,
        datasets: [{
          label: 'Temperature (°C)',
          data: tempData,
          borderColor: 'red',
          backgroundColor: 'rgba(255,0,0,0.1)',
          fill: true
        }]
      }
    });

    // Humidity Chart
    new Chart(document.getElementById('humidChart'), {
      type: 'line',
      data: {
        labels: labels,
        datasets: [{
          label: 'Humidity (%)',
          data: humidData,
          borderColor: 'blue',
          backgroundColor: 'rgba(0,0,255,0.1)',
          fill: true
        }]
      }
    });
  </script>
</body>
</html>
