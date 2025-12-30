<?php
// PROTECCION DE ACCESO AL FICHERO
defined("ACCESS_SUCCESS") or header("Location: ../../error-403");

class Controller
{

    // ----------------------------------------------------------------------------
    // PARAMETROS
    // ----------------------------------------------------------------------------
    private $model = null;

    // ----------------------------------------------------------------------------
    // CONTRUCTOR
    // ----------------------------------------------------------------------------
    public function __construct()
    {
    }

    // ----------------------------------------------------------------------------
    // CARGA LA VISTA
    // ----------------------------------------------------------------------------
    public function index()
    {
        require_once "view.php";
    }

    // ----------------------------------------------------------------------------
    // METODO LOGIN (RELLENA LOS DATOS DE SESION)
    // ----------------------------------------------------------------------------
    public function login()
    {
        require_once 'Model.php';
        $this->model = new Model();

        $identificador_login = $_REQUEST['identificador_login'] ?? null;
        $pass = $_REQUEST['pass'] ?? null;

        $data = $this->model->validarLogin($identificador_login, $pass);

        if ($data != 'error_sql' && $data != 'sin_acceso' && $data != 'sin_datos' && $data != 'sin_roles') {

            if ($data['acceso'][0]['ESTADO'] !== 'ACTIVO') {
                http_response_code(403);
                echo json_encode(['error' => 'El usuario no está activo.']);
                return;
            }

            // INICIO LA SESIÓN
            session_start();

            // REGENERAR ID DE SESIÓN POR SEGURIDAD
            session_regenerate_id(true);

            // AÑADIR VARIABLES DE SESIÓN
            $_SESSION['status'] = 1;
            $_SESSION['identificador'] = $data['acceso'][0]['IDENTIFICADOR'];
            $_SESSION['rol'] = array_column($data['roles'], 'ROL');

            // RETORNAR LOS DATOS DE SESIÓN
            http_response_code(200);
            echo json_encode("ok");

        } else {
            // RETORNAR EL ERROR
            echo json_encode($data);
        }
    }

    // ----------------------------------------------------------------------------
    // METODO LOGOUT (CIERRA LA SESION)
    // ----------------------------------------------------------------------------
    public function logout()
    {
        // INICIAR LA SESIÓN SI NO ESTÁ INICIADA
        session_start();

        // DESTRUIR TODAS LAS VARIABLES DE SESIÓN
        $_SESSION = array();

        // DESTRUIR LA SESIÓN
        session_destroy();

        // REDIRIGIR AL USUARIO AL INICIO
        header('Location: ' . BASE_URL);
    }
}
?>
