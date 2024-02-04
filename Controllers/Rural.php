<?php
class Rural extends Controllers
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

	public function rural()
	{	
		$data['page_tag'] = "Área de Seguimiento Rural";
		$data['page_title'] = "Área de Seguimiento Rural";
		$data['page_functions_js'] = "functions_rural.js";
		$this->views->getView($this, "rural", $data);
	}



	public function getDocumentosRural()
	{

		$arrData = $this->model->selectDocumentosRural();

		for ($i = 0; $i < count($arrData); $i++) {

			$btnView = '<button class="btn btn-round btn-info btn-sm btnViewDocumentoRural" onClick="btnVerDocumentoRural(' . $arrData[$i]['id_doc'] . ')" title="Ver"><i class="fa fa-eye"></i></button>';
			$btnDelete = '<button class="btn btn-round btn-dark btn-sm btnDelDocumentoRural" onClick="btnEliminarDocumento(' . $arrData[$i]['id_doc'] . ')" title="Eliminar"><i class="fa fa-times"></i></button>';

			$arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' '  . $btnDelete . '</div>';

		}
		echo json_encode($arrData, JSON_UNESCAPED_UNICODE);

		die();
	}

}
?>