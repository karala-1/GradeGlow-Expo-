<?php
// Incluir el archivo de conexión
include 'C:\xampp\htdocs\alogin\conextion.php';

session_start(); // Asegúrate de iniciar la sesión

// Consulta para obtener las notas de todos los alumnos
$sql = "SELECT s.student_id, s.fullname, n.nota1, n.nota2, n.nota3, n.nota4, n.nota5 
        FROM usertype s 
        JOIN notas_2 n ON s.student_id = n.student_id
        WHERE s.yearp = 2026"; // Ajusta las condiciones según lo necesites

$result = $con->query($sql);

if (!$result) {
    // Muestra el error si la consulta falla
    die("Error en la consulta SQL: " . $con->error);
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notas de los Estudiantes</title>
    <link rel="stylesheet" href="../pagina.css">
    <link rel="icon" type="image/jpg" href="media\logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <style>
        .student-container {
            margin-bottom: 30px;
        }

        .streak-container {
            text-align: center;
            background-color: #e9e9e9;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .streak {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .streak .circle {
            width: 40px;
            height: 40px;
            background-color: #fff;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            border: 2px solid #ccc;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Inglés - Notas de los Estudiantes</h2>
        </div>

        <?php 
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $fullname = $row['fullname'];
                $nota1 = $row["nota1"];
                $nota2 = $row["nota2"];
                $nota3 = $row["nota3"];
                $nota4 = $row["nota4"];
                $nota5 = $row["nota5"];

                // Cálculo de la nota final
                $final_grade = round(($nota1 + $nota2 + $nota3 + $nota4 + $nota5) / 5, 2);

                echo "<div class='student-container'>";
                echo "<h3>$fullname</h3>";
                echo "<div class='module-grades'>";
                echo "<div>Reading <br> $nota1</div>";
                echo "<div>Listening <br> $nota2</div>";
                echo "<div>Speaking <br> $nota3</div>";
                echo "<div>Writing <br> $nota4</div>";
                echo "<div>Class confidence <br> $nota5</div>";
                echo "<div>Final grade <br> $final_grade</div>";
                echo "</div>";

                // Calcular la racha (cantidad de notas >= 9.0)
                $streak = 0;
                if ($nota1 >= 9.0) $streak++;
                if ($nota2 >= 9.0) $streak++;
                if ($nota3 >= 9.0) $streak++;
                if ($nota4 >= 9.0) $streak++;
                if ($nota5 >= 9.0) $streak++;

                // Mostrar rachas
                echo "<div class='streak-container'>";
                echo "<h2>Mi racha</h2>";
                echo "<div class='streak'>";
                if ($streak > 0) {
                    for ($i = 1; $i <= $streak; $i++) {
                        echo "<div class='circle'>$i</div>";
                    }
                    echo "<p>¡FELICIDADES! Llevas $streak módulos de racha arriba de 9.0</p>";
                } else {
                    echo "<p>No tienes rachas activas.</p>";
                }
                echo "</div>"; // streak
                echo "</div>"; // streak-container
                echo "</div>"; // student-container
            }
        } else {
            echo "No se encontraron resultados.";
        }

        $con->close();
        ?>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</html>
