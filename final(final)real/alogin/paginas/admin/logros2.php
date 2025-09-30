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

// Obtener el nombre de búsqueda del formulario
$search_name = isset($_POST['search_name']) ? $_POST['search_name'] : '';

// Consulta para obtener los datos y notas del estudiante
$sql = "SELECT u.fullname, a.avgEnglish, a.avgComputing, a.avgValues, a.avgADOC
        FROM usertype u
        LEFT JOIN avarge a ON u.student_id = a.student_id
        WHERE u.yearp = 2025";

// Si se proporciona un nombre para buscar, agrega la condición a la consulta
if (!empty($search_name)) {
    $sql .= " AND u.fullname LIKE '%$search_name%'";
}

$result = $con->query($sql);

if (!$result) {
    die("Error en la consulta SQL: " . $con->error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notas del Alumno</title>
    <link rel="stylesheet" href="../pagina.css">
    <link rel="icon" type="image/logo.ico" href="media\logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<header>
    <div class="TituloGG"></div>
    <nav class="navbar">
        <a href="../misLogros.php">
            <button class="btn-logros">Mis Logros</button>
        </a>
        <a href="../cerrarSesion.php">
            <button class="btn-promedios">Cerrar sesión</button>
        </a> 
    </nav>
</header>

<body>
    <div class="container">
        <div class="header">
            <center><h2>Bienvenido "<?php echo htmlspecialchars($_SESSION['fullname']); ?>"</h2></center><br><br><br><br>
        </div>

        <!-- Formulario de búsqueda -->
        <form method="POST" action="" class="POSTSERCH">
            <label for="search_name" class="serch">Buscar estudiante:</label>
            <input type="text" id="search_name" name="search_name" placeholder="Ingrese el nombre" class="label">
            <button type="submit" class="buttonSerch">Buscar</button>
        </form>

        <!-- Resultados de la búsqueda -->
        <?php 
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $fullname = htmlspecialchars($row["fullname"]);
                $avgEnglish = isset($row["avgEnglish"]) ? $row["avgEnglish"] : "No disponible";
                $avgComputing = isset($row["avgComputing"]) ? $row["avgComputing"] : "No disponible";
                $avgValues = isset($row["avgValues"]) ? $row["avgValues"] : "No disponible";
                $avgADOC = isset($row["avgADOC"]) ? $row["avgADOC"] : "No disponible";

                echo "<h2>$fullname</h2>";
                echo "<div class='module-grades'>";
                echo "<h3>Inglés</h3><div>$avgEnglish</div><br>";
                echo "<h3>Informática</h3><div>$avgComputing</div><br>";
                echo "<h3>Valores</h3><div>$avgValues</div><br>";
                echo "<h3>Promedio ADOC</h3><div>$avgADOC</div><br>";
                echo "</div><hr>";
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
