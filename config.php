<?php
/**
 * Descripción: Archivo de Configuracion
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

/** Carpeta Principal */
define("CARPETA_PRINCIPAL", "C:/xampp/htdocs/Propio/HelpMe!");


/** Carpeta Common */
define("CARPETA_COMMON", CARPETA_PRINCIPAL . "/recursos/common" );

/** Carpeta Operaciones */
define("CARPETA_OPERACIONES", CARPETA_PRINCIPAL . "/recursos/operaciones" );

/** Carpeta Dao */
define("CARPETA_DAO", CARPETA_PRINCIPAL . "/recursos/persistencia" );


/** mensaje en respuesta (exitosa) por defecto */
define('MENSAJE_DEFECTO_OK', "La operacion se realizo correctamente");

/** mensaje en respuesta no exitosa por defecto */
define('MENSAJE_DEFECTO_ERROR', "Ocurrio un error durante la ejecucion del servicio");

/** Distancia de la ayuda mas cercana en metros*/
define('AYUDA_DISTANCIA', 200000000);

/**
 * Configuracion de la Base de datos
 */

/** Datos de la conexion */
define("DB_HOST","localhost");
define("DB_USER","root");
define("DB_PASS","");
define("DB_NAME","helpme");

/** Set de Caracteres */
define('API_SET_CHARACTER',"SET NAMES 'utf8'");