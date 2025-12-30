<?php

// PROTECCION DE ACCESO AL FICHERO
defined("ACCESS_SUCCESS") or header("Location: ../../error-403");

class Session
{
    public static function configureSession()
    {
        // CONFIGURACION DE SESSION.SAVE_PATH
        ini_set('session.save_path', 'C:/xampp/tmp');

        // OTROS AJUSTES DE SESIÓN SI ES NECESARIO
        ini_set('session.cookie_lifetime', 3600); // 1 hora
        ini_set('session.gc_maxlifetime', 7200); // 2 horas
    }

    public static function configurePHP()
    {
        // CONFIGURACION DE DISPLAY_ERRORS Y ERROR_REPORTING
        ini_set('display_errors', 1);
        ini_set('error_reporting', E_ALL);
    }

    public static function init()
    {
        session_start();
    }

    public static function add($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function get($key)
    {
        return !empty($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public static function getAll()
    {
        return $_SESSION;
    }

    public static function remove($key)
    {
        if (!empty($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    public static function close()
    {
        session_start();
        session_destroy();
    }

    public static function getStatus()
    {
        return session_status();
    }
}
