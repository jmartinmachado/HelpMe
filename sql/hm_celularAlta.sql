DELIMITER $$

DROP PROCEDURE IF EXISTS `hm_celularAlta`$$
CREATE PROCEDURE `hm_celularAlta`(

/**
 Nombre: hm_celularAlta
 Descripción: 
 Comentarios:
 Autores: Juan Martin Machado
 Audit Trail: 
 */

_id_usuario INT(11), 
_celular    VARCHAR(50)
)
BEGIN
	DECLARE _idInterno INT(11);
	
	INSERT INTO hm_celular (`id_usuario`, `numero`) VALUES (_id_usuario, _celular);

    SELECT @@identity INTO _idInterno;
    SELECT _idInterno AS _id;

END$$

DELIMITER ;