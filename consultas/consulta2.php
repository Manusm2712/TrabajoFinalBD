<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Consulta 2</h1>

<p class="mt-3">
El segundo botón debe mostrar el código y el nombre de los talleres de los
dos talleres que tienen la mayor cantidad de reparaciones (en caso de empates,
usted decide cómo proceder).
</p>
<p class="mt-3">
Para nuestro problema: 
El segundo botón debe mostrar el id y el nombre de los clientes de los
dos clientes que tienen la mayor cantidad de servicios contratados (en caso de empates,
usted decide cómo proceder).
</p>

<?php
// Crear conexión con la BD
require('../config/conexion.php');

// Query SQL a la BD -> Crearla acá (No está completada, cambiarla a su contexto y a su analogía)
$query = "SELECT c.id, c.nombre, COUNT(s.codigo_servicio) AS total_servicios
                FROM cliente c
                JOIN cupon cu ON cu.id_cliente = c.id
                JOIN servicio s ON s.codigo_cupon = cu.codigo
                GROUP BY c.id, c.nombre
                ORDER BY total_servicios DESC
                LIMIT 2;
";

// Ejecutar la consulta
$resultadoC2 = mysqli_query($conn, $query) or die(mysqli_error($conn));

mysqli_close($conn);
?>

<?php
// Verificar si llegan datos
if($resultadoC2 and $resultadoC2->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla, cambiarlos -->
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">ID</th>
                <th scope="col" class="text-center">Nombre</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoC2 as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
                <td class="text-center"><?= $fila["id"]; ?></td>
                <td class="text-center"><?= $fila["nombre"]; ?></td>
            </tr>

            <?php
            // Cerrar los estructuras de control
            endforeach;
            ?>

        </tbody>

    </table>
</div>

<!-- Mensaje de error si no hay resultados -->
<?php
else:
?>

<div class="alert alert-danger text-center mt-5">
    No se encontraron resultados para esta consulta
</div>

<?php
endif;

include "../includes/footer.php";
?>