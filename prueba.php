<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database = "sensor";

$conn = mysqli_connect($hostname, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Conexión a la base de datos exitosa<br>";

if (isset($_POST["temperaturaDHT"]) && isset($_POST["humedad"]) && isset($_POST["temperaturaLM35"])) {
    $tDHT = $_POST["temperaturaDHT"];
    $h = $_POST["humedad"];
    $tLM35 = $_POST["temperaturaLM35"];

    // Insertar datos en la tabla dht11
    $sqlDHT = "INSERT INTO dht11 (temperature, humidity) VALUES ($tDHT, $h)";
    if (mysqli_query($conn, $sqlDHT)) {
        echo "<br>Nueva creación exitosa en la tabla dht11";
    } else {
        echo "Error en dht11: " . $sqlDHT . "<br>" . mysqli_error($conn);
    }

    // Insertar datos en la tabla lm35
    $sqlLM35 = "INSERT INTO lm35 (temperature) VALUES ($tLM35)";
    if (mysqli_query($conn, $sqlLM35)) {
        echo "<br>Nueva creación exitosa en la tabla lm35";
    } else {
        echo "Error en lm35: " . $sqlLM35 . "<br>" . mysqli_error($conn);
    }
} else {
    echo "Datos no recibidos.";
}

mysqli_close($conn); // Cerrar la conexión a la base de datos
?>
