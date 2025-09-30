<?php
session_start(); // Inicia la sesión

// Verifica si el usuario está autenticado
if (!isset($_SESSION['student_id']) || !isset($_SESSION['username'])) {
    // Si no está autenticado, redirige a la página de login
    header("Location: loginhtml.php?error=Debes iniciar sesión para realizar esta acción");
    exit();
}

// Incluir el archivo de conexión
include 'conextion.php';

if (isset($_POST['username']) && isset($_POST['passwords'])) {
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = validate($_POST['username']);
    $passwords = validate($_POST['passwords']);
    $student_id = $_SESSION['student_id']; // Asumimos que el student_id está guardado en la sesión

    // Validar campos
    if (empty($username)) {
        header("Location: edit_profile.php?error=El nombre de usuario es requerido");
        exit();
    } elseif (empty($passwords)) {
        header("Location: edit_profile.php?error=La contraseña es requerida");
        exit();
    } else {
        // Cifrar la nueva contraseña antes de almacenarla en la base de datos
        $passwords_hashed = password_hash($passwords, PASSWORD_DEFAULT);

        // Actualizar el perfil en la base de datos
        $Sql = "UPDATE usertype SET username='$username', passwords='$passwords_hashed' WHERE student_id='$student_id'";
        $result = mysqli_query($con, $Sql);

        if ($result) {
            // Actualizar la sesión con el nuevo nombre de usuario
            $_SESSION['username'] = $username;

            // Redirigir con un mensaje de éxito
            header("Location: edit_profile.php?success=Perfil actualizado exitosamente");
            exit();
        } else {
            // Si hay un error en la consulta
            header("Location: edit_profile.php?error=Error al actualizar el perfil");
            exit();
        }
    }
} else {
    header("Location: edit_profile.php");
    exit();
}
