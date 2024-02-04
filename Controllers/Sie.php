<?php
class Sie extends Controllers
{
	public $views;
	public $model;
	public function __construct()
	{

		parent::__construct();
		session_start();
		if (empty($_SESSION['login'])) {
			header('location: ' . base_url() . '/login');
		}


	}

	public function sie()
	{	
		$data['page_tag'] = "Área de Sie";
		$data['page_title'] = "Área de Sie";
		$data['page_functions_js'] = "functions_sie.js";
		$this->views->getView($this, "sie", $data);
	}



	public function getDocumentosSie()
	{

		$arrData = $this->model->selectDocumentosSie();

		for ($i = 0; $i < count($arrData); $i++) {

			$btnView = '<button class="btn btn-round btn-info btn-sm btnViewDocumentoSie" onClick="btnVerDocumentoSie(' . $arrData[$i]['id_doc'] . ')" title="Ver"><i class="fa fa-eye"></i></button>';
			$btnDelete = '<button class="btn btn-round btn-dark btn-sm btnDelDocumentoSie" onClick="btnEliminarDocumento(' . $arrData[$i]['id_doc'] . ')" title="Eliminar"><i class="fa fa-times"></i></button>';

			$arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' '  . $btnDelete . '</div>';

		}
		echo json_encode($arrData, JSON_UNESCAPED_UNICODE);

		die();
	}

}
?>