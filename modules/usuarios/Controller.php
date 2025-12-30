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
        // INICIA LA SESIÓN
        Session::init();

        // COMPRUEBA EL ESTADO DE LA SESIÓN
        $status = Session::get('status');

        if ($status != 1) {
            header('Location: ' . BASE_URL);
            exit();
        }
    }

    // ----------------------------------------------------------------------------
    // CARGA LA VISTA
    // ----------------------------------------------------------------------------
    public function index()
    {
        require_once "view.php";
    }

    // ----------------------------------------------------------------------------
    // METODOS ESPECIFICOS
    // ----------------------------------------------------------------------------

    // CARGAR
    public function cargar()
    {
        require_once 'Model.php';
        $this->model = new Model();

        $data = $this->model->cargar();

        echo json_encode($data);
    }

    // GUARDAR
    public function guardar()
    {
        require_once 'Model.php';
        $this->model = new Model();

        $identificador_login;
        $valores;

        if ($_REQUEST['identificador_login']) {
            $identificador_login = $_REQUEST['identificador_login'];
        }

        if ($_REQUEST['valores']) {
            $valores = $_REQUEST['valores'];
        }

        $data = $this->model->guardar($identificador_login, $valores);

        echo json_encode($data);
    }

    // VER
    public function ver_detalle()
    {
        require_once 'Model.php';
        $this->model = new Model();

        $id_producto;

        if ($_REQUEST['identificador']) {
            $identificador = $_REQUEST['identificador'];
        }

        $data = $this->model->verDetalle($identificador);

        echo json_encode($data);
    }

    // MODIFICAR
    public function modificar()
    {
        require_once 'Model.php';
        $this->model = new Model();

        $identificador_login;
        $valores;

        if ($_REQUEST['identificador_login']) {
            $identificador_login = $_REQUEST['identificador_login'];
        }

        if ($_REQUEST['valores']) {
            $valores = $_REQUEST['valores'];
        }

        $data = $this->model->modificar($identificador_login, $valores);

        echo json_encode($data);
    }

    // ELIMINAR
    public function eliminar()
    {
        require_once 'Model.php';
        $this->model = new Model();

        $identificador;

        if ($_REQUEST['identificador']) {
            $identificador = $_REQUEST['identificador'];
        }

        $data = $this->model->eliminar($identificador);

        echo json_encode($data);
    }
}
