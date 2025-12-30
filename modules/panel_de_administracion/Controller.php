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
        // Inicia la sesión si no está ya iniciada
		session_start();

        // Comprueba el estado de la sesión
        if (empty($_SESSION['status']) || $_SESSION['status'] != 1) {
            // Redirige al usuario a la página base si no está autorizado
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
    // CARGAR DATOS GRAFICOS 
    // ----------------------------------------------------------------------------

}
