<?php
/**
 * Descripción: Configuracion de la base de datos
 *
 * @package CMP
 * @author  Machado, Juan Martín
 * @version 1.0.0
 *
 * @internal Fecha de creación:   2014-08-25
 * @internal Ultima modificación: 2014-08-25
 * 
 * @internal Audit trail
 * (AAAA-MM-DD) Autor: Modificación
 * 2014-08-26 Juan Martin Machado: Se agregan nuevas operaciones a la provision
 */
class CMPDB extends MysqlDB {
	public function __construct() {
		parent::__construct(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	}
}