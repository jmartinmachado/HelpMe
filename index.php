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
 * Logeo lo que le llega al web service
 */
ws_debug($service->contenido);

ws_debug($service->retornar("Holas <3",MENSAJE_DEFECTO_OK,0));