DELIMITER $$

DROP PROCEDURE IF EXISTS `hm_usuariosActualizarCoordenadas`$$
CREATE PROCEDURE `hm_usuariosActualizarCoordenadas`(

/**
 Nombre: hm_usuariosActualizarCoordenadas
 Descripción:
 Comentarios:
 Autores: Juan Martin Machado
 Audit Trail:
 */
_email    VARCHAR(30),
_longitud FLOAT,
_latitud  FLOAT
)
BEGIN

   UPDATE hm_usuarios SET hm_usuarios.latitud=_latitud, hm_usuarios.longitud=_longitud WHERE hm_usuarios.email = _email;

END$$

DELIMITER ;