<?php
/**
 * Descripción: Clase para manejar las fotos del usuario
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
class Fotos
{
    /**
     * Descripción: Operacion para subir la foto de un usuario
     * 
     * @author Juan Martin Machado
     * 
     * @internal Fecha de creación:   2014-10-10
     * @internal Ultima modificación: 2014-10-10
     * @internal Razón: Creacion
     * 
     * @param  stdclass $parametros 
     * @return stdclass Resultado de la operacion
     */
    public function subirFotoUsuario($parametros){
        /**
         * Genero la respuesta por defecto
         */
        $respuesta          = new stdclass();
        $respuesta->datos   = "";
        $respuesta->codigo  = -1;
        $respuesta->mensaje = "Error al tratar de subir la foto";
        $hm_fotosDAO        = new hm_fotosDAO();
        $hm_usuariosDAO     = new hm_usuariosDAO();

        try {
            if (!controlParamentros($parametros,'["email","foto"]')){
                $respuesta->mensaje = "Datos Invalidos";
                $respuesta->codigo  = 4;
                return $respuesta;
            }

            $id_usuario = $hm_usuariosDAO->hm_usuariosExiste($parametros["email"]);

            if ($id_usuario == false){
                $respuesta->mensaje = "El usuario no existe";
                $respuesta->codigo  = 5;
                return $respuesta;
            }

            if ($hm_fotosDAO->hm_fotosAlta($id_usuario, $parametros["foto"]) == false){
                return $respuesta;
            }
             
            $respuesta->mensaje = "Foto Actualizada";
            $respuesta->codigo  = 0;
            
        } catch (Exception $e) {
            $respuesta->mensaje = $e->getMessage();
        }
        return $respuesta;
    }
}

