<?php
$host = 'autorack.proxy.rlwy.net';  // Host proporcionado por Railway
$port = '32392';                    // Puerto para MySQL (por defecto es 3306)
$db   = 'railway';                 // Nombre de la base de datos
$user = 'root';                    // Usuario de la base de datos
$pass = 'frGrkDAiHPWAYyZoxntPpAUSJLgksUJI';  // Contraseña proporcionada
$charset = 'utf8';                 // Conjunto de caracteres

// Cambiar el DSN para MySQL
$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";

try {
    // Crear una nueva conexión PDO para MySQL
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Conexión exitosa a la base de datos MySQL.";
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>