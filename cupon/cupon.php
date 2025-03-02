<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Entidad análoga a MECANICO (CUPON)</h1>

<!-- FORMULARIO. Cambiar los campos de acuerdo a su trabajo -->
<div class="formulario p-4 m-3 border rounded-3">

    <form action="cupon_insert.php" method="post" class="form-group">

        <div class="mb-3">
            <label for="codigo" class="form-label">Codigo</label>
            <input type="number" class="form-control" id="codigo" name="codigo" required>
        </div>

        <div class="mb-3">
            <label for="valor_descuento" class="form-label">Valor descuento</label>
            <input type="number" class="form-control" id="valor_descuento" name="valor_descuento" required>
        </div>

        <div class="mb-3">
            <label for="informacion" class="form-label">Informacion del cupon</label>
            <input type="text" class="form-control" id="informacion" name="informacion" required>
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado del cupon</label>
            <select class="form-select" id="estado" name="estado" required>
            <option value="" selected disabled hidden></option>
            <option value="activo">Activo</option>
            <option value="inactivo">Inactivo</option>
            </select>
        </div>
        
        <!-- Consultar la lista de clientes y desplegarlos -->
        <div class="mb-3">
            <label for="cliente" class="form-label">Cliente</label>
            <select name="id_cliente" id="id_cliente" class="form-select">
                
                <!-- Option por defecto -->
                <option value="" selected disabled hidden></option>

                <?php
                // Importar el código del otro archivo
                require "../cliente/cliente_select.php";
                
                // Verificar si llegan datos
                if($resultadoCliente):
                    
                    // Iterar sobre los registros que llegaron
                    foreach ($resultadoCliente as $fila):
                ?>

                <!-- Opción que se genera -->
                <option value="<?= $fila["id"]; ?>"><?= $fila["nombre"]; ?> - C.C. <?= $fila["id"]; ?></option>

                <?php
                        // Cerrar los estructuras de control
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
require "cupon_select.php";

// Verificar si llegan datos
if($resultadoCupon and $resultadoCupon->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla, cambiarlos -->
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">Codigo</th>
                <th scope="col" class="text-center">Valor de descuento</th>
                <th scope="col" class="text-center">Informacion</th>
                <th scope="col" class="text-center">Estado</th>
                <th scope="col" class="text-center">Cliente asociado</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoCupon as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
                <td class="text-center"><?= $fila["codigo"]; ?></td>
                <td class="text-center"><?= $fila["valor_descuento"]; ?></td>
                <td class="text-center">$<?= $fila["informacion"]; ?></td>
                <td class="text-center">C.C. <?= $fila["estado"]; ?></td>
                <td class="text-center">C.C. <?= $fila["id_cliente"]; ?></td>
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