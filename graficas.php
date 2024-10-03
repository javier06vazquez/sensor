<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Gráfica de Temperatura y Humedad</title>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Graficas de los sensores</h1>

        <!-- Canvas para la gráfica -->
        <canvas id="myChart" width="400" height="200"></canvas>

        <table class="table table-striped mt-4">
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
                die("Error de conexión: " . mysqli_connect_error());
            }

            // Consulta para obtener los datos
            $sql = "SELECT * FROM dht11 ORDER BY id DESC";
            $result = mysqli_query($conn, $sql);

            // Inicializar arreglos para almacenar los datos
            $temperaturas = [];
            $humedades = [];
            $fechas = [];

            // Procesar los datos
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    // Almacenar los datos para la gráfica
                    $temperaturas[] = $row["temperatura"];
                    $humedades[] = $row["humedad"];
                    $fechas[] = $row["datetime"];
                }
            } else {
                echo "<tr><td colspan='4' class='text-center'>No hay registros</td></tr>";
            }

            mysqli_close($conn);
            ?>
            </tbody>
        </table>
    </div>


    <script>
        //Obtener el contexto del canvas para dibujar la gráfica
        const ctx = document.getElementById('myChart').getContext('2d');

        // Obtener los datos desde PHP en formato JSON
        const temperaturas = <?php echo json_encode($temperaturas); ?>;
        const humedades = <?php echo json_encode($humedades); ?>;
        const fechas = <?php echo json_encode($fechas); ?>;

        const formattedFechas = fechas.map(fecha => {
            const date = new Date(fecha);
            return `${date.getDate().toString().padStart(2, '0')} ${date.toLocaleString('default', { month: 'long' })} ${date.getFullYear()}`;
        });

        // Crear la gráfica

        const myChart = new Chart(ctx, {
            type: 'line', // Tipo de gráfica
            data: {
                labels: fechas,
                datasets: [{
                        label: 'Temperatura (°C)',
                        data: temperaturas,
                        Tension: 1,
                        borderColor: 'rgba(255, 99, 132, 1)',
                        pointBorderColor: 'red',
                        backgroundColor: 'rgba(255, 99, 132, 0.4)',
                        fill: true,
                    },
                    {
                        label: 'Humedad (%)',
                        data: humedades,
                        Tension: 1,
                        borderColor: 'rgba(54, 162, 235, 1)',
                        pointBorderColor: 'blue',
                        backgroundColor: 'rgba(54, 162, 235, 0.4)',
                        fill: true,
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Valores'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Fecha y Hora'
                        }
                    }
                }
            }
        });

        /*const myChart = new Chart(ctx, {
            type: 'line', // Tipo de gráfica
            data: {
                labels: fechas, // Etiquetas del eje X
                datasets: [
                    {
                        label: 'Temperatura (°C)',
                        data: temperaturas, // Datos de temperatura
                        borderColor: 'rgba(255, 99, 132, 1)',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        fill: true,
                    },
                    {
                        label: 'Humedad (%)',
                        data: humedades, // Datos de humedad
                        borderColor: 'rgba(54, 162, 235, 1)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        fill: true,
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Valores'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Fecha y Hora'
                        }
                    }
                }
            }
        });*/
    </script>

</body>

</html>