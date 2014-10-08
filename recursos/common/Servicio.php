<?php
/**
 * Descripción: Clase para manejar el Web Service
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
class Servicio
{
    /**
     * Contiene los valores del Web Service
     * @access public
     */
    public $contenido = "";

    function __construct()
    {
        /**
         * Leo los valores que le llegan al service
         */
        $contenido_raw = file_get_contents('php://input');

        /**
         * Transformo el contenido que le llega al servidor en un array asociativo
         */
        $this->contenido = json_decode($contenido_raw, true);

        /**
         * Verifico que el json sea correcto
         */
        if (!is_array($this->contenido) && !isset($this->contenido["operacion"]) && !isset($this->contenido["parametros"])){

        }
    }

    /**
     * Descripción: Le retorna al navegador un json valido para el web service
     * @author Machado, Juan Martín
     * 
     * @internal Fecha de creación:   2014-10-08
     * @internal Ultima modificación: 2014-10-08
     * @internal Razón: Creación
     * 
     * @param stdclass $datos 
     * @param string   $mensaje 
     * @param int      $codigo 
     * @return string resultado de la operacion
     */
    public function retornar($datos = null, $mensaje = MENSAJE_DEFECTO_OK, $codigo = -1){
        /**
         * Genero la respuesta
         */
        $respuesta          = new stdclass();
        $respuesta->datos   = $datos;
        $respuesta->codigo  = $codigo;
        $respuesta->mensaje = $mensaje;
        
        /**
         * Le digo al navegador que le voy a retornar un json
         */
        header('Content-type: application/json');

        $respuesta_json = json_encode($respuesta);

        /**
         * Imprimo la respuesta
         */
        echo $respuesta_json;

        /**
         * Retorno la respuesta
         */
        return $respuesta_json;
    }
}