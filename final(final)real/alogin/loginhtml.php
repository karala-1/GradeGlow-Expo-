<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="logo-side">
            <div class="logo">
                <img class="imglogo1" src="media\login.jpg" alt="">
            </div>
        </div>
        <div class="form-side">
            <div class="form-container">
                <h2>BIENVENIDO A GRADEGLOW</h2>
                <p>Inicia sesión para que puedas visualizar tus notas.</p>

                <!-- Muestra el mensaje de error si existe -->
                <?php if (isset($_GET['error'])): ?>
                    <div class="error-message">
                        <?php echo htmlspecialchars($_GET['error']); ?>
                    </div>
                <?php endif; ?>
<!-- Inicio del formulario -->
                <form action="login.php" method="post">
                    <div class="input-group">
                        <label>Correo electrónico:</label>
                        <input type="email" name="email" placeholder="@adoc.superate.org.sv" required>
                    </div>
                    <div class="input-group">
                        <label>Contraseña:</label>
                        <input type="password" name="passwords" placeholder="" required>
                    </div>
                    <div class="input-group">
                        <label>Id:</label>
                        <input type="text" name="student_id" placeholder="190" required>
                    </div>
                    <button type="submit">Iniciar sesión</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
