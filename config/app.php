<?php

// PROTECCION DE ACCESO AL FICHERO
defined("ACCESS_SUCCESS") or header("Location: ../../error-403");

// NOMBRE DE LA APLICACION
define("PROJECT_NAME", "Intranet");

// RUTAS DE LA APP (EN HOSTING NORMALMENTE SOLO "/")
define("BASE_URL", "/intranet/");

// POSICION RESPECTO A LA URL (EN HOSTING NOMMALMENTE 0,1,2)
define("CONTROLLER_POS", 1);
define("METHOD_POS", 2);
define("PARAM_POS", 3);

// VALORES POR DEFECTO
define("DEFAULT_MODULE", "login/");
define("DEFAULT_CONTROLLER", "Controller");
define("DEFAULT_METHOD", "index");
define("DEFAULT_PATH_CONTROLLER", "modules/" . DEFAULT_MODULE . "Controller");

// RUTAS DE LOS ASSETS
define("VIDEO_PATH", BASE_URL . "assets/video/");
define("IMG_PATH", BASE_URL . "assets/img/");
define("FONT_PATH", BASE_URL . "assets/font/");
define("PDF_PATH", BASE_URL . "assets/pdf/");
define("MODULE_PATH", BASE_URL . "modules/");

// ERRORES
define("ERROR_401", "modules/errores/401.php");
define("ERROR_403", "modules/errores/403.php");
define("ERROR_404", "modules/errores/404.php");

// INCLUDES
define("INFO_META", "modules/includes/info_meta.php");
define("STATIC_CSS", "modules/includes/static_css.php");
define("STATIC_JS", "modules/includes/static_js.php");
define("MENU_TOP", "modules/includes/menu_top.php");

// ====================================================
// ¡¡OJO!! ESTAS CONSTANTES SE DEFINEN EN EL INDEX
// ====================================================

// ACCESS_SUCCESS
// CURRENT_MODULE
// CURRENT_PAGE
// RESOURCES (NECESITA DEL SABER EL MODULO ACTUAL)
