<?php
/**
 * Descripción: Index
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


/**
 * Archivo de Configuracion
 */
require dirname(__FILE__) . "/config.php";

/**
 * Librerias
 */
require CARPETA_COMMON . "/Servicio.php";
require CARPETA_COMMON . "/log.php";


/**
 * Operaciones
 */
require CARPETA_OPERACIONES . "/ManejoSesion.php";


/** 
 * Seteo Timezone
 */
date_default_timezone_set("America/Argentina/Buenos_Aires");

/** 
 * Clase para loggear
 */
$_log = new logs(dirname(__FILE__) ."/logs/ws_debug_" . date("Y-m-d") .".log",true);

/**
 * Clase para manejar el web service
 */
$service = new Servicio();

/**
 * Clase para Manejo de Sesion
 */
$manejoSesion = new ManejoSesion();

/**
 * Logeo lo que le llega al web service
 */
ws_debug($_SERVER);
ws_debug("--");
ws_debug($service->contenido_raw);

/**
 * Verifico que los valores del web service sean validos
 */
if (!$service->valido){
    $service->retornar(NULL, "Entrada de datos incorrectos", 2);
}

$respuesta = NULL;

switch ($service->get_operacion()) {
    case 'login':
        $respuesta = $manejoSesion->login($service->get_parametros());
    break;
    default:
        $service->retornar(NULL, "La operacion no existe", 1);
    break;
}
$service->retornar($respuesta->datos, $respuesta->mensaje, $respuesta->codigo);

/**
 * Logeo la respuesta del web service
 */
ws_debug($service->respuesta_json);