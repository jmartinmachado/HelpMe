<?php
/**
 * Descripción: Esta clase encarga de manejar la tabla hm_celularDAO
 *
 * @package 
 * @author  Juan Martin Machado
 * @version 1.0.0
 *
 * @internal Fecha de creación:   2014-10-10
 * @internal Ultima modificación: 2014-10-10
 * 
 * @internal Audit trail
 * (AAAA-MM-DD) Autor: Modificación
 */

class hm_celularDAO extends AbstractDAO{

    /**
     * Descripción: Guarda el celular de un usuario
     * 
     * @author Juan Martin Machado
     * 
     * @internal Fecha de creación:   2014-10-10
     * @internal Ultima modificación: 2014-10-10
     * @internal Razón: Creacion
     *
     * @param  integer $id_usuario ID del usuario para dar de alta el numero
     * @param  string  $celular    Numero de celular 
     * @return int     Resultado de la operacion
     */
    public function hm_celularAlta($id_usuario, $celular){
        $respuesta = false;
        $db        = new CMPDB();
        
        // Hacer esto solamente si el resultado tiene un caracter raro, como ser una ñ
        $db->query(API_SET_CHARACTER);
        
        $result = $db->call('hm_celularAlta',  $id_usuario, $celular);
        
        if (is_object($result) && $fila = $result->fetch_assoc()) {
            $respuesta = $fila['_id'];
        }
        
        $db->close();
        return $respuesta;
    }
}
