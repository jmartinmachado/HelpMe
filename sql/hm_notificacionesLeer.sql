DELIMITER $$

DROP PROCEDURE IF EXISTS `hm_notificacionesLeer`$$
CREATE PROCEDURE `hm_notificacionesLeer`(

/**
 Nombre: hm_notificacionesLeer
 Descripción: 
 Comentarios: 
 Autores: Juan Martin Machado
 Audit Trail: 
 */

_email VARCHAR(255)
)
BEGIN

SELECT DISTINCT
hp_notificaciones.id   as id_notificacion,
datos_origen.email     as victima_mail, 
datos_destino.email    as ayuda_mail,
datos_origen.latitud   as victima_latitud,
datos_origen.longitud  as victima_longitud,
datos_destino.latitud  as ayuda_latitud,
datos_destino.longitud as ayuda_longitud,
hm_fotos.foto          as foto

FROM hp_notificaciones
	JOIN hm_usuarios as datos_origen
		ON hp_notificaciones.mail_usuario_origen = datos_origen.email
		AND hp_notificaciones.estado = 0
	
	JOIN hm_usuarios as datos_destino
		ON hp_notificaciones.mail_usuario_destino = datos_destino.email
		AND datos_destino.email = _email
		
	LEFT JOIN hm_fotos
		ON hm_fotos.id_usuario = datos_origen.id
	
 LIMIT 1;


END$$

DELIMITER ;