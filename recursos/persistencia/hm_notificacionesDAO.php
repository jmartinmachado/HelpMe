<?php
/**
 * Descripción: Esta clase encarga de manejar la tabla hm_usuariosDAO
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

class hm_notificacionesDAO extends AbstractDAO{

    /**
     * Descripción: Genera una nueva notificacion para un usuario
     * 
     * @author Juan Martin Machado
     * 
     * @internal Fecha de creación:   2014-10-10
     * @internal Ultima modificación: 2014-10-10
     * @internal Razón: Creacion
     *
     * @param  string $email_origen  Origen de la notificacion
     * @param  string $email_destino Destino de la notificacion
     * @return int    Resultado de la Operacion 
     */
    public function hm_notificacionesAlta($email_origen, $email_destino){
        $respuesta = false;
        $db        = new CMPDB();
        
        // Hacer esto solamente si el resultado tiene un caracter raro, como ser una ñ
        $db->query(API_SET_CHARACTER);
        
        $result = $db->call('hm_notificacionesAlta',  $email_origen, $email_destino);
        
        if (is_object($result) && $fila = $result->fetch_assoc()) {
            $respuesta = $fila['_id'];
        }
        
        $db->close();
        return $respuesta;
    }

    /**
     * Descripción: Obtiene las notificaiones del usuario
     * 
     * @author Juan Martin Machado
     * 
     * @internal Fecha de creación:   2014-10-10
     * @internal Ultima modificación: 2014-10-10
     * @internal Razón: Creacion
     * 
     * @param  string $email email del usario a notificar
     * @return array  Resultado de la operacion
     */
    public function hm_notificacionesLeer($email){
        $respuesta = false;
        $db        = new CMPDB();
        
        // Hacer esto solamente si el resultado tiene un caracter raro, como ser una ñ
        $db->query(API_SET_CHARACTER);
        
        $result = $db->call('hm_notificacionesLeer',  $email);
        
        if (is_object($result) && $fila = $result->fetch_assoc()) {
            $respuesta = $fila;
        }
        
        $db->close();
        return $respuesta;
    }

    /**
     * Descripción: Actualiza el estado de las notificaciones a leida
     * 
     * @author Juan Martin Machado
     * 
     * @internal Fecha de creación:   2014-10-10
     * @internal Ultima modificación: 2014-10-10
     * @internal Razón: Creacion
     * 
     * @param  int $id Id de la notificacion
     * @return int Resultado de la operacion 
     */
    public function hm_notificacionesActualizar($id){
        $respuesta = true;
        $db        = new CMPDB();
        
        // Hacer esto solamente si el resultado tiene un caracter raro, como ser una ñ
        $db->query(API_SET_CHARACTER);
        
        $db->call('hm_notificacionesActualizar',$id);

        $db->close();
        return $respuesta;
    }


}
