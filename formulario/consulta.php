<!DOCTYPE html>
<html>
<head>
    <title>Ejemplo de PHP y CSS</title>
    <link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "labfinal";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<div class='container'>";
    echo "<h2>Registros de Usuarios</h2>";
    echo "<table>";
    echo "<tr><th>Nombre</th><th>Primer Apellido</th><th>Segundo Apellido</th><th>Email</th><th>Login</th><th>Password</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["nombre"]."</td><td>".$row["primer_apellido"]."</td><td>".$row["segundo_apellido"]."</td><td>".$row["email"]."</td><td>".$row["login"]."</td><td>".$row["password"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "<div class='container'>No se encontraron registros.</div>";
}

$conn->close();
?>
</body>
</html>