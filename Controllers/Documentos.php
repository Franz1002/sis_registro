<?php
class Documentos extends Controllers
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

	public function documentos()
	{

		// Obtener valor del código de hoja de ruta (asumiendo que está definida en algún lugar)

		// Cargamos la vista del formulario y pasamos los datos necesarios
		$data['page_tag'] = "Recepción de documentos";
		$data['page_title'] = "Recepcion de documentos";
		$data['page_functions_js'] = "functions_documentos.js";
		$this->views->getView($this, "documentos", $data);
	}



	public function getDocumentos()
	{

		$arrData = $this->model->selectDocumentos();

		for ($i = 0; $i < count($arrData); $i++) {

			$btnView = '<button class="btn btn-round btn-info btn-sm btnViewDocumento" onClick="btnVerDocumento(' . $arrData[$i]['id_doc'] . ')" title="Ver"><i class="fa fa-eye"></i></button>';
			$btnEdit = '<button class="btn btn-round btn-primary btn-sm btnEditDocumento" onClick="btnEditarDocumento(' . $arrData[$i]['id_doc'] . ')" title="Editar"><i class="fa fa-pencil"></i></button>';
			$btnDelete = '<button class="btn btn-round btn-dark btn-sm btnDelDocumento" onClick="btnEliminarDocumento(' . $arrData[$i]['id_doc'] . ')" title="Eliminar"><i class="fa fa-times"></i></button>';

			$arrData[$i]['options'] = '<div class="text-center" style="display: flex;">' . $btnView . '' . $btnEdit . '' . $btnDelete . '</div>';

		}
		echo json_encode($arrData, JSON_UNESCAPED_UNICODE);

		die();
	}
	public function obtenerUltimaHojaDeRuta()
	{
		// Obtener la última hoja de ruta desde la base de datos
		$ultimaHoja = $this->model->selectUltimaHojaRuta();

		// Verificar si se obtuvo una hoja de ruta válida
		if ($ultimaHoja) {
			$respuesta = array('ultimaHoja' => $ultimaHoja);
		} else {
			// Si no se encontró ninguna hoja de ruta, establece un valor predeterminado
			$respuesta = array('ultimaHoja' => "00000000-000");
		}

		header('Content-Type: application/json');
		echo json_encode($respuesta);
	}


	public function setDoc()
	{
		
	
		$intIdDoc = intval($_POST['idDocumento']);
		$strTitulo = convertirPalabrasAMayuscula($_POST['txtTitulo']);
		$strHoja = $_POST['codigoHojaRuta'];
		$StrUsuario = intval($_POST['usuarioId']);
		$intArea = intval($_POST['listArea']);
		$strRemitente = convertirPalabrasAMayuscula($_POST['txtRemitente']);
		$strFechaR = $_POST['txtFechaHoraR'];

		$strArchivo = isset($_FILES['archivoDocumento']['name']) ? $_FILES['archivoDocumento']['name'] : '';
		$tmpArchivo = isset($_FILES['archivoDocumento']['tmp_name']) ? $_FILES['archivoDocumento']['tmp_name'] : '';

		$rutaBase = 'C:/xampp/htdocs/sis_registro/Assets/archivos_doc/';
		$rutaArchivoPrincipal = $rutaBase . $strArchivo; // Ruta en la carpeta principal

		// Determinar la carpeta en función del área seleccionada
		if ($intArea == 1) {
			$subCarpeta = 'Recursos_Humanos/';
		} elseif ($intArea == 2) {
			$subCarpeta = 'SIE/';
		} elseif ($intArea == 3) {
			$subCarpeta = 'Seguimiento_Urbano/';
		} elseif ($intArea == 4) {
			$subCarpeta = 'Seguimiento_Rural/';
		} elseif ($intArea == 5) {
			$subCarpeta = 'Participacion_Social/';
		} 
		// Verificar si se cargó un nuevo archivo
		if (!empty($tmpArchivo)) {
			move_uploaded_file($tmpArchivo, $rutaArchivoPrincipal);
			copy($rutaBase . $strArchivo, $rutaBase . $subCarpeta . $strArchivo);
		}

		// Generar nueva hoja de ruta con el número incrementado
		$nuevoNumero = intval(substr($strHoja, -3)) + 1;
		$nuevaHojaDeRuta = date('Ymd') . '-' . str_pad($nuevoNumero, 3, '0', STR_PAD_LEFT);

		// Actualizar la hoja de ruta en la base de datos
		$this->model->actualizarHojaDeRuta($intIdDoc, $nuevaHojaDeRuta);

		if ($intIdDoc == 0) {
			$request_documento = $this->model->registerDocumento(
				$strTitulo,
				$strHoja,
				$StrUsuario,
				$intArea,
				$strRemitente,
				$strFechaR,
				$strArchivo
			);
			$option = 1;
		} else {
			// Si no se seleccionó un nuevo archivo, mantén el valor existente
			if (empty($strArchivo)) {
				// Obtén el archivo actual del documento en la base de datos
				$documentoActual = $this->model->getDocumentoPorId($intIdDoc);
				if ($documentoActual && isset($documentoActual['archivo_doc'])) {
					$strArchivo = $documentoActual['archivo_doc'];
				}
			}
			$request_documento = $this->model->editDocumento(
				$intIdDoc,
				$strTitulo,
				$StrUsuario,
				$intArea,
				$strRemitente,
				$strFechaR,
				$strArchivo
			);
			$option = 2;
		}

		if ($request_documento > 0) {
			if ($option == 1) {
				$arrResponse = array('status' => true, 'msg' => 'Guardado correctamente.');
			} else if ($option == 2) {
				$arrResponse = array('statuss' => true, 'msg' => 'Actualizado correctamente.');
			} else {
				$arrResponse = array('statusss' => true, 'msg' => '¡Atención! El documento ya existe.');
			}
		} else if ($request_documento == 0) {
			$arrResponse = array('statusss' => true, 'msg' => '¡Atención! El documento ya existe.');
		}
		echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		die();
	}


	public function getDocumento($id_doc)
	{

		$idDocumento = intval($id_doc);
		if ($id_doc > 0) {
			$arrData = $this->model->selectDocumento($idDocumento);
			if (empty($arrData)) {
				$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
			} else {
				$arrResponse = array('status' => true, 'data' => $arrData);
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}

		die();
	}
	public function deleteDocumento()
	{
		if ($_POST) {
			$intIdDocumento = intval($_POST['idDocumento']);
			$requestDel = $this->model->deletDocumento($intIdDocumento);
			if ($requestDel) {
				$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el documento');
			} else {
				$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el documento.');
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}

}
?>