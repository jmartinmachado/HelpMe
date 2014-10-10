DELIMITER $$

DROP PROCEDURE IF EXISTS `hm_usuariosAlta`$$
CREATE PROCEDURE `hm_usuariosAlta`(

/**
 Nombre: hm_usuariosAlta
 Descripción:
 Comentarios:
 Autores: Juan Martin Machado
 Audit Trail: 
 */

_name VARCHAR(10),
_email VARCHAR(30),
_password VARCHAR(10),
_skills INT(4)
)
BEGIN
	DECLARE _idInterno INT(11);
	
	INSERT INTO hm_usuarios (`nombre`, `password`, `email`, `skills`) VALUES (_name, _password, _email, _skills);
    
	SELECT @@identity INTO _idInterno;
    SELECT _idInterno AS _id;

END$$

DELIMITER ;