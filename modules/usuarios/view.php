<?php

// PROTECCION DE ACCESO AL FICHERO
defined("ACCESS_SUCCESS") or header("Location: ../../error-403");

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <!-- ----------------------------------------------------------------------------------------------------- -->
    <!-- META Y ESTILOS -->
    <!-- ----------------------------------------------------------------------------------------------------- -->
    <?php
    include INFO_META;
    include STATIC_CSS;
    include 'style.php';
    ?>

</head>

<body>

    <!-- ----------------------------------------------------------------------------------------------------- -->
    <!-- MENU TOP (DEFINIDO EL HTML EN LA CARPETA MODULES/INCLUDES) -->
    <!-- ----------------------------------------------------------------------------------------------------- -->
    <?php
    include MENU_TOP;
    ?>

    <!-- ----------------------------------------------------------------------------------------------------- -->
    <!-- PINTAR AQUI LA VISTA -->
    <!-- ----------------------------------------------------------------------------------------------------- -->
    <div class="mt-5 container wrap_view">
        <div class="wrap_formulario">

            <form>

                <div class="row">

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="identificador" class="form-label">Identificador:</label>
                            <input type="text" class="form-control input_guardar" id="identificador">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado:</label>
                            <select type="text" class="form-control input_guardar" id="estado">
                                <option>ACTIVO</option>
                                <option>INACTIVO</option>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="pass" class="form-label">Contraseña:</label>
                            <input type="password" class="form-control input_guardar" id="pass">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="confirmar_pass" class="form-label">Confirmar contraseña:</label>
                            <input type="password" class="form-control input_guardar" id="confirmar_pass">
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-12">
                        <button type="button" id="btn_guardar" class="btn btn-dark"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
                        <button type="button" id="btn_modificar" class="btn btn-dark d-none"><i class="fa fa-exchange" aria-hidden="true"></i> Modificar</button>
                        <button type="button" id="btn_eliminar" class="btn btn-danger d-none"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
                        <button type="button" id="btn_resetear" class="btn btn-primary"><i class="fa fa-refresh" aria-hidden="true"></i> Resetear</button>
                    </div>
                </div>

            </form>

            <!-- VISOR -->
            <div class="row">
                <div class="col-md-12">
                    <table id="tabla_datos" class="table table-striped"></table>
                </div>
            </div>
        </div>
    </div>

    <!-- ----------------------------------------------------------------------------------------------------- -->
    <!-- LOADER -->
    <!-- ----------------------------------------------------------------------------------------------------- -->
    <div class="loader_ajax" style="display: none;"></div>


    <!-- ----------------------------------------------------------------------------------------------------- -->
    <!-- SCRIPT -->
    <!-- ----------------------------------------------------------------------------------------------------- -->
    <?php
    include STATIC_JS;
    include 'script.php';
    ?>
</body>

</html>