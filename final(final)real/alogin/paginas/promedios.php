<?php
// Incluir el archivo de conexión
include 'C:\xampp\htdocs\alogin\conextion.php';

session_start(); // Asegúrate de iniciar la sesión

// Desactivar el cache del navegador para evitar que el usuario vuelva atrás después de cerrar sesión
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.

// Verifica si la sesión de usuario está activa
if (!isset($_SESSION['student_id'])) {
    // Si no hay sesión activa, redirige al login
    header("Location: loginhtml.php");
    exit;
}

if (isset($_SESSION['student_id'])) {
    $student_id = $_SESSION['student_id'];
} else {
    echo "Error: ID del estudiante no encontrado en la sesión.";
    exit;
}

if (isset($_SESSION['fullname'])) {
    $fullname = $_SESSION['fullname'];
} else {
    $fullname = "Usuario desconocido";
}

// Consulta para obtener las notas del alumno
$sql = "SELECT * FROM avarge WHERE student_id = '$student_id'";
$result = $con->query($sql);
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notas del Alumno</title>
    <link rel="stylesheet" href="pagina.css">
    <link rel="icon" type="image/logo.ico" href="media\logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<header>
        
        <div class="TituloGG">
          
        </div>
        <nav class="navbar">
          
          <!-- <a href="paginas\promedios.php">
          <button class="btn-clases">Mis clases</button>
          </a> -->
          <a href="misLogros.php">
              <button class="btn-logros">Mis Logros</button>
          </a>
          <a href="cerrarSesion.php">
            <button class="btn-promedios">Cerrar sesión</button>
            </a> 

      </nav>
      
</header>

<body>
    <div class="container">
        <div class="header">
            <!-- <h2>Mis promedios</h2> -->
            <center><h2>Bienvenido "<?php echo htmlspecialchars($fullname); ?>"</h2></center><br><br><br><br>
        </div>

        <h2>Inglés</h2>
        <div class="module-grades">
            <?php 
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $avgEnglish = isset($row["avgEnglish"]) ? $row["avgEnglish"] : "No disponible";
                echo "<div>Módulo 1<br> $avgEnglish</div>";
            } else {
                echo "No se encontraron resultados.";
            }
            ?>
        </div>

        <h2>Informática</h2>
        <div class="module-grades2">
            <?php 
            // Es necesario realizar una nueva consulta para obtener los datos restantes
            $result->data_seek(0); // Reinicia el puntero a la primera fila
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $avgComputing = isset($row["avgComputing"]) ? $row["avgComputing"] : "No disponible";

                echo "<div><br> $avgComputing</div>";
            } else {
                echo "No se encontraron resultados.";
            }
            ?>
        </div>

        <h2>Valores</h2>
        <div class="module-grades">
            <?php 
            // Es necesario realizar una nueva consulta para obtener los datos restantes
            $result->data_seek(0); // Reinicia el puntero a la primera fila
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $avgValues = isset($row["avgValues"]) ? $row["avgValues"] : "No disponible";

                echo "<div><br> $avgValues</div>";
            } else {
                echo "No se encontraron resultados.";
            }
            ?>
        </div>

        <h2>Promedio ADOC</h2>
        <div class="module-grades2">
            <?php 
            // Es necesario realizar una nueva consulta para obtener los datos restantes
            $result->data_seek(0); // Reinicia el puntero a la primera fila
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $avgADOC = isset($row["avgADOC"]) ? $row["avgADOC"] : "No disponible";

                echo "<div><br> $avgADOC</div>";
            } else {
                echo "No se encontraron resultados.";
            }
            ?>

        </div>
       
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</html>
