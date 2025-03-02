<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<p class="mt-3">
El primer botón debe mostrar los datos de las tres reparaciones de mayor valor junto con los datos de los mecánicos asociados a cada una de estas reparaciones (en caso de empates, usted decide cómo proceder).
</p>

<p class="mt-3">
Para nuestro trabajo: Esta consulta muestra los tres servicios más costosos registrados en la base de datos, junto con los datos de los cupones asociados a dichos servicios.
</p>
<h1 class="mt-3">Consulta 1: Top 3 Servicios Más Costosos</h1>


<?php
// Crear conexión con la BD
require('../config/conexion.php');

// Query SQL para obtener los tres servicios más caros con sus cupones asociados
$query = "SELECT s.codigo_servicio, s.precio, 
                 c.codigo AS codigo_cupon, c.estado, c.valor_descuento, c.informacion  
          -- Selecciona la tabla de servicios
          FROM servicio s 
          -- Relaciona las tablas por el código del cupón
          INNER JOIN cupon c ON s.codigo_cupon = c.codigo  
          -- Ordena los servicios de forma descendente por precio
          ORDER BY s.precio DESC 
          -- Los registros empatados estan en orden aleatorio
          LIMIT 3"; 
          

// Ejecutar la consulta
$resultadoC1 = mysqli_query($conn, $query) or die(mysqli_error($conn));

mysqli_close($conn);
?>

<?php
// Verificar si llegan datos
if ($resultadoC1 and $resultadoC1->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla -->
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">Código Servicio</th>
                <th scope="col" class="text-center">Precio Servicio</th>
                <th scope="col" class="text-center">Código Cupón</th>
                <th scope="col" class="text-center">Estado</th>
                <th scope="col" class="text-center">Descuento</th>
                <th scope="col" class="text-center">Información</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoC1 as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <td class="text-center"><?= htmlspecialchars($fila["codigo_servicio"]); ?></td>
                <td class="text-center">$<?= number_format($fila["precio"], 2); ?></td>
                <td class="text-center"><?= htmlspecialchars($fila["codigo_cupon"]); ?></td>
                <td class="text-center"><?= htmlspecialchars($fila["estado"]); ?></td>
                <td class="text-center">$<?= number_format($fila["valor_descuento"], 2); ?></td>
                <td class="text-center"><?= htmlspecialchars($fila["informacion"]); ?></td>
            </tr>

            <?php
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
