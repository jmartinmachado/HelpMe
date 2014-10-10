DELIMITER $$

DROP PROCEDURE IF EXISTS `hm_notificacionesActualizar`$$
CREATE PROCEDURE `hm_notificacionesActualizar`(

/**
 Nombre: hm_notificacionesActualizar
 Descripción: 
 Comentarios: 
 Autores: Juan Martin Machado
 Audit Trail: 
 */

_id INT(11)
)	
BEGIN

UPDATE hp_notificaciones SET estado = 1 WHERE  hp_notificaciones.id =_id;

END$$

DELIMITER ;