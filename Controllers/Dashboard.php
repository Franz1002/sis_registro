<?php

class Dashboard extends Controllers
{
	public $views;
	public $model;

	public function __construct()
	{
		parent::__construct();
		session_start();
	
		if (empty($_SESSION['login'])) {
			header('location: ' . BASE_URL);
		}
	}

	public function dashboard()
	{
		$data['page_id'] = 2;
		$data['page_tag'] = "Resumen de estadísticas";
		$data['page_title'] = "Gestor de documentos";
		$data['page_name'] = "Dashboard";
		$data['page_functions_js'] = "functions_dashboard.js";

		$data['totalTipos'] = $this->totalTipo();
		$data['totalUsuarios'] = $this->totalUsuarios();
		$data['totalAreas'] = $this->totalAreas();
		$data['totalRRrhh']= $this->totalRRrhh();
		$data['totalRSie']= $this->totalRSie();
		$data['totalRUrbano']= $this->totalRUrbano();
		$data['totalRRural']= $this->totalRRural();
		$data['totalRSocial']= $this->totalRSocial();
		$data['totalRecepcionados']= $this->totalRecepcionados();
		
		$data['totalSRrhh']= $this->totalSRrhh();
		$data['totalSSie']= $this->totalSSie();
		$data['totalSUrbano']= $this->totalSUrbano();
		$data['totalSRural']= $this->totalSRural();
		$data['totalSSocial']= $this->totalSSocial();
		$data['totalSalidas']= $this->totalSalidas();
		$this->views->getView($this, "dashboard", $data);

	}
	public function totalTipo()
	{
		$totalTiposUsuario = $this->model->totalTipoUsuario();
		return $totalTiposUsuario;
	}
	public function totalUsuarios()
	{
		$totalUsuarios = $this->model->totalUsuarios();
		return $totalUsuarios;
	}
	public function totalAreas()
	{
		$totalAreas = $this->model->totalAreas();
		return $totalAreas;
	}
	public function totalRRrhh()
	{
		$totalRRrhh = $this->model->totalRRrhh();
		return $totalRRrhh;
	}
	public function totalRSie()
	{
		$totalRSie = $this->model->totalRSie();
		return $totalRSie;
	}
	public function totalRUrbano()
	{
		$totalRUrbano = $this->model->totalRUrbano();
		return $totalRUrbano;
	}
	public function totalRRural()
	{
		$totalRRural = $this->model->totalRRural();
		return $totalRRural;
	}
	public function totalRSocial()
	{
		$totalRSocial = $this->model->totalRSocial();
		return $totalRSocial;
	}

	public function totalRecepcionados()
	{
		$totalRecepcionados = $this->model->totalRecepcionados();
		return $totalRecepcionados;
	}
	public function totalSRrhh()
	{
		$totalSRrhh = $this->model->totalSRrhh();
		return $totalSRrhh;
	}
	public function totalSSie()
	{
		$totalSSie = $this->model->totalSSie();
		return $totalSSie;
	}
	public function totalSUrbano()
	{
		$totalSUrbano = $this->model->totalSUrbano();
		return $totalSUrbano;
	}
	public function totalSRural()
	{
		$totalSRural = $this->model->totalSRural();
		return $totalSRural;
	}
	public function totalSSocial()
	{
		$totalSSocial = $this->model->totalSSocial();
		return $totalSSocial;
	}

	public function totalSalidas()
	{
		$totalSalidas = $this->model->totalSalidas();
		return $totalSalidas;
	}


}

?>