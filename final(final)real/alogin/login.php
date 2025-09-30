<?php
// Incluir el archivo de conexión
include 'conextion.php';

session_start(); // Asegúrate de iniciar la sesión

if (isset($_POST['email']) && isset($_POST['passwords']) && isset($_POST['student_id'])) {
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $email = validate($_POST['email']);
    $passwords = validate($_POST['passwords']);
    $student_id = validate($_POST['student_id']);

    // Validar campos
    if (empty($email)) {
        header("Location: loginhtml.php?error=El correo es requerido");
        exit();
    } elseif (empty($student_id)) {
        header("Location: loginhtml.php?error=El id es requerido");
        exit();
    } elseif (empty($passwords)) {
        header("Location: loginhtml.php?error=La contraseña es requerida");
        exit();
    } else {
        // Consulta SQL para verificar las credenciales
        $Sql = "SELECT * FROM usertype WHERE email = '$email' AND student_id='$student_id'";
        $result = mysqli_query($con, $Sql);

        // Verificar si la consulta tuvo éxito
        if (!$result) {
            die("Error en la consulta SQL: " . mysqli_error($con));
        }

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            // Verificar la contraseña directamente
            if ($row['email'] === $email && $row['student_id'] === $student_id && $row['passwords'] === $passwords) {
                $_SESSION['email'] = $row['email'];
                $_SESSION['passwords'] = $row['passwords'];
                $_SESSION['student_id'] = $row['student_id'];

                // Obtener y almacenar el nombre completo del usuario en la sesión
                $_SESSION['fullname'] = $row['fullname'];

                // Determinar la página de redirección según el student_id
                if ($student_id >= 1 && $student_id <= 61) {
                    $redirect_page = 'paginas/inicio.php';
                } elseif ($student_id > 61 && $student_id <= 124) {
                    $redirect_page = 'paginas/inicio2.php';
                } else if($student_id > 124 && $student_id <= 161){
                    $redirect_page = 'paginas/inicio3.php';
                }else {
                    $redirect_page = 'paginas/vistaDirector.php';
                }

                // Redirigir al usuario
                header("Location: $redirect_page");
                exit();
            } else {
                header("Location: loginhtml.php?error=El correo, el id o la contraseña son incorrectos");
                exit();
            }
        } else {
            header("Location: loginhtml.php?error=El correo o el id son incorrectos");
            exit();
        }
    }
} else {
    header("Location: loginhtml.php");
    exit();
}
