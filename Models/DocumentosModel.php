<?php

class DocumentosModel extends Mysql
{
	public $strTitulo;
	public $strHoja;
	public $StrUsuario;
	public $intArea;
	public $strRemitente;
	public $strFechaR;
	public $strArchivo;
	public $intIdDocumento;
	public function __construct()
	{
		parent::__construct();
	}

	public function selectDocumentos()
	{
		$sql = "SELECT d.id_doc, d.titulo_doc, d.hojaderuta, d.usuario_id, CONCAT(u.nombres_usuario, ' ', u.apellidos_usuario) AS 'usuario', d.area_id, a.nombre_area, d.remitente_doc,d.fecha_recepcion, d.archivo_doc
        FROM documento d
        INNER JOIN usuario u ON d.usuario_id = u.id_usuario
        INNER JOIN area a ON d.area_id = a.id_area
        WHERE d.id_doc != 0";
		$request = $this->select_all($sql);
		return $request;
	}
	public function selectUltimaHojaRuta()
	{
		// Consulta SQL para obtener la última hoja de ruta ordenada por id_doc de manera descendente y limitando a 1
		$sql = "SELECT hojaderuta FROM documento ORDER BY id_doc DESC LIMIT 1";

		// Ejecutar la consulta SQL y obtener los resultados usando el método select_all de tu clase Mysql
		$result = $this->select_all($sql);

		// Verificar si hay resultados y si hay más de 0 resultados en el arreglo
		if ($result && count($result) > 0) {
			// Obtener el primer resultado (único resultado debido al LIMIT 1) del arreglo
			$row = $result[0];

			// Devolver el valor de la columna 'hojaderuta' del resultado
			return $row['hojaderuta'];
		}

		// Si no hay resultados o el arreglo está vacío, devolver null
		return null;
	}




	public function registerDocumento(
		string $titulo_doc, string $hojaderuta, int $usuario_id,
		int $area_id, string $remitente_doc, string $fecha_recepcion, string $archivo_doc
	) {

		$return = "";
		$this->strTitulo = $titulo_doc;
		$this->strHoja = $hojaderuta;
		$this->StrUsuario = $usuario_id;
		$this->intArea = $area_id;
		$this->strRemitente = $remitente_doc;
		$this->strFechaR = $fecha_recepcion;
		$this->strArchivo = $archivo_doc;
		$sql = "SELECT * FROM documento WHERE archivo_doc = '{$this->strArchivo}'";
		$existe = $this->select_all($sql);

		if (empty($existe)) {
			$query = "INSERT INTO documento(titulo_doc,hojaderuta,usuario_id,area_id,remitente_doc,fecha_recepcion,archivo_doc) VALUES (?,?,?,?,?,?,?)";
			$arrData = array(
				$this->strTitulo, $this->strHoja,
				$this->StrUsuario, $this->intArea, $this->strRemitente, $this->strFechaR, $this->strArchivo
			);
			$request = $this->insert($query, $arrData);
			$return = $request;
		} else {
			$return = 0;
		}
		return $return;
	}

	public function actualizarHojaDeRuta(int $intIdDoc, string $nueva_hojaderuta)
	{
		$query = "UPDATE documento SET hojaderuta = ? WHERE id_doc = ? ";

		$arrData = array($nueva_hojaderuta, $intIdDoc);
		if ($arrData[1] == 0) {
			$request = $this->update($query, $arrData);
			return $request;
		} else {

			$sql = "SELECT hojaderuta FROM documento WHERE id_doc = $intIdDoc";

			$request = $this->select($sql);
			return $request;
		}



	}

	public function selectDocumento(int $id_doc)
	{
		$this->intIdDocumento = $id_doc;
		$sql = "SELECT d.id_doc, d.titulo_doc, d.hojaderuta, d.usuario_id, CONCAT(u.nombres_usuario, ' ', u.apellidos_usuario) AS 'usuario', d.area_id, a.nombre_area, d.remitente_doc,d.fecha_recepcion, d.archivo_doc
        FROM documento d
        INNER JOIN usuario u ON d.usuario_id = u.id_usuario
        INNER JOIN area a ON d.area_id = a.id_area
        WHERE d.id_doc = $this->intIdDocumento";
		$request = $this->select($sql);
		return $request;
	}

	public function getDocumentoPorId(int $id_doc)
	{
		$this->intIdDocumento = $id_doc;
		$sql = "SELECT * FROM documento WHERE id_doc = $this->intIdDocumento";
		$request = $this->select($sql);
		return $request;
	}



	public function editDocumento(
		int $id_doc,
		string $titulo_doc, int $usuario_id,
		int $area_id, string $remitente_doc, string $fecha_recepcion, string $archivo_doc
	) {

		$this->intIdDocumento = $id_doc;
		$this->strTitulo = $titulo_doc;
		$this->StrUsuario = $usuario_id;
		$this->intArea = $area_id;
		$this->strRemitente = $remitente_doc;
		$this->strFechaR = $fecha_recepcion;
		$this->strArchivo = $archivo_doc;

		$sql = "SELECT * FROM documento WHERE titulo_doc = '{$this->strTitulo}' 
		AND id_doc != $this->intIdDocumento";
		$request = $this->select_all($sql);
		if (empty($request)) {

			$sqlGetOldHoja = "SELECT hojaderuta FROM documento WHERE id_doc = $this->intIdDocumento";
			$oldHojaResult = $this->select($sqlGetOldHoja);
			$oldHoja = $oldHojaResult['hojaderuta'];

			$query = "UPDATE documento SET titulo_doc = ?, hojaderuta = ?, usuario_id = ?,
			area_id = ?, remitente_doc = ?, fecha_recepcion = ?, archivo_doc = ? 
			WHERE id_doc = $this->intIdDocumento ";

			$arrData = array(
				$this->strTitulo,
				$oldHoja,
				$this->StrUsuario,
				$this->intArea,
				$this->strRemitente,
				$this->strFechaR,
				$this->strArchivo
			);

			$request = $this->update($query, $arrData);
		} else {
			$request = 0;
		}
		return $request;
	}

	public function deletDocumento($id_doc)
	{
		$this->intIdDocumento = $id_doc;
		$query = "DELETE FROM documento WHERE id_doc = $this->intIdDocumento";
		$request = $this->delete($query);
		return $request;

	}
	



}
?>