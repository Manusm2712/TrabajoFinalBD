<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Entidad análoga a REPARACION (SERVICIO)</h1>

<!-- FORMULARIO. Cambiar los campos de acuerdo a su trabajo -->
<div class="formulario p-4 m-3 border rounded-3">

    <form action="servicio_insert.php" method="post" class="form-group">

        <div class="mb-3">
            <label for="codigo_servicio" class="form-label">Codigo de servicio</label>
            <input type="number" class="form-control" id="codigo_servicio" name="codigo_servicio" required>
        </div>

        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha del servicio</label>
            <input type="date" class="form-control" id="fecha" name="fecha" required>
        </div>

        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" class="form-control" id="precio" name="precio" required>
        </div>
        
        <!-- Consultar la lista de cupones y desplegarlos -->
        <div class="mb-3">
            <label for="cupon" class="form-label">Cupon</label>
            <select name="codigo_cupon" id="cupon" class="form-select">
                
                <!-- Option por defecto -->
                <option value="" selected disabled hidden></option>

                <?php
                // Importar el código del otro archivo
                require "../cupon/cupon_select.php";
                
                // Verificar si llegan datos
                if($resultadoCupon):
                    
                    // Iterar sobre los registros que llegaron
                    foreach ($resultadoCupon as $fila):
                ?>

                <!-- Opción que se genera -->
                <option value="<?= $fila["codigo"]; ?>"><?= $fila["valor_descuento"]; ?> - ID <?= $fila["codigo"]; ?></option>

                <?php
                        // Cerrar los estructuras de control
                    endforeach;
                endif;
                ?>
            </select>
        </div>

        <!-- Consultar la lista de pre-servicios y desplegarlos -->
        <div class="mb-3">
            <label for="pre-servicio" class="form-label">Pre-servicio</label>
            <select name="pre_servicio" id="pre-servicio" class="form-select">
            
            <!-- Option por defecto -->
            <option value="" selected>No requiere pre-servicio</option>

            <?php
            // Importar el código del otro archivo
            require "servicio_select.php";
            
            // Verificar si llegan datos
            if($resultadoServicio and $resultadoServicio->num_rows > 0):
                
                // Iterar sobre los registros que llegaron
                foreach ($resultadoServicio as $fila):
            ?>

            <!-- Opción que se genera -->
            <option value="<?= $fila["codigo_servicio"]; ?>"><?= $fila["fecha"]; ?> - Nombre: <?= $fila["codigo_servicio"]; ?></option>

            <?php
                // Cerrar las estructuras de control
                endforeach;
            endif;
            ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Agregar</button>

    </form>
    
</div>

<?php
// Importar el código del otro archivo
require "servicio_select.php";
            
// Verificar si llegan datos
if($resultadoServicio and $resultadoServicio->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla, cambiarlos -->
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">Codigo de servicio</th>
                <th scope="col" class="text-center">Fecha del servicio</th>
                <th scope="col" class="text-center">Precio</th>
                <th scope="col" class="text-center">Cupon</th>
                <th scope="col" class="text-center">Pre-servicio</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoServicio as $fila):
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

<?php
endif;

include "../includes/footer.php";
?>