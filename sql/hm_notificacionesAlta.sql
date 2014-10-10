DELIMITER $$

DROP PROCEDURE IF EXISTS `hm_notificacionesAlta`$$
CREATE PROCEDURE `hm_notificacionesAlta`(

/**
 Nombre: hp_notificacionesAlta
 Descripción: 
 Comentarios: 
 Autores: Juan Martin Machado
 Audit Trail: 
 */

_mail_origen VARCHAR(255),
_mail_destino VARCHAR(255)
)
BEGIN
DECLARE _idInterno INT(11);

	INSERT INTO hp_notificaciones (`mail_usuario_origen`, `mail_usuario_destino`) VALUES (_mail_origen, _mail_destino);

    SELECT @@identity INTO _idInterno;
    SELECT _idInterno AS _id;

END$$

DELIMITER ;