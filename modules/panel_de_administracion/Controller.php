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
        // INICIA LA SESIÓN SI NO ESTÁ YA INICIADA
		session_start();

        // COMPRUEBA EL ESTADO DE LA SESIÓN
        if (empty($_SESSION['status']) || $_SESSION['status'] != 1) {
            // REDIRIGE AL USUARIO A LA PÁGINA BASE SI NO ESTÁ AUTORIZADO
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
