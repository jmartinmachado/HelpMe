<?php

/**
 * Descripción: Archivo con las funciones para generar logs
 *
 * @package  
 * @author  Machado, Juan Martín
 * @version 1.0.0
 *
 * @internal Fecha de creación:   2014-09-02
 * @internal Ultima modificación: 2014-09-02
 * 
 * @internal Audit trail
 * (AAAA-MM-DD) Autor: Modificación
 */

class logs{
    public $nombre_log;
    public $historial;
    public $txt;
    public function __construct($_nombre_log,$_historial){
        $this->nombre_log = $_nombre_log;
        $this->historial  = $_historial;
        if (file_exists($this->nombre_log) && !$this->historial){
            unlink($this->nombre_log);
        }
    }
    public function aniadir($texto){
        $this->txt .= $texto;
    }
    public function guardar(){
        $fp = fopen($this->nombre_log,"a");
        fwrite($fp,$this->txt);
        fclose($fp);
        $this->txt = "";
    }
}

function ws_debug(){
    global $_log;
    $argumentos = func_get_args();
    $hora = date("Y-m-d H:i:s") . " ";
    foreach ($argumentos as $argumento) {
        $texto = "";
        switch (gettype($argumento)) {
            case 'string':
                $texto = $hora . $argumento ;
            break;
            default:
                ob_start();
                print_r($argumento);
                $texto .= ob_get_contents();
                ob_end_clean();
            break;
        }
        #if (!empty($texto)){
            #$texto = preg_replace("/\s+/", " ", $texto);
            $_log->aniadir($texto . PHP_EOL);
        #}
    }
    $_log->guardar();
}
