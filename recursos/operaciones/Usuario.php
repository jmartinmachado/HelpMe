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
    /**
     * Descripción: Operacion para registrar un usuario
     * 
     * @author Juan Martin Machado
     * 
     * @internal Fecha de creación:   2014-10-10
     * @internal Ultima modificación: 2014-10-10
     * @internal Razón: Creacion
     * 
     * @param type $parametros 
     * @return type
     */
    public function registrarUsuario($parametros){
        /**
         * Genero la respuesta por defecto
         */
        $respuesta          = new stdclass();
        $respuesta->datos   = "";
        $respuesta->codigo  = -1;
        $respuesta->mensaje = "Error al tratar de crear usuario";
        $hm_celularDAO      = new hm_celularDAO();
        $hm_usuariosDAO     = new hm_usuariosDAO();

        try {
            if (!controlParamentros($parametros,'["name","email","password","celular"]')){
                $respuesta->mensaje = "Datos Invalidos";
                $respuesta->codigo  = 4;
                return $respuesta;
            }
            
            if ($hm_usuariosDAO->hm_usuariosExiste($parametros["email"]) !== false){
                $respuesta->mensaje = "El Email ya esta registrado";
                $respuesta->codigo  = 5;
                return $respuesta;
            }

            $resultado = $hm_usuariosDAO->hm_usuariosAlta($parametros["name"], $parametros["email"], $parametros["password"]);

            foreach ($parametros["celular"] as $valor) {
                $hm_celularDAO->hm_celularAlta($resultado, $valor);
            }

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

    /**
     * Descripción: Operacion para actualizar las coordenadas de un usuario
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

    /**
     * Descripción: Operacion para enviar una señal de ayuda 
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

            if (empty($busqueda)){
                $respuesta->mensaje = "No se pudo encontrar ayuda cerca!";
                $respuesta->codigo  = 6;
                return $respuesta;
            }
            
            foreach ($busqueda as $llave) {
                ws_debug($llave);
                $hm_notificacionesDAO->hm_notificacionesAlta($parametros["email"] ,$llave);
            }
            $respuesta->mensaje = "La ayuda va en camino!!!";
            $respuesta->codigo  = 0;
            
        } catch (Exception $e) {
            $respuesta->mensaje = $e->getMessage();
        }
        return $respuesta;
    }
}