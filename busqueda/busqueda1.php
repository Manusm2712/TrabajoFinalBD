<?php
include "../includes/header.php";
?>

<h1 class="mt-3">Búsqueda 1</h1>

<p class="mt-3">
    Recibe el código de un cupón y un rango de fechas (es decir, dos fechas f1 y f2 
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
            <label for="codigo" class="form-label">Código cupón</label>
            <input type="text" class="form-control" id="codigo" name="codigo" required>
        </div>

        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST'):
    require('../config/conexion.php');

    // Validar y sanitizar los datos de entrada
    $fecha1 = $_POST["fecha1"];
    $fecha2 = $_POST["fecha2"];
    $codigo = trim($_POST["codigo"]);

    if ($fecha2 < $fecha1) {
        echo '<div class="alert alert-danger text-center mt-5">La fecha 2 debe ser mayor o igual a la fecha 1.</div>';
    } else {
        // Usar Prepared Statements para evitar inyección SQL
        $query = "SELECT SUM(precio) AS precio_total FROM servicio WHERE codigo = ? AND fecha BETWEEN ? AND ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $codigo, $fecha1, $fecha2);
        $stmt->execute();
        $resultadoB1 = $stmt->get_result();

        // Cerrar la conexión
        $stmt->close();
        $conn->close();

        // Mostrar los resultados
        if ($resultadoB1 && $fila = $resultadoB1->fetch_assoc()):
?>
            <div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" class="text-center">Precio Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center"><?= number_format($fila["precio_total"], 2); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
<?php
        else:
            echo '<div class="alert alert-danger text-center mt-5">No se encontraron resultados para esta consulta</div>';
        endif;
    }
endif;

include "../includes/footer.php";
?>
