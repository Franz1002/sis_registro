<?php

class RolModel extends Mysql
{
	public $intIdTu;
	public $strRol;
	public $strDescripcion;
	public $intStatus;
	public $intIdTipo;

	public function __construct()
	{
		parent::__construct();
	}

	public function selectCargos()
	{

		//EXTRAE ROLES
		$sql = "SELECT * FROM tipousuario WHERE estado_tu != 0";
		$request = $this->select_all($sql);
		return $request;
	}

	public function registerCargo(string $rol_tu, string $descripciontu_tu, int $estado_tu)
	{
		$return = "";
		$this->strRol = $rol_tu;
		$this->strDescripcion = $descripciontu_tu;
		$this->intStatus = $estado_tu;

		$sql = "SELECT * FROM tipousuario WHERE rol_tu = '{$this->strRol}' AND estado_tu > 0";
		$existe = $this->select_all($sql);

		if (empty($existe)) {
			$query = "INSERT INTO tipousuario(rol_tu,descripcion_tu,estado_tu) VALUES (?,?,?)";
			$arrData = array($this->strRol, $this->strDescripcion, $this->intStatus);
			$request = $this->insert($query, $arrData);
			$return = $request;
		} else {
			$return = 0;
		}
		return $return;
	}
	
	public function selectTipo(int $id_tu){
		$this->intIdTipo = $id_tu;
	   $sql = "SELECT * FROM tipousuario			
			WHERE id_tu = $this->intIdTipo";
		$request = $this->select($sql);
		return $request;
	}
	public function editCargo(int $id_tu, string $rol_tu, string $descripciontu_tu, int $estado_tu)
	{
		$this->intIdTu = $id_tu;
		$this->strRol = $rol_tu;
		$this->strDescripcion = $descripciontu_tu;
		$this->intStatus = $estado_tu;

		$sql = "SELECT * FROM tipousuario WHERE rol_tu = '$this->strRol' AND id_tu != $this->intIdTu";
		$request = $this->select_all($sql);
		if (empty($request)) {
			$query = "UPDATE tipousuario SET rol_tu = ?, descripcion_tu = ?, estado_tu = ? WHERE id_tu = ?";
			$arrData = array($this->strRol, $this->strDescripcion, $this->intStatus, $this->intIdTu);
			$request = $this->update($query, $arrData);
		} else {
			$request = 0;
		}
		return $request;
	}

	public function deletTipo(int $id_tu)
	{
		$this->intIdTipo = $id_tu;
		$query = "UPDATE tipousuario SET estado_tu = 0 WHERE id_tu = ?";
		$arrData = array($this->intIdTipo);
		$request = $this->update($query, $arrData);
		return $request;
	}
	


}
?>