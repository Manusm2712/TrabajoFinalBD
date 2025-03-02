<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Búsqueda 2</h1>

<p class="mt-3">
Al ingrear el código de un taller. Se debe mostrar todos los datos de las reparaciones de
ese taller han requerido garantía.
</p>

<!-- FORMULARIO. Cambiar los campos de acuerdo a su trabajo -->
<div class="formulario p-4 m-3 border rounded-3">

    <!-- En esta caso, el Action va a esta mismo archivo -->
    <form action="busqueda2.php" method="post" class="form-group">

        <div class="mb-3">
            <label for="id" class="form-label">ID cliente</label>
            <input type="number" class="form-control" id="id" name="id" required>
        </div>

        <button type="submit" class="btn btn-primary">Buscar</button>

    </form>
    
</div>

<?php
// Dado que el action apunta a este mismo archivo, hay que hacer eata verificación antes
if ($_SERVER['REQUEST_METHOD'] === 'POST'):

    // Crear conexión con la BD
    require('../config/conexion.php');

    $id = $_POST["id"];

    // Query SQL a la BD -> Crearla acá (No está completada, cambiarla a su contexto y a su analogía)
    $query = "SELECT * FROM servicio
                    WHERE pre_servicio IS NOT NULL
                    AND EXISTS(
                        SELECT codigo FROM cupon
                        WHERE codigo_cupon = codigo
                        AND id_cliente = '$id'
                    )";

    // Ejecutar la consulta
    $resultadoB2 = mysqli_query($conn, $query) or die(mysqli_error($conn));

    mysqli_close($conn);

    // Verificar si llegan datos
    if($resultadoB2 and $resultadoB2->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla, cambiarlos -->
        <thead class="table-dark">
            <tr>
            <th scope="col" class="text-center">Codigo servicio</th>
            <th scope="col" class="text-center">Fecha del servicio</th>
            <th scope="col" class="text-center">Precio</th>
            <th scope="col" class="text-center">Cupon</th>
            <th scope="col" class="text-center">Pre-servicio</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoB2 as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
                <td class="text-center"><?= $fila["codigo_servicio"]; ?></td>
                <td class="text-center"><?= $fila["fecha"]; ?></td>
                <td class="text-center">$<?= $fila["precio"]; ?></td>
                <td class="text-center"><?= $fila["codigo_cupon"]; ?></td>
                <td class="text-center"><?= $fila["pre_servicio"]; ?></td>
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
endif;

include "../includes/footer.php";
?>