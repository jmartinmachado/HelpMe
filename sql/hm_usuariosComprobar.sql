DELIMITER $$

DROP PROCEDURE IF EXISTS `hm_usuariosComprobar`$$
CREATE PROCEDURE `hm_usuariosComprobar`(

/**
 Nombre: hm_usuariosComprobar
 Descripción: 
 Comentarios: 
 Autores: Juan Martin Machado
 Audit Trail: 
 */

_email VARCHAR(30),
_password VARCHAR(30)
)
BEGIN

  select nombre from hm_usuarios where hm_usuarios.email = _email and hm_usuarios.password = _password;

END$$

DELIMITER ;