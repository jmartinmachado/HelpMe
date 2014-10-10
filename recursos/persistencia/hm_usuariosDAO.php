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

class hm_usuariosDAO extends AbstractDAO{

    public function hm_usuariosComprobar($usuario, $password){
        $respuesta = false;
        $db        = new CMPDB();
        
        // Hacer esto solamente si el resultado tiene un caracter raro, como ser una ñ
        $db->query(API_SET_CHARACTER);
        
        $result = $db->call('hm_usuariosComprobar',  $usuario, $password);
        if (is_object($result) && $fila = $result->fetch_assoc()) {
            $respuesta = $fila['nombre'];
        }
        
        $db->close();
        return $respuesta;
    }

    public function hm_usuariosAlta($name, $email, $password, $skills){
        $respuesta = false;
        $db        = new CMPDB();
        
        // Hacer esto solamente si el resultado tiene un caracter raro, como ser una ñ
        $db->query(API_SET_CHARACTER);
        
        $result = $db->call('hm_usuariosAlta',  $name, $email, $password, $skills);
        
        if (is_object($result) && $fila = $result->fetch_assoc()) {
            $respuesta = $fila['_id'];
        }
        
        $db->close();
        return $respuesta;
    }

    public function hm_usuariosExiste($usuario){
        $respuesta = false;
        $db        = new CMPDB();
        
        // Hacer esto solamente si el resultado tiene un caracter raro, como ser una ñ
        $db->query(API_SET_CHARACTER);
        
        $result = $db->call('hm_usuariosExiste',  $usuario);
        
        if (is_object($result) && $fila = $result->fetch_assoc()) {
            $respuesta = $fila['id'];
        }
        
        $db->close();
        return $respuesta;
    }

    public function hm_usuariosActualizarCoordenadas($email, $longitud, $latitud){
        $respuesta = true;
        $db        = new CMPDB();
        
        // Hacer esto solamente si el resultado tiene un caracter raro, como ser una ñ
        $db->query(API_SET_CHARACTER);
        
        $db->call('hm_usuariosActualizarCoordenadas',$email, $longitud, $latitud);

        $db->close();
        return $respuesta;
    }

    public function hm_usuariosBuscarAyuda($usuario, $distancia){
        $respuesta = false;
        $db        = new CMPDB();

        // Hacer esto solamente si el resultado tiene un caracter raro, como ser una ñ
        $db->query(API_SET_CHARACTER);

        $result = $db->call('hm_usuariosBuscarAyuda',  $usuario, $distancia);
        if (is_object($result)) {
            $respuesta = array();
            while($fila = $result->fetch_assoc()){
                array_push($respuesta, $fila["id_email"]);
            }
        }

        $db->close();
        return $respuesta;
    }
}
