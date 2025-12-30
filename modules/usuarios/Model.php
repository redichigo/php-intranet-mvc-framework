<?php

// PROTECCION DE ACCESO AL FICHERO
defined("ACCESS_SUCCESS") or header("Location: ../../error-403");

require_once 'config/Database.php';

class Model extends Database
{
    // CARGAR
    public function cargar()
    {
        $sql = "
            SELECT 
                IDENTIFICADOR,
                ESTADO,
                CREADOR
            FROM 
                accesos;
        ";

        $params_verificar = array();

        $select = $this->query($sql, 'default', 'assoc', $params_verificar, false);

        if (gettype($select) == 'string') {
            return 'error_sql';
        } else {

            if (count($select) > 0) {
                return array_datatable($select);
            } else {
                return 'sin_datos';
            }
        }
    }

    // GUARDAR
    public function guardar($identificador_login, $valores)
    {
        $sql_verificar = "
            SELECT 
                COUNT(*) AS total
            FROM 
                accesos
            WHERE 
                IDENTIFICADOR = :IDENTIFICADOR
        ";

        $params_verificar = array(
            ':IDENTIFICADOR' => $valores["identificador"]
        );

        $select_verificar = $this->query($sql_verificar, 'default', 'assoc', $params_verificar, false);

        // VALIDO SI EXISTO 
        $existe = intval($select_verificar[0]['total']);

        if (gettype($select_verificar) == 'string') {
            return 'error_sql';
        } else {

            if ($existe > 0) {
                return 'existe';
            } else {

                $sql = "
                    INSERT INTO
                        accesos
                    SET
                        IDENTIFICADOR = :IDENTIFICADOR,
                        ESTADO = 'ACTIVO',
                        PASS = SHA2(:PASS, 512),
                        CREADOR = :CREADOR
                ";

                $params = array(
                    ':IDENTIFICADOR' => $valores["identificador"],
                    ':PASS' => $valores["pass"],
                    ':CREADOR' => $identificador_login
                );


                $insert = $this->query($sql, 'default', 'assoc', $params, false);
                if (gettype($insert) == 'string') {
                    return 'error_sql';
                } else {
                    return 'insert_ok';
                }
            }
        }
    }

    // VER
    public function verDetalle($identificador)
    {
        $sql = "
            SELECT 
                IDENTIFICADOR,
                ESTADO
            FROM 
                accesos
            WHERE
                IDENTIFICADOR = :IDENTIFICADOR;
        ";

        $params_verificar = array(
            ':IDENTIFICADOR' => $identificador
        );

        $select = $this->query($sql, 'default', 'assoc', $params_verificar, false);

        if (gettype($select) == 'string') {
            return 'error_sql';
        } else {

            if (count($select) > 0) {
                return $select[0];
            } else {
                return 'sin_datos';
            }
        }
    }

    // MODIFICAR
    public function modificar($identificador_login, $valores)
    {
        // INICIALIZAR LA PARTE DE LA CONSULTA SQL PARA LA ACTUALIZACIÓN
        $sql = "
            UPDATE
                accesos
            SET
                ESTADO = :ESTADO,
        ";

        // INICIALIZAR EL ARRAY DE PARÁMETROS
        $params = array(
            ':IDENTIFICADOR' => $valores["identificador"],
            ':ESTADO' => $valores["estado"]
        );

        // VERIFICAR SI LA CONTRASEÑA NO ESTÁ VACÍA
        if (!empty($valores["pass"])) {
            // SI LA CONTRASEÑA NO ESTÁ VACÍA, AGREGAR LA ACTUALIZACIÓN DE LA CONTRASEÑA
            $sql .= "PASS = SHA2(:PASS, 512), ";
            $params[':PASS'] = $valores["pass"];
        }

        // TERMINO LA CONSULTA
        $sql .= "
                CREADOR = :CREADOR
            WHERE
                IDENTIFICADOR = :IDENTIFICADOR
        ";
        $params[':CREADOR'] = $identificador_login;

        $insert = $this->query($sql, 'default', 'assoc', $params, false);

        if (gettype($insert) == 'string') {
            return 'error_sql';
        } else {
            return;
        }
    }

    // ELIMINAR
    public function eliminar($identificador)
    {
        $sql = "
            DELETE FROM
                accesos
            WHERE
                IDENTIFICADOR = :IDENTIFICADOR
        ";

        $params = array(
            ':IDENTIFICADOR' => $identificador
        );

        $insert = $this->query($sql, 'default', 'assoc', $params, false);

        if (gettype($insert) == 'string') {
            return 'error_sql';
        } else {
            return;
        }
    }
}
