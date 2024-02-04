<?php
class Areas extends Controllers
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

	public function areas()
	{
		if (!empty($_SESSION['userData']['rol_tu'] == 'Administrador')) {
			$data['page_tag'] = "Áreas de la Dirección Distrital";
			$data['page_title'] = "Gestor de documentos";
			$data['page_functions_js'] = "functions_areas.js";
			$this->views->getView($this, "areas", $data);
		} else {
			header('location: ' . base_url());
		}

	}

	public function getAreas()
	{

		$arrData = $this->model->selectAreas();

		for ($i = 0; $i < count($arrData); $i++) {

			if ($arrData[$i]['estado_area'] == 1) {
				$arrData[$i]['estado_area'] = '<span class="badge badge-success">Activo</span>';
			} else {
				$arrData[$i]['estado_area'] = '<span class="badge badge-secondary">Inactivo</span>';
			}


			$btnView = '<button class="btn btn-round btn-info btn-sm btnViewArea" onClick="btnVerArea(' . $arrData[$i]['id_area'] . ')" title="Ver"><i class="fa fa-eye"></i></button>';
			$btnEdit = '<button class="btn btn-round btn-primary btn-sm btnEditArea" onClick="btnEditarArea(' . $arrData[$i]['id_area'] . ')" title="Editar"><i class="fa fa-pencil"></i></button>';
			$btnDelete = '<button class="btn btn-round btn-dark btn-sm btnDelArea" onClick="btnEliminarArea(' . $arrData[$i]['id_area'] . ')" title="Eliminar"><i class="fa fa-times"></i></button>';

			$arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';

		}

		echo json_encode($arrData, JSON_UNESCAPED_UNICODE);

	}
	public function getSelectAreas()
	{
		$htmlOptions = "";
		$arrData = $this->model->selectAreas();
		if (count($arrData) > 0) {
			for ($i = 0; $i < count($arrData); $i++) {
				if ($arrData[$i]['estado_area'] == 1) {
					$htmlOptions .= '<option value="' . $arrData[$i]['id_area'] . '">' . $arrData[$i]['nombre_area'] . '</option>';
				}
			}
		}
		echo $htmlOptions;
		die();
	}

	public function setArea()
	{

		$intIdArea = intval($_POST['idArea']);
		$strArea = convertirPalabrasAMayuscula($_POST['txtNombre']);
		$strResponsable = convertirPalabrasAMayuscula(($_POST['txtResponsable']));
		$strDescripcion = ucfirst($_POST['txtDescripcion']);
		$intEstado = intval($_POST['listStatus']);

		if ($intIdArea == 0) {
			$request_area = $this->model->registerArea(
				$strArea,
				$strResponsable,
				$strDescripcion,
				$intEstado
			);
			$option = 1;
		} else {
			$request_area = $this->model->editArea(
				$intIdArea,
				$strArea,
				$strResponsable,
				$strDescripcion,
				$intEstado
			);
			$option = 2;
		}

		if ($request_area > 0) {
			if ($option == 1) {
				$arrResponse = array('status' => true, 'msg' => 'Guardado correctamente.');
			} else if ($option == 2) {
				$arrResponse = array('statuss' => true, 'msg' => 'Actualizado correctamente.');
			} else {
				$arrResponse = array('statusss' => true, 'msg' => '¡Atención! El Área ya existe.');
			}
		} else if ($request_area == 0) {
			$arrResponse = array('statusss' => true, 'msg' => '¡Atención! El Área ya existe.');
		}
		echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		die();
	}
	public function getArea($id_area)
	{

		$idArea = intval($id_area);
		if ($id_area > 0) {
			$arrData = $this->model->getSelectArea($idArea);
			if (empty($arrData)) {
				$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
			} else {
				$arrResponse = array('status' => true, 'data' => $arrData);
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}

		die();
	}
	public function deleteArea()
	{
		if ($_POST) {
			$intIdArea = intval($_POST['idArea']);
			$requestDel = $this->model->deletArea($intIdArea);
			if ($requestDel) {
				$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Área');
			} else {
				$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Área.');
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}



}
?>