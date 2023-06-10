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
        die("Connection failed: " . $con->connect_error);
    }
    
    $nombre = $_POST['nombre'];
    $apellido1 = $_POST['primer_apellido'];
    $apellido2 = $_POST['segundo_apellido'];
    $email = $_POST['email'];
    $login = $_POST['login'];
    $password = $_POST['password'];


    if (empty($nombre) || empty($apellido1) || empty($apellido2) || empty($email) || empty($login) || empty($password)) {
        echo "Por favor, complete todos los campos.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Ingrese un correo electrónico válido.";
    } elseif (strlen($password) < 4 || strlen($password) > 8) {
        echo "La contraseña debe tener entre 4 y 8 caracteres.";
    } else {

        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "<div class='container'>El correo electrónico ya está registrado.</div>";
        } else {

            $sql = "INSERT INTO usuarios (nombre, primer_apellido, segundo_apellido, email, login, password)
                VALUES ('$nombre', '$apellido1', '$apellido2', '$email', '$login', '$password')";
        if ($conn->query($sql) === TRUE) {
            echo "<div class='container'>";
            echo "Registro completado con éxito.";
            echo "<br>";
            echo "<a href='consulta.php'><button class='form-btn'>Consultar registros</button></a></div>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
</body>
</html>