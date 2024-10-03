<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    



    <title>Document</title>
</head>
<body>
    
<div class="container mt-5">
        <h1 class="text-center mb-4">Tablas de registro de los sensores</h1>
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Temperatura</th>
                    <th scope="col">Humedad</th>
                    <th scope="col">Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                $host = 'autorack.proxy.rlwy.net';  // Host proporcionado por Railway
                $port = '32392';                     // Puerto para MySQL
                $db   = 'railway';                   // Nombre de la base de datos
                $user = 'root';                      // Usuario de la base de datos
                $pass = 'frGrkDAiHPWAYyZoxntPpAUSJLgksUJI';  // Contraseña proporcionada
                $charset = 'utf8';  
                
                // Conexión a la base de datos
                $conn = mysqli_connect($host, $user, $pass, $db, $port);

                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                $sql = "SELECT * FROM dht11 ORDER BY id DESC";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                            <td>" . htmlspecialchars($row["id"]) . "</td>
                            <td>" . htmlspecialchars($row["temperatura"]) . "</td>
                            <td>" . htmlspecialchars($row["humedad"]) . "</td>
                            <td>" . htmlspecialchars($row["datetime"]) . "</td>
                          </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center'>No hay registros</td></tr>";
                }

                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>

    <script>/*
    const ctx = document.getElementById('myChart').getContext('2d');
    const temperaturas = <?php echo json_encode($temperaturas); ?>;
    const humedades = <?php echo json_encode($humedades); ?>;
    const fechas = <?php echo json_encode($fechas); ?>;

    const myChart = new Chart(ctx, {
        type: 'line', // Puedes cambiar a 'bar' o 'pie' si lo prefieres
        data: {
            labels: fechas,
            datasets: [{
                label: 'Temperatura (°C)',
                data: temperaturas,
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 2,
                fill: false
            }, {
                label: 'Humedad (%)',
                data: humedades,
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2,
                fill: false
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });*/
</script>
</body>
</html>