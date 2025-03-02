<?php
 
// Crear conexión con la BD
require('../config/conexion.php');

// Sacar los datos del formulario. Cada input se identifica con su "name"
$nombre = $_POST["nombre"];
$fecha = $_POST["fecha"];
$precio = $_POST["precio"];
$pre_servicio = $_POST["pre_servicio"];
$codigo_cupon = $_POST["codigo_cupon"];

// Query SQL a la BD. Si tienen que hacer comprobaciones, hacerlas acá (Generar una query diferente para casos especiales)
$query = "INSERT INTO `proyecto`(`nombre`,`fecha`, `precio`, `pre_servicio`, `codigo_cupon`) VALUES ('$nombre', '$fecha', '$precio', '$pre_servicio', '$codigo_cupon')";

// Ejecutar consulta
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

// Redirigir al usuario a la misma pagina
if($result):
    // Si fue exitosa, redirigirse de nuevo a la página de la entidad
	header("Location: proyecto.php");
else:
	echo "Ha ocurrido un error al crear la persona";
endif;

mysqli_close($conn);