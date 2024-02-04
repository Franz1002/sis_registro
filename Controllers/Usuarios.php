<?php
class Usuarios extends Controllers
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

	public function usuarios()
	{
		if (!empty($_SESSION['userData']['rol_tu'] == 'Administrador')) {
			$data['page_id'] = 2;
			$data['page_tag'] = "Usuarios del Sistema";
			$data['page_title'] = "Gestor de documentos";
			$data['page_name'] = "Usuarios";
			$data['page_functions_js'] = "functions_usuarios.js";
			$this->views->getView($this, "usuarios", $data);
		} else {
			header('location: ' . base_url());
		}

	}

	public function perfil()
	{

		$data['page_tag'] = "Perfil del usuario";
		$data['page_title'] = "PERFIL";

		$data['page_functions_js'] = "functions_usuarios.js";
		$this->views->getView($this, "perfil", $data);

	}

	public function getUsuarios()
	{

		$arrData = $this->model->selectUsuarios();

		for ($i = 0; $i < count($arrData); $i++) {

			if ($arrData[$i]['estado_usuario'] == 1) {
				$arrData[$i]['estado_usuario'] = '<span class="badge badge-success">Activo</span>';
			} else {
				$arrData[$i]['estado_usuario'] = '<span class="badge badge-secondary">Inactivo</span>';
			}


			$btnView = '<button class="btn btn-round btn-info btn-sm btnViewUsuario" onClick="btnVerUsuario(' . $arrData[$i]['id_usuario'] . ')" title="Ver"><i class="fa fa-eye"></i></button>';
			$btnEdit = '<button class="btn btn-round btn-primary btn-sm btnEditUsuario" onClick="btnEditarUsuario(' . $arrData[$i]['id_usuario'] . ')" title="Editar"><i class="fa fa-pencil"></i></button>';
			$btnDelete = '<button class="btn btn-round btn-dark btn-sm btnDelUsuario" onClick="btnEliminarUsuario(' . $arrData[$i]['id_usuario'] . ')" title="Eliminar"><i class="fa fa-times"></i></button>';

			$arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';

		}
		echo json_encode($arrData, JSON_UNESCAPED_UNICODE);

		die();
	}

	public function setUsuario()
	{
		dep($_POST); die();

		$intIdUsuario = intval($_POST['idUsuario']);
		$strNombres = convertirPalabrasAMayuscula($_POST['txtNombre']);
		$strApellidos = convertirPalabrasAMayuscula($_POST['txtApellido']);
		$strCedula = $_POST['txtCi'];
		$intCelular = intval($_POST['txtCelular']);
		$strEmail = $_POST['txtEmail'];
		$strPassword = $_POST['txtPass'];
		$intTipoUsuario = $_POST['listRol'];
		$intEstado = $_POST['listStatus'];

		if ($intIdUsuario == 0) {
			$request_usuario = $this->model->registerUsuario(
				$strNombres,
				$strApellidos,
				$strCedula,
				$intCelular,
				$strEmail,
				$strPassword,
				$intTipoUsuario,
				$intEstado
			);
			$option = 1;
		} else {
			$request_usuario = $this->model->editUsuario(
				$intIdUsuario,
				$strNombres,
				$strApellidos,
				$strCedula,
				$intCelular,
				$strEmail,
				$strPassword,
				$intTipoUsuario,
				$intEstado
			);
			$option = 2;
		}

		if ($request_usuario > 0) {
			if ($option == 1) {
				$arrResponse = array('status' => true, 'msg' => 'Guardado correctamente.');
			} else if ($option == 2) {
				$arrResponse = array('statuss' => true, 'msg' => 'Actualizado correctamente.');
			} else {
				$arrResponse = array('statusss' => true, 'msg' => '¡Atención! El Usuario ya existe.');
			}
		} else if ($request_usuario == 0) {
			$arrResponse = array('statusss' => true, 'msg' => '¡Atención! El Usuario ya existe.');
		}
		echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		die();
	}

	public function getUsuario($id_usuario)
	{
		$idUsuario = intval($id_usuario);
		if ($id_usuario > 0) {
			$arrData = $this->model->selectUsuario($idUsuario);
			if (empty($arrData)) {
				$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
			} else {
				$arrResponse = array('status' => true, 'data' => $arrData);
			}

			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}

		die();
	}

	public function deleteUsuario()
	{
		if ($_POST) {
			$intIdUsuario = intval($_POST['idUsuario']);
			$requestDel = $this->model->deletUsuario($intIdUsuario);
			if ($requestDel) {
				$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado al Usuario');
			} else {
				$arrResponse = array('status' => false, 'msg' => 'Error al eliminar al Usuario.');
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	public function putPerfil()
	{


		$idUsuario = $_SESSION['idUsuario']['idusuario'];
		$strIdentificacion = $_POST['txtIdentificacion'];
		$strNombre = $_POST['txtNombre'];
		$strApellido = $_POST['txtApellido'];
		$intTelefono = intval($_POST['txtTelefono']);
		$strPassword = "";
		if (!empty($_POST['txtPassword'])) {
			$strPassword = $_POST['txtPassword'];
		}
		$request_user = $this->model->updatePerfil(
			$idUsuario,
			$strIdentificacion,
			$strNombre,
			$strApellido,
			$intTelefono,
			$strPassword
		);
		if ($request_user) {
			$_SESSION['idUsuario'];
			$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados exitósamente.');
		} else {
			$arrResponse = array("status" => false, "msg" => 'No es posible Actualizar los datos.');
		}


		echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);

		die();
	}



}
?>