<?php
/**
 * Descripción: Excepción de abstracción de base de datos MySQL
 *
 * @package
 * @author  Antico, Carlos Emmanuel
 * @version 1.0.0
 *
 * @internal Fecha de creación:   2014-08-27
 * @internal Ultima modificación: 2014-08-27
 * 
 * @internal Audit trail
 * (AAAA-MM-DD) Autor: Modificación
 */
class MySQLDatabaseException extends MySQLException {
	private $connection;
	private $lastError;
	
	public function __construct($message, $connection = null, $lastError = null) {
		parent::__construct($message);
		$this->connection = $connection;
		$this->lastError = $lastError;
	}
	
	public function getConnection() {
		return $this->connection;
	}
	
	public function getLastError() {
		return $this->lastError;
	}
}