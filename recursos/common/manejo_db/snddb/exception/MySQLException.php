<?php
/**
 * Descripción: Manejo de base de datos
 *
 * @package
 * @author  Cavecedo, Gabriel Alejandro
 * @version 1.0.0
 *
 * @internal Fecha de creación:   2014-08-27
 * @internal Ultima modificación: 2014-08-27
 * 
 * @internal Audit trail
 * (AAAA-MM-DD) Autor: Modificación
 */
class MySQLException extends Exception {
	public function __construct($message) {
		parent::__construct($message);
	}
}