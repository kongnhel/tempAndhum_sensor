<?php
include 'db.php'; // Include database connection
$temperature = $_GET['temp'] ?? null;
$humidity = $_GET['hum'] ?? null;

if ($temperature && $humidity) {
    $conn = new mysqli("localhost","root", "", "sensor_db");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $created_at = date('Y-m-d H:i:s');
    $stmt = $conn->prepare("INSERT INTO sensor_data (temperature, humidity, created_at) VALUES (?, ?, ?)");
    $stmt->bind_param("dds", $temperature, $humidity, $created_at);
    $stmt->execute();

    echo "Data inserted.";
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid data.";
}
?>
