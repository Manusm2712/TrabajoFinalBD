<?php
 
// Crear conexión con la BD
require('../config/conexion.php');

// Sacar los datos del formulario. Cada input se identifica con su "name"
$codigo_servicio = $_POST["codigo_servicio"];
$fecha = $_POST["fecha"];
$precio = $_POST["precio"];
$pre_servicio = $_POST["pre_servicio"];
$codigo_cupon = $_POST["codigo_cupon"];

// Manejar el caso cuando no se selecciona pre_servicio (valor vacío)
if(empty($pre_servicio)) {
    $pre_servicio = "NULL";
} else {
    $pre_servicio = "'$pre_servicio'";
}

// Query SQL a la BD - asegúrese que el nombre de la tabla sea correcto (servicio en lugar de proyecto)
$query = "INSERT INTO `servicio` (`codigo_servicio`, `fecha`, `precio`, `pre_servicio`, `codigo_cupon`) VALUES ('$codigo_servicio', '$fecha', '$precio', $pre_servicio, $codigo_cupon)";

// Ejecutar consulta
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

// Redirigir al usuario a la misma pagina
if($result):
    // Si fue exitosa, redirigirse de nuevo a la página de la entidad
	header("Location: servicio.php");
else:
	echo "Ha ocurrido un error al crear el servicio";
endif;

mysqli_close($conn);