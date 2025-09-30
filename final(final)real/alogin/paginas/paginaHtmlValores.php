<?php
// Incluir el archivo de conexión
include 'C:\xampp\htdocs\alogin\conextion.php';

session_start(); // Asegúrate de iniciar la sesión


$student_id = $_SESSION['student_id'];

// Consulta para obtener las notas del alumno
$sql = "SELECT * FROM notas_3 WHERE student_id = '$student_id'";
$result = $con->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notas del Alumno</title>
    <link rel="stylesheet" href="pagina.css">
    <link rel="icon" type="image/jpg" href="media\logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <style>
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

<header>
        
        <div class="TituloGG">
          
        </div>
        <nav class="navbar">
          
          <a href="promedios.php">
              <button class="btn-promedios">Mis promedios</button>
          </a>
          <a href="misLogros.php">
              <button class="btn-logros">Mis Logros</button>
          </a>
          <a href="cerrarSesion.php">
              <button class="btn-logros">Cerrar sesión</button>
          </a>
          <!-- <a href="cuenta\cerrarSesion.php" class="btn btn-danger">Cerrar sesión</a> -->
      </nav>
      
</header>

<body>
    <div class="container">
        <div class="header">
            <!-- <h2>Valores</h2> -->
            <center><h2>Bienvenido "<?php echo $_SESSION['fullname']; ?>"</h2></center><br><br><br><br>
        </div>

        <!-- <div class="year-selection">
            <button>Primer año</button>
            <button>Segundo año</button>
            <button>Tercer año</button>
        </div> -->

        <h2>Módulo 1</h2>
        <div class="module-grades">
            <?php 
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $nota1 = $row["nota1"];
                $nota2 = $row["nota2"];
                $nota3 = $row["nota3"];


                // Cálculo de la nota final
                $final_grade = round(($nota1 + $nota2 + $nota3) / 3, 2);
                
                echo "<div>Exposición <br> $nota1</div>";
                echo "<div>Ensayo <br> $nota2</div>";
                echo "<div>Practica de valores <br> $nota3</div>";
                echo "<div>Final grade <br> $final_grade</div>";
            } else {
                echo "No se encontraron resultados.";
            }

           
            ?>
        </div>

        <h2>Módulo 2</h2>
        <!-- Aquí podrías agregar más módulos o contenido -->
    </div>

  <!-- Sección de rachas -->
  <div class="streak-container">
            <h2>Mi racha</h2>
            <div id="streak" class="streak">
                <?php
                // Calcular la racha (cantidad de notas >= 9.0)
                $streak = 0;
                if ($nota1 >= 9.0) $streak++;
                if ($nota2 >= 9.0) $streak++;
                if ($nota3 >= 9.0) $streak++;


                // Mostrar círculos según la racha
                if ($streak > 0) {
                    for ($i = 1; $i <= $streak; $i++) {
                        echo "<div class='circle'>$i</div>";
                    }
                    echo "<p>¡FELICIDADES! Llevas $streak módulos de racha arriba de 9.0</p>";
                } else {
                    echo "<p>No tienes rachas activas.</p>";
                }

                ?>
            </div>
        </div>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</html>

<?php
$con->close(); 
?>
