<?php

// PROTECCION DE ACCESO AL FICHERO
defined("ACCESS_SUCCESS") or header("Location: ../../error-403");

?>

<!-- ----------------------------------------------------------------------------------------------------- -->
<!-- MENU TOP -->
<!-- ----------------------------------------------------------------------------------------------------- -->
<div id="head_modules" class="d-flex flex-wrap align-items-center justify-content-between p-4 mb-5 shadow">

    <!-- DATOS DEL USUARIO LOGADO -->
    <div class="flex-wrap align-items-center">

        <div class="dropdown me-3">

            <button class="btn btn-dark dropdown-toggle" type="button" id="btn_identificador" data-bs-toggle="dropdown" aria-expanded="false">
                <?php echo strtoupper(Session::get("identificador")) ?>
            </button>

            <ul class="dropdown-menu" aria-labelledby="btn_identificador">
                <li><a class="dropdown-item text-danger" href="<?php echo BASE_URL . 'login/logout' ?>">Cerrar sesión</a></li>
            </ul>
            
        </div>
    </div>

    <!-- TÍTULO DEL MODULO (oculto en dispositivos pequeños) -->
    <div class="d-flex justify-content-center align-items-center gap-2">
        <h2>
            <?php
            $modulo_actual = strtoupper(substr(CURRENT_MODULE, 0, -1));
            $module_name = str_replace('_', ' ', CURRENT_MODULE);
            echo strtoupper(substr($module_name, 0, -1));
            ?>
        </h2>
    </div>

    <!-- MENU -->
    <div class="d-flex align-items-center">

        <div class="dropdown">
            <button class="btn btn-dark dropdown-toggle" type="button" id="btn_menu" data-bs-toggle="dropdown" aria-expanded="false">
                MENU
            </button>
            <ul class="dropdown-menu" aria-labelledby="btn_menu">
                <li><a class="dropdown-item" href="panel_de_administracion">Panel administración</a></li>
                <li><a class="dropdown-item" href="usuarios">Usuarios</a></li>
            </ul>
        </div>
    </div>

</div>