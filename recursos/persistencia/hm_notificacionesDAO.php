<?php
/**
 * Descripción: Esta clase encarga de manejar la tabla hm_usuariosDAO
 *
 * @package 
 * @author  Juan Martin Machado
 * @version 1.0.0
 *
 * @internal Fecha de creación:   2014-08-26
 * @internal Ultima modificación: 2014-08-26
 * 
 * @internal Audit trail
 * (AAAA-MM-DD) Autor: Modificación
 */

class hm_notificacionesDAO extends AbstractDAO{

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
