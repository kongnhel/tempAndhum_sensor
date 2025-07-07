<?php
// Database connection info
include 'db.php';



// Query to get all sensor data
$sql = "SELECT * FROM sensor_data ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sensor Data Display</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f0f0f0;
        }
        h2 {
            text-align: center;
        }
        table {
            margin: auto;
            border-collapse: collapse;
            width: 80%;
            background-color: white;
        }
        th, td {
            padding: 10px 15px;
            border: 1px solid #ccc;
            text-align: center;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>

<h2>📊 Sensor Data Table</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Temperature (°C)</th>
        <th>Humidity (%)</th>
        <th>Timestamp</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
        // Output each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["temperature"] . "</td>";
            echo "<td>" . $row["humidity"] . "</td>";
            echo "<td>" . $row["created_at"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No data found</td></tr>";
    }
    ?>

</table>

</body>
</html>
