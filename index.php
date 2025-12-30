<?php

// CONSTANTE PARA VALIDAR ACCESO DESDE INDEX
define("ACCESS_SUCCESS", true);

// ARCHIVOS DE CONFIGURACION
require_once "config/app.php";

// ARCHIVOS DE FUNCIONES PHP 
require_once "config/functions.php";

// ARCHIVO DE CONEXION
require_once "config/Database.php";

// LIBRERIAS DE TERCEROS
require_once "config/libs.php";

// ARCHIVO DE SESSIONES
require_once "config/Session.php";

// CONFIGURAR SESIÓN Y PHP
Session::configureSession();
Session::configurePHP();


// OBTENGO LA URL
$request_url = parse_url($_SERVER["REQUEST_URI"]);
$url_path    = $request_url["path"];
$url        = explode("/", $url_path);

// FORMATEO LA URL (YA SIENDO ARRAY)
$last_index_url = count($url) - 1;

// VERIFICO SI HAY SLASH AL FINAL (ARRAY VACIO)
if (empty($url[$last_index_url])) {
    // ELIMINO PRIMERO Y ULTIMO REGISTRO (ESTAN VACIOS)
    array_shift($url);
    array_pop($url);
} else {
    // ELIMINO PRIMER REGISTRO
    array_shift($url);
}

// CONTROLADOR Y EL METODO PRINCIPAL POR DEFECTO (YA INCLUIDO CON EL app.php)
$default_controller = DEFAULT_CONTROLLER;
$default_method     = DEFAULT_METHOD;

// VERIFICO LA SOLICITUD DE URL (SIN PASAR MODULO)
if (BASE_URL === $url_path || BASE_URL === $url_path . "/") {

    // DEFINO ELMODULO ACTUAL Y LA PAGINA ACTUAL
    define("CURRENT_MODULE", DEFAULT_MODULE);
    define("CURRENT_PAGE", BASE_URL . "modules/" . DEFAULT_MODULE);

    // SABIENDO EL MODULO ACTUAL DEFINO RESOURCES
    define("RESOURCES", CURRENT_PAGE . "resources/");

    // LAS RUTAS SON IGUALES, BUSCO Y CARGO CONTROLADOR PRINCIPAL
    if (file_exists(DEFAULT_PATH_CONTROLLER . ".php")) {

        // INCLUYO E INSTANCIO EL CONTROLADOR
        require_once DEFAULT_PATH_CONTROLLER . ".php";

        // VERIFICO SI EXISTE LA CLASE
        if (class_exists($default_controller)) {

            $controller = new $default_controller;

            // VERIFICO SI EXISTE EL METODO POR DEFECTO
            if (method_exists($controller, DEFAULT_METHOD)) {
                $controller->$default_method();
            } else {
                // ERROR 404: METODO POR DEFECTO NO ENCONTRADO
                require_once ERROR_404;
            }
        } else {

            // ERROR 404: METODO POR DEFECTO NO ENCONTRADO
            require_once ERROR_404;
        }
    } else {

        //ERROR 404: CONTROLADOR POR DEFECTO NO ENCONTRADO.
        require_once ERROR_404;
    }

    // VERIFICO QUE SE PASE UN MODULO
} elseif (isset($url[CONTROLLER_POS])) {

    // VERIFICO SI TIENE EL ULTIMO SLASH 
    $ultimo_slash = substr($url_path, -1);

    if ($ultimo_slash == '/') {

        $url_limpia = substr($url_path, 0, -1);

        header("Location: " . $url_limpia);
    }

    // OBTENGO EL NOMBRE DEL MODULO
    $modulo_activo = strtolower($url[CONTROLLER_POS]);

    // DEFINO EL NOMBRE DEL MODULO  DE FORMA GLOBLAL
    define("CURRENT_MODULE", $modulo_activo . "/");
    define("CURRENT_PAGE", BASE_URL . "modules/" . CURRENT_MODULE);

    // SABIENDO EL MODULO ACTUAL DEFINO RESOURCES
    define("RESOURCES", CURRENT_PAGE . "resources/");

    // RUTA DEL MODULO
    $ruta_modulo_activo = "modules/" . $modulo_activo;

    // NOMBRE DEL CONTROLADOR
    $controlador_modulo_activo = "Controller";

    // RUTA COMPLETA DEL CONTROLADOR
    $ruta_controlador_modulo_activo = $ruta_modulo_activo . "/" . $controlador_modulo_activo;

    // BUSCO Y CARGO CONTROLADOR PASADO POR URL
    if (file_exists($ruta_controlador_modulo_activo . ".php")) {

        // INCLUYO EL CONTROLADOR
        require_once $ruta_controlador_modulo_activo . ".php";

        // VERIFICO SI EXISTE LA CLASE
        if (class_exists($controlador_modulo_activo)) {

            // INSTANCIO EL CONTROLADOR
            $controller = new $controlador_modulo_activo;

            // VERIFICO SI SE PASA UN METODO O PASO EL METODO POR DEFECTO
            if (isset($url[METHOD_POS])) {

                // VERIFICO SI EXISTE EL METODO EN EL CONTROLADOR
                if (method_exists($controller, $url[METHOD_POS])) {

                    $method = $url[METHOD_POS];

                    // VERIFICO SI SE PASAN PARAMETROS O LLAMO SOLO AL METODO
                    if (isset($url[PARAM_POS])) {

                        // ALMACENO LOS PARAMETROS PASADOS
                        $params = array();
                        for ($i = PARAM_POS; $i < count($url); $i++) {
                            $params[] = $url[$i];
                        }

                        // LLAMO AL METODO Y LE PASO LOS PARAMETROS
                        call_user_func_array(array($controller, $method), $params);
                    } else {
                        $controller->$method();
                    }
                } else {

                    //ERROR 404: METODO NO ENCONTRADO.
                    require_once ERROR_404;
                }
            } else {

                // VERIFICO SI EXISTE EL METODO POR DEFECTO
                if (method_exists($controller, DEFAULT_METHOD)) {
                    $controller->$default_method();
                } else {
                    // ERROR 404: METODO POR DEFECTO NO ENCONTRADO
                    require_once ERROR_404;
                }
            }
        } else {
        }
    } else {

        // VERIFICO EL TIPO DE ERROR
        if ($url[CONTROLLER_POS] === "error-401") {

            //ERROR 401: PERMISO DE ACCESO.
            require_once ERROR_401;
        } elseif ($url[CONTROLLER_POS] === "error-403") {

            //ERROR 403: PERMISO DE EJECUCION.
            require_once ERROR_403;
        } else {

            //ERROR 404: CONTROLADOR NO ENCONTRADO.
            require_once ERROR_404;
        }
    }
}
