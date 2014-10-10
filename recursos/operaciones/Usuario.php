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
class Usuario
{
    public function registrarUsuario($parametros){
        /**
         * Genero la respuesta por defecto
         */
        $respuesta          = new stdclass();
        $respuesta->datos   = "";
        $respuesta->codigo  = -1;
        $respuesta->mensaje = "Error al tratar de crear usuario";
        $hm_usuariosDAO = new hm_usuariosDAO();
        try {
            if (!controlParamentros($parametros,'["name","email","password","skills"]')){
                $respuesta->mensaje = "Datos Invalidos";
                $respuesta->codigo  = 4;
                return $respuesta;
            }
            
            if ($hm_usuariosDAO->hm_usuariosExiste($parametros["email"]) !== false){
                $respuesta->mensaje = "El Email ya esta registrado";
                $respuesta->codigo  = 5;
                return $respuesta;
            }
            
            $skills = "0000";
            foreach ($parametros["skills"] as $llave => $valor) {
                $skills[$valor-1] = 1;
            }
            
            $resultado = $hm_usuariosDAO->hm_usuariosAlta($parametros["name"], $parametros["email"], $parametros["password"], $skills);

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

    public function actualizarCoordenadas($parametros){
        /**
         * Genero la respuesta por defecto
         */
        $respuesta          = new stdclass();
        $respuesta->datos   = "";
        $respuesta->codigo  = -1;
        $respuesta->mensaje = "Error al tratar de actualizar coordenadas";
        $hm_usuariosDAO = new hm_usuariosDAO();
        try {
            if (!controlParamentros($parametros,'["email","coordenadas"]')){
                $respuesta->mensaje = "Datos Invalidos";
                $respuesta->codigo  = 4;
                return $respuesta;
            }
            if ($hm_usuariosDAO->hm_usuariosExiste($parametros["email"]) == false){
                $respuesta->mensaje = "El usuario no existe";
                $respuesta->codigo  = 5;
                return $respuesta;
            }

            $resultado = $hm_usuariosDAO->hm_usuariosActualizarCoordenadas($parametros["email"], $parametros["coordenadas"]["longitud"], $parametros["coordenadas"]["latitud"]);
            
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

    public function panico($parametros){
        /**
         * Genero la respuesta por defecto
         */
        $respuesta            = new stdclass();
        $respuesta->datos     = "";
        $respuesta->codigo    = -1;
        $respuesta->mensaje   = "Error al tratar de actualizar coordenadas";
        $hm_usuariosDAO       = new hm_usuariosDAO();
        $hm_notificacionesDAO = new hm_notificacionesDAO();

        try {
            if (!controlParamentros($parametros,'["email","coordenadas"]')){
                $respuesta->mensaje = "Datos Invalidos";
                $respuesta->codigo  = 4;
                return $respuesta;
            }
            if ($hm_usuariosDAO->hm_usuariosExiste($parametros["email"]) == false){
                $respuesta->mensaje = "El usuario no existe";
                $respuesta->codigo  = 5;
                return $respuesta;
            }

            $actualizarCoordenadas = $hm_usuariosDAO->hm_usuariosActualizarCoordenadas($parametros["email"], $parametros["coordenadas"]["longitud"], $parametros["coordenadas"]["latitud"]);
            
            if ($actualizarCoordenadas == false){
                return $respuesta;
            }

            $busqueda = $hm_usuariosDAO->hm_usuariosBuscarAyuda($parametros["email"], AYUDA_DISTANCIA);



            if (!empty($busqueda)){
                foreach ($busqueda as $llave) {
                    ws_debug($llave);
                    $hm_notificacionesDAO->hm_notificacionesAlta($parametros["email"] ,$llave);
                }
                $respuesta->mensaje = "La ayuda va en camino!!!";
                $respuesta->codigo  = 0;
            } else {
                $respuesta->mensaje = "No se pudo encontrar ayuda cerca!";
                $respuesta->codigo  = 6;
                return $respuesta;
            }
        } catch (Exception $e) {
            $respuesta->mensaje = $e->getMessage();
        }
        return $respuesta;
    }
}