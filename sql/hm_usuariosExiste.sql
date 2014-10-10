DELIMITER $$

DROP PROCEDURE IF EXISTS `hm_usuariosExiste`$$
CREATE PROCEDURE `hm_usuariosExiste`(

/**
 Nombre: hm_usuariosExiste
 Descripción: 
 Comentarios: 
 Autores: Juan Martin Machado
 Audit Trail: 
 */
_email VARCHAR(30)
)
BEGIN

  SELECT id FROM hm_usuarios where hm_usuarios.email = _email;

END$$

DELIMITER ;