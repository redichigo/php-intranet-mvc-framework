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
    <!-- PINTAR AQUI LA VISTA -->
    <!-- ----------------------------------------------------------------------------------------------------- -->

    <!-- BARRA LATERAL -->
    <div class="sidenav">
        <div class="sidenav_text">
            <h2>INTRANET</h2>
        </div>
    </div>

    <!-- FORMULARIO DE ACCESO -->
    <div class="main">
        <div class="col-md-6 col-sm-12">

            <div class="login_form">
                
                <!-- FORMULARIO -->
                <form>
                    <div class="form-group">
                        <label>IDENTIFICADOR</label>
                        <input type="text" id="identificador_login" class="form-control">
                    </div>

                    <div class="form-group mt-2">
                        <label>PASSWORD</label>
                        <input type="password" id="pass" class="form-control">
                    </div>

                    <!-- BOTONERA -->
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <button type="button" id="btn_acceder" class="form-control btn btn-dark btn-block">Acceder</button>
                        </div>
                    </div>

                </form>

                <!-- MENSAJE DE INFO -->
                <p id="info_login" class="mt-2"> </p>
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