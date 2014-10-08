<?php

/**
 * Descripción: Manejo de base de datos
 *
 * @package CMP
 * @author  Cavecedo, Gabriel Alejandro
 * @version 1.0.0
 *
 * @internal Fecha de creación:   2014-08-27
 * @internal Ultima modificación: 2014-08-27
 * 
 * @internal Audit trail
 * (AAAA-MM-DD) Autor: Modificación
 */
class MysqlDB {

    public $conn;
    private $last_error;

    /**
     * Contruye la conexión a un servidor MySQL
     */
    public function __construct($host, $username, $password, $database) {
       $this->conn = new mysqli($host, $username, $password, $database);

    }
    
    /**
     * Ejecuta una query, retornando el resultado correspondiente
     * @param string $query
     */
    public function query($query) {
        //verificar conexi�n
        if (!($this->conn instanceof mysqli)) {
            throw new MySQLDatabaseException("No hay una conexion MySQL disponible");
        }

        $result = @$this->conn->query($query);

        if ($result === false) {
            $this->last_error = mysqli_error($this->conn);
            throw new MySQLDatabaseException($this->last_error, $this->conn, $this->last_error);
        }

        return $result;
    }

    /**
     * Contruye una expresiï¿½n conteniendo los parametros suministrados
     * @param array $parameter_list
     */
    private function build_procedure_parameters($parameter_list) {
        $parameters = array();

        foreach ($parameter_list as $parameter) {
            $type = gettype($parameter);

            //determinar tipo de parametro antes de convertir a string
            if ($type == 'string') {
                $parameter = "'" . addcslashes($parameter, "\\'") . "'";
            } elseif ($type == 'NULL') {
                $parameter = 'NULL';
            } elseif ($type == 'object') {
                try {
                    $parameter = $parameter->__toString();
                } catch (Exception $__e) {
                    trigger_error(sprintf("MySQLDatabase: Objeto de clase %s no posee mï¿½todo __toString(). Valor formateado a NULL", get_class($parameter)), E_USER_WARNING);
                    $parameter = 'NULL';
                }
            }


            $parameters[] = (string) $parameter;
        }

        return implode(',', $parameters);
    }

    /**
     * Invoca una procedure con los parï¿½metros suministrados
     * @throws MySQLDatabaseException 
     */
    public function call() {
        if (!($this->conn instanceof mysqli)) {
            throw new MySQLDatabaseException("No hay una conexiï¿½n MySQL disponible");
        }

        if (func_num_args() == 0) {
            throw new MySQLDatabaseException("No se especificï¿½ un nombre de procedure");
        }

        $result = null;
        $args = func_num_args();

        //verificar si la procedure se invoca sin parï¿½metros
        if ($args == 1) {
            $procedure = func_get_arg(0);

            //construir expresiï¿½n
            $procedureCall = sprintf("CALL %s();", $procedure);
            $result = @$this->conn->query($procedureCall);

            if ($result === false) {
                $this->last_error = mysqli_error($this->conn);
                throw new MySQLDatabaseException('Error en consulta: ' . $this->last_error, $this->conn, $this->last_error);
            }
        } else {
            //obtener parï¿½metros
            $params = func_get_args();
            $procedure = array_shift($params);
            //contruir expresiï¿½n con los parï¿½metros
            $parameters = $this->build_procedure_parameters($params);

            //invocar procedure
            $procedureCall = sprintf("CALL %s(%s);", $procedure, $parameters);
            ws_debug("CMP call procedure: ".$procedureCall);
            $result = @$this->conn->query($procedureCall);
            
            if ($result === false) {
                $this->last_error = mysqli_error($this->conn);
                throw new MySQLDatabaseException('Error en consulta: ' . $this->last_error, $this->conn, $this->last_error);
            }
        }

        return $result;
    }

    /**
     * Libera un resultado mysqli
     * @param mysqli_result $result
     */
    public function free_result($result) {
        if ($result instanceof mysqli_result) {
            $result->free();
        }

        while ($this->conn->more_results() && $this->conn->next_result()) {
            $result = $this->conn->use_result();

            if ($result instanceof mysqli_result) {
                $result->free();
            }
        }
    }

    /**
     * Cierra la conexiï¿½n
     * @throws MySQLDatabaseException
     */
    public function close() {
        if (!($this->conn instanceof mysqli)) {
            throw new MySQLDatabaseException("No hay una conexiï¿½n MySQL disponible");
        }

        $this->conn->close();
    }

    private function last_error() {
        return  $this->last_error;
    }

}