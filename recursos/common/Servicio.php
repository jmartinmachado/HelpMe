<?php
/**
 * Descripción: Clase para manejar el Web Service
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
class Servicio
{

    /**
     * Contiene los valores originales que le llegaron al web service
     * @access public
     */
    public $contenido_raw = "";

    /**
     * Contiene los valores del Web Service
     * @access public
     */
    public $contenido = "";

    /**
     * Respuesta del Web Service
     * @access public
     */
    public $respuesta_json = "";

    /**
     * Muestra si los valores que le llegaron al web service son validos 
     */
    public $valido = false;

    function __construct(){
        /**
         * Leo los valores que le llegan al service
         */
        $this->contenido_raw = file_get_contents('php://input');

        /**
         * Transformo el contenido que le llega al servidor en un array asociativo
         */
        $this->contenido = json_decode($this->contenido_raw, true);

        /**
         * Verifico que el json sea correcto
         */
        if (is_array($this->contenido) && isset($this->contenido["operacion"]) && isset($this->contenido["parametros"])){
            $this->valido = true;
        }
    }

    /**
     * Descripción: Le retorna al navegador un json valido para el web service
     * @author Machado, Juan Martín
     * 
     * @internal Fecha de creación:   2014-10-10
     * @internal Ultima modificación: 2014-10-10
     * @internal Razón: Creación
     * 
     * @param stdclass $datos 
     * @param string   $mensaje 
     * @param int      $codigo 
     * @return string resultado de la operacion
     */
    public function retornar($datos = null, $mensaje = MENSAJE_DEFECTO_ERROR, $codigo = -1){
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

        $this->respuesta_json = json_encode($respuesta);

        /**
         * Imprimo la respuesta
         */
        echo $this->respuesta_json;
    }

    /**
     * Descripción: Retorna el nombre de la operacion
     * @author Machado, Juan Martín
     * 
     * @internal Fecha de creación:   2014-10-10
     * @internal Ultima modificación: 2014-10-10
     * @internal Razón: Creación
     * 
     * @return string resultado de la operacion
     */
    public function get_operacion(){
        if ($this->valido){
            return $this->contenido["operacion"];
        }else{
            return "";
        }
    }

    /**
     * Descripción: Le retorna los parametros de la operacion
     * @author Machado, Juan Martín
     * 
     * @internal Fecha de creación:   2014-10-10
     * @internal Ultima modificación: 2014-10-10
     * @internal Razón: Creación
     * 
     * @return string resultado de la operacion
     */
    public function get_parametros(){
        if ($this->valido){
            return $this->contenido["parametros"];
        }else{
            return "";
        }
    }
}