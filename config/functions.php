<?php

// PROTECCION DE ACCESO AL FICHERO
defined("ACCESS_SUCCESS") or header("Location: ../../error-403");

/* --------------------------------------------------------------------------------------------------------------
INDEXAR POR 1 CAMPO
-------------------------------------------------------------------------------------------------------------- */
function array_por_id($_datos, $_indice, $_varios = false)
{
    $_array_datos = array();

    foreach ($_datos as $key => $value) {
        if ($_varios) {
            $_array_datos[$_datos[$key][$_indice]][] = $_datos[$key];
        } else {
            $_array_datos[$_datos[$key][$_indice]] = $_datos[$key];
        }
    }

    return $_array_datos;
}


/* --------------------------------------------------------------------------------------------------------------
FUNCION QUE PERMITE VISUALIZAR EL CONTENIDO DE UN ARRAY DE FORMA ORGANIZADA
-------------------------------------------------------------------------------------------------------------- */
function ver_array($_datos)
{
    echo "<pre>";
    print_r($_datos);
    echo "</pre>";
}


/* --------------------------------------------------------------------------------------------------------------
CONVIERTE ARRAY EN ARRAY DE DATATABLE
-------------------------------------------------------------------------------------------------------------- */
function array_datatable($resultado)
{
    $_array_datos = "";

    // OBTENGO EL TITULO DE LAS COLUMNAS
    $columns = array_keys($resultado[0]);

    // INDICE PARA EL TARGET
    $i = 0;

    // PREPARO EL ARRAY COMO LO REQUIERE DATATABLE
    foreach ($columns as $key => $value) {
        $columns_def[] = array('title' => $value, 'targets' => $i);
        $columns[$key] = array('data' => $value);
        $i++;
    }

    // DEVUELVO EL ARRAY CON FORMATO DESEADO
    $_array_datos = array(
        'datatable_data' => $resultado,
        'datatable_columns' => $columns,
        'datatable_columns_def' => $columns_def
    );

    return $_array_datos;
}
