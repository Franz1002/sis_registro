<?php
class Rol extends Controllers
{
	public $views;
	public $model;
	public function __construct()
	{

		parent::__construct();
		session_start();
		if (empty($_SESSION['login'])) {
			header('location: ' . base_url());
		}


	}

	public function rol()
	{
		if (!empty($_SESSION['userData']['rol_tu'] == 'Administrador')) {
			$data['page_tag'] = "Tipos de usuario";
			$data['page_title'] = "Gestor de documentos";
			$data['page_functions_js'] = "functions_rol.js";
			$this->views->getView($this, "rol", $data);
		} else {
			header('location: ' . base_url());
		}

	}

	public function getRoles()
	{

		$arrData = $this->model->selectCargos();

		for ($i = 0; $i < count($arrData); $i++) {

			if ($arrData[$i]['estado_tu'] == 1) {
				$arrData[$i]['estado_tu'] = '<span class="badge badge-success">Activo</span>';
			} else {
				$arrData[$i]['estado_tu'] = '<span class="badge badge-secondary">Inactivo</span>';
			}


			$btnView = '<button class="btn btn-round btn-info btn-sm btnViewTipo" onClick="btnVerTipo(' . $arrData[$i]['id_tu'] . ')" title="Ver"><i class="fa fa-eye"></i></button>';
			$btnEdit = '<button class="btn btn-round btn-primary btn-sm btnEditTipo" onClick="btnEditarTipo(' . $arrData[$i]['id_tu'] . ')" title="Editar"><i class="fa fa-pencil"></i></button>';
			$btnDelete = '<button class="btn btn-round btn-dark btn-sm btnDelTipo" onClick="btnEliminarTipo(' . $arrData[$i]['id_tu'] . ')" title="Eliminar"><i class="fa fa-times"></i></button>';

			$arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';

		}
		echo json_encode($arrData, JSON_UNESCAPED_UNICODE);

		die();
	}

	public function getSelectCargos()
	{
		$htmlOptions = "";
		$arrData = $this->model->selectCargos();
		if (count($arrData) > 0) {
			for ($i = 0; $i < count($arrData); $i++) {
				if ($arrData[$i]['estado_tu'] == 1) {
					$htmlOptions .= '<option value="' . $arrData[$i]['id_tu'] . '">' . $arrData[$i]['rol_tu'] . '</option>';
				}
			}
		}
		echo $htmlOptions;
		die();
	}
	//registra y modifica un cargo
	public function setTu()
	{
		$intIdTu = intval($_POST['idRol']);
		$strRol = convertirPalabrasAMayuscula($_POST['txtNombre']);
		$strDescripcion = ucfirst($_POST['txtDescripcion']);
		$intEstado = intval($_POST['listStatus']);

		if ($intIdTu == 0) {
			$request_cargo = $this->model->registerCargo($strRol, $strDescripcion, $intEstado);
			$option = 1;
		} else {
			$request_cargo = $this->model->editCargo($intIdTu, $strRol, $strDescripcion, $intEstado);
			$option = 2;
		}

		if ($request_cargo > 0) {
			if ($option == 1) {
				$arrResponse = array('status' => true, 'msg' => 'Guardado correctamente.');
			} else if ($option == 2) {
				$arrResponse = array('statuss' => true, 'msg' => 'Actualizado correctamente.');
			} else {
				$arrResponse = array('statusss' => true, 'msg' => '¡Atención! El Tipo de Tsuario ya existe.');
			}
		} else if ($request_cargo == 0) {
			$arrResponse = array('statusss' => true, 'msg' => '¡Atención! El Tipo de Usuario ya existe.');
		}
		echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		die();
	}


	public function getTipo($id_tu)
	{

		$idTipo = intval($id_tu);
		if ($id_tu > 0) {
			$arrData = $this->model->selectTipo($idTipo);
			if (empty($arrData)) {
				$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
			} else {
				$arrResponse = array('status' => true, 'data' => $arrData);
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}

		die();
	}

	//Selecciona un cargo por el id y permite eliminar
	public function deleteTipo()
	{
		if ($_POST) {
			$intIdTipo = intval($_POST['idTipo']);
			$requestDel = $this->model->deletTipo($intIdTipo);
			if ($requestDel) {
				$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Tipo de Usuario');
			} else {
				$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Tipo de Usuario.');
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}
}