<?php

class DocSalidasModel extends Mysql
{
	public $intUsuarioId;
	public $intDocId;
	public $strDestinatario;
	public $strFechaS;
	public $idDocumentoSalida;
	public $intIdSalida;


	public function __construct()
	{
		parent::__construct();
	}

	public function selectDocSalidas()
	{
		$sql = "SELECT s.id_salida, s.usuario_id, s.doc_id, s.destinatario_salida,
        s.fecha_salida, CONCAT(u.nombres_usuario, ' ', u.apellidos_usuario) AS 'usuario', d.hojaderuta,
         d.titulo_doc, d.area_id, d.archivo_doc
        FROM salidadoc s
        INNER JOIN usuario u ON s.usuario_id = u.id_usuario
        INNER JOIN documento d ON s.doc_id = d.id_doc
        WHERE s.id_salida != 0";
		$request = $this->select_all($sql);
		return $request;
	}
	public function selectArchivos()
	{
		$sql = "SELECT * FROM documento       
        WHERE id_doc != 0 ";
		$request = $this->select_all($sql);
		return $request;
	}

	public function registerDocumentoSal(
		int $usuario_id, int $doc_id, string $destinatario_salida,
		string $fecha_salida
	) {

		$return = "";
		$this->intUsuarioId = $usuario_id;
		$this->intDocId = $doc_id;
		$this->strDestinatario = $destinatario_salida;
		$this->strFechaS = $fecha_salida;

		// Verificar si ya existe un registro con los mismos valores
		$sql = "SELECT * FROM salidadoc WHERE usuario_id = $this->intUsuarioId
		 AND doc_id = $this->intDocId AND
		  fecha_salida = '$this->strFechaS'
		   AND destinatario_salida = '$this->strDestinatario'";
		
		$existe = $this->select_all($sql);
		if (empty($existe)) {
			$query = "INSERT INTO salidadoc(usuario_id,doc_id,fecha_salida,destinatario_salida) VALUES (?,?,?,?)";
			$arrData = array(
				$this->intUsuarioId, $this->intDocId,
				$this->strFechaS, $this->strDestinatario
			);

			$request = $this->insert($query, $arrData);
			$return = $request;
		} else {
			$return = 0;
		}
		return $return;
	}

	public function selectDocSalida($id_salida)
	{
		$this->idDocumentoSalida = $id_salida;
		$sql = "SELECT s.id_salida, d.titulo_doc, d.hojaderuta, a.nombre_area, d.remitente_doc, 
		d.fecha_recepcion,
		CONCAT(u.nombres_usuario, ' ' , u.apellidos_usuario) as 'usuario', s.destinatario_salida,
		s.fecha_salida, d.archivo_doc, s.doc_id FROM salidadoc s
		INNER JOIN usuario u ON s.usuario_id = u.id_usuario
		INNER JOIN documento d ON s.doc_id = d.id_doc
		INNER JOIN area a ON d.area_id = a.id_area
		WHERE s.id_salida = $this->idDocumentoSalida";
		$request = $this->select($sql);
		return $request;

	}
	public function editDocumentosSal($id_salida, $usuario_id, $doc_id, $destinatario_salida, $fecha_salida)
	{
		$this->intIdSalida = $id_salida;
		$this->intUsuarioId = $usuario_id;
		$this->intDocId = $doc_id;
		$this->strDestinatario = $destinatario_salida;
		$this->strFechaS = $fecha_salida;

		$sql = "SELECT * FROM salidadoc WHERE doc_id = '{$this->intDocId}' 
		AND id_salida != '{$this->intIdSalida}' AND destinatario_salida = '{$this->strDestinatario}'";
		$request = $this->select_all($sql);
	
		if (empty($request)) {

			$query = "UPDATE salidadoc SET usuario_id = ?, doc_id = ?, fecha_salida = ?,
			destinatario_salida = ? WHERE id_salida = $this->intIdSalida";

			$arrData = array(
				$this->intUsuarioId,			
				$this->intDocId,
				$this->strFechaS,
				$this->strDestinatario
			);

			$request = $this->update($query, $arrData);
		} else {
			$request = 0;
		}

		return $request;
	}

	public function deletSalida($id_salida)
	{
		$this->intIdSalida = $id_salida;
		$query = "DELETE FROM salidadoc WHERE id_salida = $this->intIdSalida";
		$request = $this->delete($query);
		return $request;
	}





}
?>