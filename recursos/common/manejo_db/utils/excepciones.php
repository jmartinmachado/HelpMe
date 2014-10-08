<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

    function getExceptionMessage($exc ){
        return $exc->getFile() . ' : ' . $exc->getMessage();
    }
 
 
?>
