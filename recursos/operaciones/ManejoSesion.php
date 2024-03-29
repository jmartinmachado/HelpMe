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
    /**
     * Descripción: Operacion para logear un usuario
     * 
     * @author Juan Martin Machado
     * 
     * @internal Fecha de creación:   2014-10-10
     * @internal Ultima modificación: 2014-10-10
     * 
     * @param  stdclass $parametros 
     * @return stdclass Resultado de la operacion
     */
    public function login($parametros){
        /**
         * Genero la respuesta por defecto
         */
        $respuesta          = new stdclass();
        $respuesta->datos   = "";
        $respuesta->codigo  = -1;
        $respuesta->mensaje = "Usuario/Password Invalidos";
        $hm_usuariosDAO = new hm_usuariosDAO();
        try {
            if (!controlParamentros($parametros,'["usuario","password"]')){
                $respuesta->mensaje = "Datos Invalidos";
                $respuesta->codigo  = 4;
                return $respuesta;
            }

            $resultado = $hm_usuariosDAO->hm_usuariosComprobar($parametros["usuario"], $parametros["password"]);
 
            if ($resultado !== false){
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