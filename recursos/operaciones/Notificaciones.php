<?php
/**
 * Descripción: Clase para manejar la Notificaciones del usuario
 *
 * @package HelpMe!
 * @author  Juan Martin Machado
 * @version 1.0.0
 *
 * @internal Fecha de creación:   2014-10-10
 * @internal Ultima modificación: 2014-10-10
 * 
 * @internal Audit trail
 * (AAAA-MM-DD) Autor: Modificación
 */
class Notificaciones
{
    /**
     * Descripción: Operacion para leer las notificaciones
     * 
     * @author Juan Martin Machado
     * 
     * @internal Fecha de creación:   2014-10-10
     * @internal Ultima modificación: 2014-10-10
     * 
     * @internal Razón: Creacion
     * @param  stdclass $parametros 
     * @return stdclass Resultado de la operacion
     */
    public function leerNotificacion($parametros){
        /**
         * Genero la respuesta por defecto
         */
        $respuesta            = new stdclass();
        $respuesta->datos     = "";
        $respuesta->codigo    = -1;
        $respuesta->mensaje   = "No hay notificaciones para leer";
        $hm_usuariosDAO       = new hm_usuariosDAO();
        $hm_notificacionesDAO = new hm_notificacionesDAO();

        try {
            if (!controlParamentros($parametros,'["email"]')){
                $respuesta->mensaje = "Datos Invalidos";
                $respuesta->codigo  = 4;
                return $respuesta;
            }
            
            if ($hm_usuariosDAO->hm_usuariosExiste($parametros["email"]) == false){
                $respuesta->mensaje = "El usuario no existe";
                $respuesta->codigo  = 5;
                return $respuesta;
            }
            
            $resultado = $hm_notificacionesDAO->hm_notificacionesLeer($parametros["email"]);
            if ($resultado !== false){
                $hm_notificacionesDAO->hm_notificacionesActualizar($resultado["id_notificacion"]);
                $respuesta->datos   = $resultado;
                $respuesta->codigo  = 0;
                $respuesta->mensaje = MENSAJE_DEFECTO_OK;
            }

        } catch (Exception $e) {
            $respuesta->mensaje = $e->getMessage();
        }
        return $respuesta;
    }

}