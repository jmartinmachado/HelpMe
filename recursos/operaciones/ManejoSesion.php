<?php 
/**
 * Descripción: Clase para manejar la sesion del usuario
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
class ManejoSesion
{
    public function login($parametros){
        /**
         * Genero la respuesta por defecto
         */
        $respuesta          = new stdclass();
        $respuesta->datos   = NULL;
        $respuesta->codigo  = 3;
        $respuesta->mensaje = "Error al tratar de logear el usuario";

        try {
            
        } catch (Exception $e) {
            $respuesta->mensaje = $e->getMessage($e);
        }

        return $respuesta;
    }
}