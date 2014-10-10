<?php
/**
 * Descripción: Funciones comunes
 *
 * @package HelpMe!
 * @author  Juan Martin Machado
 * @version 1.0.0
 *
 * @internal Fecha de creación:   2014-10-08
 * @internal Ultima modificación: 2014-10-08
 * 
 * @internal Audit trail
 * (AAAA-MM-DD) Autor: Modificación
 */


function controlParamentros($parametros, $validacion){
    $validacion_array = json_decode($validacion);
    if(is_array($validacion_array)){
        foreach ($parametros as $llave => $valor) {
            if (!in_array($llave, $validacion_array)){
                return false;
            }
        }
    }else{
        return false;
    }
    return true;
}