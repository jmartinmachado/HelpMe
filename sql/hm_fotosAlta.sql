DELIMITER $$

DROP PROCEDURE IF EXISTS `hm_fotosAlta`$$
CREATE PROCEDURE `hm_fotosAlta`(

/**
 Nombre: hm_fotosAlta
 Descripción: 
 Comentarios:
 Autores: Juan Martin Machado
 Audit Trail:
 */

_id_usuario INT(11),
_foto       LONGTEXT
)
BEGIN
	DECLARE _idInterno INT(11);
	DECLARE _ids INT(11);

	select id INTO _ids from hm_fotos where hm_fotos.id_usuario = _id_usuario limit 1;
	
	IF _ids IS NULL THEN
		INSERT INTO hm_fotos (`id_usuario`, `foto`) VALUES (_id_usuario, _foto);

		SELECT @@identity INTO _idInterno;
		SELECT _idInterno AS _id;
	ELSE
		UPDATE hm_fotos SET `foto`=_foto WHERE  `id`= _ids  LIMIT 1;
		SELECT _ids AS _id;
	END IF;


END$$

DELIMITER ;
