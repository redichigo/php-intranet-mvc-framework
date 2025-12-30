<?php

// PROTECCION DE ACCESO AL FICHERO
defined("ACCESS_SUCCESS") or header("Location: ../../error-403");

require_once 'config/Database.php';

class Model extends Database
{
    public function validarLogin($identificador_login, $pass)
    {

        // VERIFICO LOS ACCESOS
        $sql = "
	    	SELECT
	    		*
			FROM
                accesos
			WHERE
                IDENTIFICADOR = :IDENTIFICADOR
			AND
				PASS = SHA2(:PASS, 512)
            AND
                ESTADO = 'ACTIVO';
		";

        $params = array(
            ':IDENTIFICADOR' => $identificador_login,
            ':PASS' => $pass
        );

        $acceso = $this->query($sql, 'default', 'assoc', $params, false);

        if (gettype($acceso) == 'string') {
            return 'error_sql';
        } else {
            if (count($acceso) == 0) {
                return 'sin_acceso';
            } else {

                // OBTENGO ROLES
                $sql = "
                    SELECT
                        ROL
                    FROM
                        roles
                    WHERE
                        IDENTIFICADOR = '" . $identificador_login . "';
                ";

                $params = array();

                $roles = $this->query($sql, 'default', 'assoc', $params, false);

                if (gettype($roles) == 'string') {
                    return 'error_sql';
                } else {
                    if (count($roles) == 0) {
                        return 'sin_roles';
                    } else {

                        $array_final = array(
                            'acceso' => $acceso,
                            'roles' => $roles
                        );

                        return $array_final;
                    }
                }
            }
        }
    }
}
