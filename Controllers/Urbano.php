<?php
class Urbano extends Controllers
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

	public function urbano()
	{	
		$data['page_tag'] = "Área de Seguimiento Urbano";
		$data['page_title'] = "Área de Seguimiento Urbano";
		$data['page_functions_js'] = "functions_urbano.js";
		$this->views->getView($this, "urbano", $data);
	}



	public function getDocumentosUrbanos()
	{

		$arrData = $this->model->selectDocumentosUrbanos();

		for ($i = 0; $i < count($arrData); $i++) {

			$btnView = '<button class="btn btn-round btn-info btn-sm btnViewDocumentoUrbano" onClick="btnVerDocumentoUrbano(' . $arrData[$i]['id_doc'] . ')" title="Ver"><i class="fa fa-eye"></i></button>';
			$btnDelete = '<button class="btn btn-round btn-dark btn-sm btnDelDocumentoUrbano" onClick="btnEliminarDocumento(' . $arrData[$i]['id_doc'] . ')" title="Eliminar"><i class="fa fa-times"></i></button>';

			$arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' '  . $btnDelete . '</div>';

		}
		echo json_encode($arrData, JSON_UNESCAPED_UNICODE);

		die();
	}

}
?>