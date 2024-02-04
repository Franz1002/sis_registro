<?php
class Social extends Controllers
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

	public function social()
	{	
		$data['page_tag'] = "Área de Participación Social";
		$data['page_title'] = "Área de Participación Social";
		$data['page_functions_js'] = "functions_social.js";
		$this->views->getView($this, "social", $data);
	}



	public function getDocumentosSocial()
	{

		$arrData = $this->model->selectDocumentosSocial();

		for ($i = 0; $i < count($arrData); $i++) {

			$btnView = '<button class="btn btn-round btn-info btn-sm btnViewDocumentoSocial" onClick="btnVerDocumentoSocial(' . $arrData[$i]['id_doc'] . ')" title="Ver"><i class="fa fa-eye"></i></button>';
			$btnDelete = '<button class="btn btn-round btn-dark btn-sm btnDelDocumentoSocial" onClick="btnEliminarDocumento(' . $arrData[$i]['id_doc'] . ')" title="Eliminar"><i class="fa fa-times"></i></button>';

			$arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' '  . $btnDelete . '</div>';

		}
		echo json_encode($arrData, JSON_UNESCAPED_UNICODE);

		die();
	}

}
?>