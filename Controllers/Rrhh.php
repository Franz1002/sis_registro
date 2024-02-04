<?php
class Rrhh extends Controllers
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

	public function rrhh()
	{	
		$data['page_tag'] = "Área de Recursos Humanos";
		$data['page_title'] = "Área de Recursos Humanos";
		$data['page_functions_js'] = "functions_rrhh.js";			
		$this->views->getView($this, "rrhh", $data);
	}



	public function getDocumentosRrhh()
	{

		$arrData = $this->model->selectDocumentosRrhh();

		for ($i = 0; $i < count($arrData); $i++) {

			$btnView = '<button class="btn btn-round btn-info btn-sm btnViewDocumentoRrhh" onClick="btnVerDocumentoRrhh(' . $arrData[$i]['id_doc'] . ')" title="Ver"><i class="fa fa-eye"></i></button>';
			$btnDelete = '<button class="btn btn-round btn-dark btn-sm btnDelDocumentoRrhh" onClick="btnEliminarDocumento(' . $arrData[$i]['id_doc'] . ')" title="Eliminar"><i class="fa fa-times"></i></button>';

			$arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' '  . $btnDelete . '</div>';

		}
		echo json_encode($arrData, JSON_UNESCAPED_UNICODE);

		die();
	}

}
?>