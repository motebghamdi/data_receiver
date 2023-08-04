<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $temperature = $_POST["temperature"];
  $humidity = $_POST["humidity"];

  // Store the data in the SQLite database (you may use MySQL or any other database)
  $db = new SQLite3('data.db');
  if (!$db) {
    die("Failed to connect to the database.");
  }

  $createTableQuery = "CREATE TABLE IF NOT EXISTS sensor_data (
                          id INTEGER PRIMARY KEY AUTOINCREMENT,
                          temperature REAL NOT NULL,
                          humidity REAL NOT NULL
                      )";
  $db->exec($createTableQuery);

  $insertDataQuery = "INSERT INTO sensor_data (temperature, humidity) VALUES ('$temperature', '$humidity')";
  $db->exec($insertDataQuery);
  $db->close();
}
?>
