<?php
    function manejar_fecha($f) {
        if (!empty($f)){
            $fecha=array();
            $pos = strpos($f,"-");
            if($pos!== false) $fecha = explode("-", $f);
            else{
                $pos = strpos($f,"/");
                if($pos!==false) $fecha = explode("/", $f);
            }

            if (count($fecha)==3){
                return $fecha[2] . "-" . $fecha[1] . "-" . $fecha[0];
            }else{
                return "0000-00-00";
            }
        }else{
            return "";
        }
    }
    function manejar_fecha_prima($f) {
        $fecha = explode("-", $f);
        return $fecha[2] . "-" . $fecha[1] . "-" . $fecha[0];
    }
    
    function MyErrorHandlerAPI($errno, $errstr, $errfile, $errline, $idEmpresa = NULL, $idUsuario = NULL){
        $commonDAO = New CommonDAO();
        switch ($errno) {
            case E_USER_ERROR:
                $str = 'FATAL ERROR: ' . $errstr;
                MandrillSMTP('FATAL ERROR: ' . $errstr, 'soporte@colppy.com', 'Soporte', 'Error Fatal', 'soporte@colppy.com', '', '');
            break;
            case E_USER_WARNING:
                $str = 'USER WARNING: ' . $errstr;
            break;
            case E_USER_NOTICE:
                $str = 'USER NOTICE: ' . $errstr;
            break;
            default:
                $str = 'UKNOWN ERROR Nr: ' . $errno . " | " . $errstr;
        }
        ws_debug($str); 
        $commonDAO->error_log($errno, $str, str_replace("\\", "/", $errfile), $errline, $idEmpresa, $idUsuario);
        return true;
    }
    
    function arrayToObject($d) {
        if (is_array($d)) {
            return (object) array_map(__FUNCTION__, $d);
        } else {
            return $d;
        }
    }
?>
