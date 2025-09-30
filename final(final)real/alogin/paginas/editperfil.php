<?php
// Incluir el archivo de conexión
include 'C:\xampp\htdocs\alogin\conextion.php';

// Verificar si se ha proporcionado un ID de estudiante
if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];

    // Consultar los datos del estudiante
    $sql = "SELECT * FROM usertype WHERE student_id = $student_id";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $student = mysqli_fetch_assoc($result);
    } else {
        echo "Estudiante no encontrado.";
        exit();
    }
} else {
    echo "ID de estudiante no proporcionado.";
    exit();
}

// Actualizar datos si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = trim($_POST['fullname']);
    $passwords = trim($_POST['passwords']);

    // Validar campos
    if (empty($fullname) || empty($passwords)) {
        echo "Todos los campos son requeridos.";
    } else {
        // Actualizar la base de datos
        $sql = "UPDATE usertype SET fullname = ?, passwords = ? WHERE student_id = ?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "ssi", $fullname, $passwords, $student_id);

        if (mysqli_stmt_execute($stmt)) {
            echo "Datos actualizados correctamente.";
        } else {
            echo "Error al actualizar los datos: " . mysqli_error($con);
        }

        mysqli_stmt_close($stmt);
    }
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="es">
    
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
</head>
<body>
    <h2>Editar Nombre de Usuario y Contraseña</h2>
    <form method="POST" action="">
        <label for="fullname">Nombre de Usuario:</label><br>
        <input type="text" name="fullname" value="<?php echo htmlspecialchars($student['fullname']); ?>"><br><br>

        <label for="passwords">Nueva Contraseña:</label><br>
        <input type="password" name="passwords" value="<?php echo htmlspecialchars($student['passwords']); ?>"><br><br>

        <input type="submit" value="Actualizar">
    </form>
</body>
</html>
