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

class hm_usuariosDAO extends AbstractDAO{

    /**
     * Descripción: Comprueba el usuario y password
     * 
     * @author Juan Martin Machado
     * 
     * @internal Fecha de creación:   2014-10-10
     * @internal Ultima modificación: 2014-10-10
     * @internal Razón: Creacion
     * 
     * @param string $usuario  usuario  del usuario a registar 
     * @param string $password password del usuario a registar  
     * @return int Resultado de la operacion
     */
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

    /**
     * Descripción: Registrar un usuario
     * 
     * @author Juan Martin Machado
     * 
     * @internal Fecha de creación:   2014-10-10
     * @internal Ultima modificación: 2014-10-10
     * @internal Razón: Creacion
     * 
     * @param string $name      Nombre del usuario a registrar
     * @param string $email     Email del usuario a registrar 
     * @param string $password  Password del usuario a registrar 
     * @return int Resultado de la operacion
     */
    public function hm_usuariosAlta($name, $email, $password){
        $respuesta = false;
        $db        = new CMPDB();
        
        // Hacer esto solamente si el resultado tiene un caracter raro, como ser una ñ
        $db->query(API_SET_CHARACTER);
        
        $result = $db->call('hm_usuariosAlta',  $name, $email, $password);
        
        if (is_object($result) && $fila = $result->fetch_assoc()) {
            $respuesta = $fila['_id'];
        }
        
        $db->close();
        return $respuesta;
    }

    /**
     * Descripción: Verifica si un usuario existe
     * 
     * @author Juan Martin Machado
     * 
     * @internal Fecha de creación:   2014-10-10
     * @internal Ultima modificación: 2014-10-10
     * @internal Razón: Creacion
     * 
     * @param  string $usuario Email del usuario
     * @return int Resultado de la operacion
     */
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

    /**
     * Descripción: Actualiza las coordenadas de un usuario
     * 
     * @author Juan Martin Machado
     * 
     * @internal Fecha de creación:   2014-10-10
     * @internal Ultima modificación: 2014-10-10
     * @internal Razón: Creacion
     * 
     * @param string $email 
     * @param double $longitud 
     * @param double $latitud 
     * @return boolean Resultado de la operacion
     */
    public function hm_usuariosActualizarCoordenadas($email, $longitud, $latitud){
        $respuesta = true;
        $db        = new CMPDB();
        
        // Hacer esto solamente si el resultado tiene un caracter raro, como ser una ñ
        $db->query(API_SET_CHARACTER);
        
        $db->call('hm_usuariosActualizarCoordenadas',$email, $longitud, $latitud);

        $db->close();
        return $respuesta;
    }
    
    /**
     * Descripción: Busca ayuda para un usuario en un rango de espacio
     * 
     * @author Juan Martin Machado
     * 
     * @internal Fecha de creación:   2014-10-10
     * @internal Ultima modificación: 2014-10-10
     * @internal Razón: Creacion
     * 
     * @param string  $usuario   Email del usuario que pide ayuda
     * @param integer $distancia Rango de la ayuda
     * @return array  Resultado de la operacion 
     */
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
