<?php
class DocSalidas extends Controllers
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

	public function docSalidas()
	{
		// Cargamos la vista del formulario y pasamos los datos necesarios
		$data['page_tag'] = "Salidas de documentos";
		$data['page_title'] = "Salidas de documentos";
		$data['page_functions_js'] = "functions_docsalidas.js";
		$this->views->getView($this, "docSalidas", $data);
	}



	public function getDocSalidas()
	{

		$arrData = $this->model->selectDocSalidas();

		for ($i = 0; $i < count($arrData); $i++) {

			if ($arrData[$i]['area_id'] == 1) {
				$arrData[$i]['area_id'] = 'Recursos Humanos';
			} elseif ($arrData[$i]['area_id'] == 2) {
				$arrData[$i]['area_id'] = 'SIE';

			} elseif ($arrData[$i]['area_id'] == 3) {
				$arrData[$i]['area_id'] = 'Seguimiento Urbano';
			} elseif ($arrData[$i]['area_id'] == 4) {
				$arrData[$i]['area_id'] = 'Seguimiento Rural';
			} elseif ($arrData[$i]['area_id'] == 5) {
				$arrData[$i]['area_id'] = 'Participación Social';
			} elseif ($arrData[$i]['area_id'] == 6) {
				$arrData[$i]['area_id'] = 'Area Prueba';
			} elseif ($arrData[$i]['area_id'] == 7) {
				$arrData[$i]['area_id'] = 'Area Prueba';
			}

			$btnView = '<button class="btn btn-round btn-info btn-sm btnViewDocSalida" onClick="btnVerDocSalida(' . $arrData[$i]['id_salida'] . ')" title="Ver"><i class="fa fa-eye"></i></button>';
			$btnEdit = '<button class="btn btn-round btn-primary btn-sm btnEditDocSalida" onClick="btnEditarDocSalida(' . $arrData[$i]['id_salida'] . ')" title="Editar"><i class="fa fa-pencil"></i></button>';
			$btnDelete = '<button class="btn btn-round btn-dark btn-sm btnDelDocSalida" onClick="btnEliminarDocSalida(' . $arrData[$i]['id_salida'] . ')" title="Eliminar"><i class="fa fa-times"></i></button>';

			$arrData[$i]['options'] = '<div class="text-center" style="display: flex;">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';

		}

		echo json_encode($arrData, JSON_UNESCAPED_UNICODE);

		die();
	}
	public function getSelectArchivos()
	{
		$htmlOptions = "";
		$arrData = $this->model->selectArchivos();
		if (count($arrData) > 0) {

			for ($i = 0; $i < count($arrData); $i++) {
				if ($arrData[$i]['id_doc'] > 0) {
					$htmlOptions .= '<option value="' . $arrData[$i]['id_doc'] . '">' . $arrData[$i]['archivo_doc'] . '</option>';
				}
			}
		}
		echo $htmlOptions;
		die();
	}

	public function setDocS()
	{		
		$intIdDocS = intval($_POST['idSalidas']);
		$intUsuarioId = intval($_POST['usuarioId']);
		$intDocId = intval($_POST['listArchivo']);
		$strDestinatario = convertirPalabrasAMayuscula($_POST['txtDestinatario']);
		$strFechaS = $_POST['txtFechaHoraS'];

		if ($intIdDocS == 0) {
			$request_documentoSal = $this->model->registerDocumentoSal(
				$intUsuarioId,
				$intDocId,
				$strDestinatario,
				$strFechaS
			);
			$option = 1;

		} else {
			$request_documentoSal = $this->model->editDocumentosSal($intIdDocS,$intUsuarioId, $intDocId, $strDestinatario, $strFechaS);

			$option = 2;
		}

		if ($request_documentoSal > 0) {
			if ($option == 1) {
				$arrResponse = array('status' => true, 'msg' => 'Guardado correctamente.');
			} else if ($option == 2) {
				$arrResponse = array('statuss' => true, 'msg' => 'Actualizado correctamente.');
			} else {
				$arrResponse = array('statusss' => true, 'msg' => '¡Atención! El documento ya existe.');
			}
		} else if ($request_documentoSal == 0) {
			$arrResponse = array('statusss' => true, 'msg' => '¡Atención! El documento ya existe.');
		}
		echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		die();
	}

	public function getDocSalida($id_salida)
	{

		$idDocumentoSalida = intval($id_salida);
		if ($id_salida > 0) {
			$arrData = $this->model->selectDocSalida($idDocumentoSalida);
			if (empty($arrData)) {
				$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
			} else {
				$arrResponse = array('status' => true, 'data' => $arrData);
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}

		die();
	}

	public function deleteSalida()
	{
		if ($_POST) {
			$intIdSalida = intval($_POST['idSalidas']);
			$requestDel = $this->model->deletSalida($intIdSalida);
			if ($requestDel) {
				$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la salida del Documento');
			} else {
				$arrResponse = array('status' => false, 'msg' => 'Error al eliminar la salida del Documento.');
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}

}




?>