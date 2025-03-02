<?php
include "../includes/header.php";
?>

<h1 class="mt-3">Búsqueda 1</h1>

<p class="mt-3">
    La cédula de un mecánico y un rango de fechas (es decir, dos fechas f1 y f2
    (cada fecha con día, mes y año) y f2 &gt;= f1). Se debe mostrar el valor total de las
    reparaciones correspondientes a ese mecánico durante ese rango de fechas.

<p class="mt-3">
    Para nuestro trabajo: El código de un cupón y un rango de fechas (es decir, dos fechas f1 y f2 
    (cada fecha con día, mes y año) y f2 &gt;= f1). Se debe mostrar el precio total de los
    servicios correspondientes a ese cupón durante ese rango de fechas.
</p>

<div class="formulario p-4 m-3 border rounded-3">
    <form action="busqueda1.php" method="post" class="form-group">
        <div class="mb-3">
            <label for="fecha1" class="form-label">Fecha 1</label>
            <input type="date" class="form-control" id="fecha1" name="fecha1" required>
        </div>

        <div class="mb-3">
            <label for="fecha2" class="form-label">Fecha 2</label>
            <input type="date" class="form-control" id="fecha2" name="fecha2" required>
        </div>

        <div class="mb-3">
            <label for="cupon" class="form-label">Cupón</label>
            <select name="codigo_cupon" id="cupon" class="form-select" required>
                <option value="" selected disabled hidden>Seleccione un cupón</option>

                <?php
                // Conectar con la base de datos
                require('../config/conexion.php');

                // Consulta para obtener los cupones disponibles
                $query_cupones = "SELECT codigo FROM cupon";
                $resultado_cupones = mysqli_query($conn, $query_cupones);

                // Iterar sobre los cupones y mostrarlos en el select
                while ($cupon = mysqli_fetch_assoc($resultado_cupones)) {
                    echo "<option value='{$cupon['codigo']}'>{$cupon['codigo']}</option>";
                }

                // Cerrar conexión temporalmente
                mysqli_close($conn);
                ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>
</div>

<?php
// Verificar si la solicitud es POST
if ($_SERVER['REQUEST_METHOD'] === 'POST'):
    
    // Conectar con la base de datos
    require('../config/conexion.php');

    // Obtener los datos del formulario
    $fecha1 = $_POST["fecha1"];
    $fecha2 = $_POST["fecha2"];
    $codigo_cupon = $_POST["codigo_cupon"];

    // Consulta SQL para obtener los servicios dentro del rango de fechas para el cupón seleccionado
    $query = "SELECT s.codigo_servicio, s.fecha, s.codigo_cupon, s.precio
    FROM servicio s
    INNER JOIN cupon c ON s.codigo_cupon = c.codigo
    WHERE s.codigo_cupon = '$codigo_cupon'
    AND s.fecha BETWEEN '$fecha1' AND '$fecha2'";

    // Ejecutar la consulta
    $resultado = mysqli_query($conn, $query) or die(mysqli_error($conn));

    // Verificar si hay resultados
    if ($resultado && mysqli_num_rows($resultado) > 0):
?>

<!-- TABLA PARA MOSTRAR LOS CUPONES Y SERVICIOS -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">Código de Servicio</th>
                <th scope="col" class="text-center">Fecha del Servicio</th>
                <th scope="col" class="text-center">Código de Cupón</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Iterar sobre los registros obtenidos
            while ($fila = mysqli_fetch_assoc($resultado)):
            ?>
            <tr>
                <td class="text-center"><?= $fila["codigo_servicio"]; ?></td>
                <td class="text-center"><?= $fila["fecha"]; ?></td>
                <td class="text-center"><?= $fila["codigo_cupon"]; ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- MOSTRAR PRECIO TOTAL -->
<div class="alert alert-info text-center mt-3">
    <?php
    // Obtener el total de la consulta anterior
    $fila_total = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(precio) AS precio_total FROM servicio WHERE codigo_cupon = '$codigo_cupon' AND fecha BETWEEN '$fecha1' AND '$fecha2'"));
    echo "Precio total de los servicios: $" . number_format($fila_total["precio_total"], 2);
    ?>
</div>

<?php
    else:
?>

<!-- MENSAJE DE ERROR SI NO HAY RESULTADOS -->
<div class="alert alert-danger text-center mt-5">
    No se encontraron resultados para esta consulta.
</div>

<?php
    endif;
    // Cerrar conexión
    mysqli_close($conn);
endif;

include "../includes/footer.php";
?>

