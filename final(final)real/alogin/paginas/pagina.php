<?php
include 'conextion.php';

$usuario = $_SESSION['usuario'];

// Consulta para obtener las notas del alumno
$sql = "SELECT * FROM students WHERE name = '$usuario'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $nota1 = $row["nota1"];
        $nota2 = $row["nota2"];
        $nota3 = $row["nota3"];
        $nota4 = $row["nota4"];
        $nota5 = $row["nota5"];

        // Cálculo de la nota final
        $final_grade = ($nota1 + $nota2 + $nota3 + $nota4 + $nota5) / 5;

        echo "<div>Reading <br> $nota1</div>";
        echo "<div>Listening <br> $nota2</div>";
        echo "<div>Speaking <br> $nota3</div>";
        echo "<div>Writing <br> $nota4</div>";
        echo "<div>Class confidence <br> $nota5</div>";
        echo "<div>Final grade <br> $final_grade</div>";
    }
} else {
    echo "No se encontraron resultados para $usuario";
}

$conn->close();
?>
