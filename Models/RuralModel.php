<?php

class RuralModel extends Mysql
{

	public function selectDocumentosRural()
	{	
		$sql = "SELECT d.id_doc, d.titulo_doc, d.hojaderuta, d.usuario_id, CONCAT(u.nombres_usuario, ' ', u.apellidos_usuario) AS 'usuario', d.area_id, a.nombre_area, d.remitente_doc, d.fecha_recepcion, d.archivo_doc
        FROM documento d
        INNER JOIN usuario u ON d.usuario_id = u.id_usuario
        INNER JOIN area a ON d.area_id = a.id_area
        WHERE d.area_id = 4";
		$request = $this->select_all($sql);
		return $request;
	}

}
?>