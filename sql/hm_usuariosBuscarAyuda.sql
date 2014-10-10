DELIMITER $$
DROP PROCEDURE IF EXISTS `hm_usuariosBuscarAyuda` $$
CREATE PROCEDURE `hm_usuariosBuscarAyuda`(

/**
 Nombre: hm_usuariosBuscarAyuda
 Descripción: 
 Comentarios:
 Autores: Juan Martin Machado
 Audit Trail: 
 */

_email VARCHAR(30),
_dist int
)
BEGIN

declare mylon double;
declare mylat double;
declare lon1 float;
declare lon2 float;
declare lat1 float;
declare lat2 float;

-- get the original lon and lat for the userid 
select hm_usuarios.longitud, hm_usuarios.latitud into mylon, mylat from hm_usuarios where hm_usuarios.email= _email limit 1;

-- calculate lon and lat for the rectangle:
set lon1 = mylon-_dist/abs(cos(radians(mylat))*111000);
set lon2 = mylon+_dist/abs(cos(radians(mylat))*111000);
set lat1 = mylat-(_dist/111000);
set lat2 = mylat+(_dist/111000);

SELECT
destino.email   as "id_email",
origen.nombre  as "origen_nombre",
destino.nombre as "destino_nombre",
3956 * 2 * ASIN(SQRT(POWER(SIN((origen.latitud - destino.latitud) * pi()/180 / 2), 2)+COS(origen.latitud * pi()/180) * COS(destino.latitud * pi()/180) *POWER(SIN((origen.longitud - destino.longitud) * pi()/180 / 2), 2) )) as distancia
FROM hm_usuarios as destino, hm_usuarios as origen
WHERE origen.email = _email
and  origen.email <> destino.email
and destino.longitud between lon1 and lon2 and destino.latitud between lat1 and lat2;

END$$
DELIMITER ;
