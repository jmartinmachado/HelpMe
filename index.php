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
 * Librerias para el manejo de Base de datos
 */
require_once CARPETA_COMMON . '/manejo_db/snddb.php';
require_once CARPETA_COMMON . '/manejo_db/utils.php';
require_once CARPETA_COMMON . '/manejo_db/CMPDB.php';


/**
 * Operaciones
 */
require CARPETA_OPERACIONES . "/Notificaciones.php";
require CARPETA_OPERACIONES . "/ManejoSesion.php";
require CARPETA_OPERACIONES . "/Usuario.php";


/**
 * DAO's
 */
require CARPETA_DAO . "/AbstractDAO.php";
require CARPETA_DAO . "/hm_usuariosDAO.php";
require CARPETA_DAO . "/hm_notificacionesDAO.php";

/**
 * Common
 */
require_once CARPETA_COMMON . '/common.php';


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
 * Clase para el Manejo de Usuarios
 */
$usuarios = new Usuario();

/**
 * Clase para el Manejo de las notificaciones
 */
$notificaciones = new Notificaciones();

/**
 * Logeo lo que le llega al web service
 */
ws_debug($service->contenido_raw);

/**
 * Verifico que los valores del web service sean validos
 */
if (!$service->valido){
    $service->retornar(NULL, "Entrada de datos incorrectos", 2);
    die;
}

$respuesta = NULL;

/**
 * Llamo a operacion con los paramentros
 */
switch ($service->get_operacion()) {
    case 'login':
        $respuesta = $manejoSesion->login($service->get_parametros());
    break;
    case 'registrar_usuario':
        $respuesta = $usuarios->registrarUsuario($service->get_parametros());
    break;
    case 'actualizar_coordenadas':
        $respuesta = $usuarios->actualizarCoordenadas($service->get_parametros());
    break;
    case 'panico':
        $respuesta = $usuarios->panico($service->get_parametros());
    break;
    case 'leer_notificaciones':
        $respuesta = $notificaciones->leerNotificacion($service->get_parametros());
    break;
    default:
        $service->retornar(NULL, "La operacion no existe", 1);
    break;
}

/**
 * Retorno el resultado de la operacion
 */
if (isset($respuesta->datos) && isset($respuesta->mensaje) && isset($respuesta->codigo)){
    $service->retornar($respuesta->datos, $respuesta->mensaje, $respuesta->codigo);
}else{
    $service->retornar();
}


/**
 * Logeeo la respuesta del web service
 */
ws_debug($service->respuesta_json);