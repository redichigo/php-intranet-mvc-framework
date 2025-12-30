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
                http_response_code(403); // Forbidden
                echo json_encode(['error' => 'El usuario no está activo.']);
                return;
            }

            // Inicio la sesión
            session_start();

            // Regenerar ID de sesión por seguridad
            session_regenerate_id(true);

            // Añadir variables de sesión
            $_SESSION['status'] = 1;
            $_SESSION['identificador'] = $data['acceso'][0]['IDENTIFICADOR'];
            $_SESSION['rol'] = array_column($data['roles'], 'ROL');

            // Retornar los datos de sesión
            http_response_code(200); // OK
            echo json_encode("ok");

        } else {
            // Retornar el error
            echo json_encode($data);
        }
    }

    // ----------------------------------------------------------------------------
    // METODO LOGOUT (CIERRA LA SESION)
    // ----------------------------------------------------------------------------
    public function logout()
    {
        // Iniciar la sesión si no está iniciada
        session_start();

        // Destruir todas las variables de sesión
        $_SESSION = array();

        // Destruir la sesión
        session_destroy();

        // Redirigir al usuario al inicio
        header('Location: ' . BASE_URL);
    }
}
?>
