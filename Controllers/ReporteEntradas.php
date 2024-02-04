<?php

class ReporteEntradas extends Controllers
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

	public function reporteEntradas()
	{
		$data['page_tag'] = "REPORTES DE ENTRADAS";
		$data['page_title'] = "REPORTE DE ARCHIVO";
		$data['page_functions_js'] = "functions_reporteE.js";
		$this->views->getView($this, "reporteEntradas", $data);
	}

	public function reporteTotal()
	{
		$data = $this->model->getEntradaTotal();

		require "fpdf186/fpdf.php";

		$fpdf = new FPDF('landscape');
		$anchoPagina = $fpdf->GetPageWidth(); // Obtiene el ancho de la página en modo landscape

		$fpdf->AddPage();
		$fpdf->SetTitle('Reporte de entradas');

		$fpdf->Image('Assets/images/logo.jpg', 15, 4, 50, 45);
		$fpdf->Cell(70);
		$fpdf->SetFont('Arial', 'B', 16);
		$fpdf->SetTextColor(56, 54, 129);
		$fpdf->Cell(0, 20, utf8_decode('DIRECCIÓN DISTRITAL DE EDUCACIÓN DE SACABA'));

		$fpdf->Cell(30);
		$fpdf->Ln(30);

		$fpdf->Cell(114);
		$fpdf->SetFont('Arial', 'B', 12);
		$fpdf->SetTextColor(0, 0, 0);
		$fpdf->Cell(50, 10, 'REPORTE TOTAL DE ENTRADAS DE DOCUMENTOS', 0, 1, 'C');
		$fpdf->SetDrawColor(61, 174, 233);
		$fpdf->SetLineWidth(2.5);
		$fpdf->Line(94, 50, 205, 50);
		$fpdf->Ln(14);

		$fpdf->SetMargins(10, 0, 0);
		$fpdf->SetTitle('Reporte de entradas');
		$fpdf->SetFont('Arial', 'B', 8);
		$fpdf->SetLineWidth(1);
		$fpdf->SetFillColor(40, 40, 40);
		$fpdf->SetDrawColor(255, 255, 255);
		$fpdf->SetTextColor(255, 255, 255);
		$fpdf->Cell(12);
		$fpdf->Cell(8, 10, '#', 1, 0, 'C', true);
		$fpdf->Cell(30, 10, 'TITULO', 1, 0, 'C', true);
		$fpdf->Cell(25, 10, 'HOJA RUTA', 1, 0, 'C', true);
		$fpdf->Cell(30, 10, 'NOMB. USUARIO', 1, 0, 'C', true);
		$fpdf->Cell(30, 10, 'APE. USUARIO', 1, 0, 'C', true);
		$fpdf->Cell(32, 10, 'AREA', 1, 0, 'C', true);
		$fpdf->Cell(35, 10, 'REMITENTE', 1, 0, 'C', true);
		$fpdf->Cell(33, 10, 'FECHA RECEPCION', 1, 0, 'C', true);
		$fpdf->Cell(35, 10, 'ARCHIVO', 1, 0, 'C', true);


		$fpdf->SetTextColor(40, 40, 40);
		$fpdf->SetDrawColor(255, 255, 255);
		$fpdf->SetFillColor(230, 240, 240);
		$fpdf->Ln(10);

		$fpdf->SetFont('Arial', '', 9);


		foreach ($data as $columna) {

			$fpdf->Cell(12);
			$fpdf->Cell(8, 15, $columna['id_doc'], 1, 0, 'C', true);
			$fpdf->Cell(30, 15, $columna['titulo_doc'], 1, 0, 'C', true);
			$fpdf->Cell(25, 15, $columna['hojaderuta'], 1, 0, 'C', true);
			$fpdf->Cell(30, 15, $columna['nombres_usuario'], 1, 0, 'C', true);
			$fpdf->Cell(30, 15, $columna['apellidos_usuario'], 1, 0, 'C', true);
			$fpdf->Cell(32, 15, utf8_decode($columna['nombre_area']), 1, 0, 'C', true);
			$fpdf->Cell(35, 15, $columna['remitente_doc'], 1, 0, 'C', true);
			$fpdf->Cell(33, 15, $columna['fecha_recepcion'], 1, 0, 'C', true);

			// Obtiene la extensión del archivo
			$extension = pathinfo($columna['archivo_doc'], PATHINFO_EXTENSION);

			// Obtiene los primeros 12 caracteres si la longitud es mayor a 11
			$archivoMostrar = strlen($columna['archivo_doc']) > 11 ? substr($columna['archivo_doc'], 0, 11) : $columna['archivo_doc'];

			// Concatena la extensión si la longitud es mayor a 11
			if (strlen($columna['archivo_doc']) > 11) {
				$archivoMostrar .= '.' . $extension;
			}

			$fpdf->Cell(35, 15, utf8_decode($archivoMostrar), 1, 0, 'C', true);
			$fpdf->Ln();


			if ($fpdf->GetY() > 170) {
				$fpdf->AddPage();
				$fpdf->AliasNbPages('tpagina');

				$fpdf->SetFont('Arial', '', 10);
				$fpdf->SetY(20);
				$fpdf->SetX($anchoPagina / 2);

				// Establece un color de texto más claro (gris claro)
				$fpdf->SetTextColor(150, 150, 150);

				// Obtiene el número de página actual
				$currentPage = $fpdf->PageNo();

				// Escribe el número de página con el color de texto más claro
				$fpdf->Write(2, $currentPage . '/tpagina');

				// Restaura el color del texto a su valor original (negro)
				$fpdf->SetTextColor(0, 0, 0);


				$fpdf->Ln(10);
				$fpdf->SetMargins(10, 0, 0);
				$fpdf->SetTitle('Reporte de entradas');
				$fpdf->SetFont('Arial', 'B', 8);
				$fpdf->SetLineWidth(1);
				$fpdf->SetFillColor(40, 40, 40);
				$fpdf->SetDrawColor(255, 255, 255); // Cambio de color de las líneas
				$fpdf->SetTextColor(255, 255, 255);
				$fpdf->Cell(12);
				$fpdf->Cell(8, 10, '#', 1, 0, 'C', true); // Cambio de color de celda
				$fpdf->Cell(30, 10, 'TITULO', 1, 0, 'C', true); // Cambio de color de celda
				$fpdf->Cell(25, 10, 'HOJA RUTA', 1, 0, 'C', true); // Cambio de color de celda
				$fpdf->Cell(30, 10, 'NOMB. USUARIO', 1, 0, 'C', true); // Cambio de color de celda
				$fpdf->Cell(30, 10, 'APE. USUARIO', 1, 0, 'C', true); // Cambio de color de celda
				$fpdf->Cell(32, 10, 'AREA', 1, 0, 'C', true); // Cambio de color de celda
				$fpdf->Cell(35, 10, 'REMITENTE', 1, 0, 'C', true); // Cambio de color de celda
				$fpdf->Cell(33, 10, 'FECHA RECEPCION', 1, 0, 'C', true); // Cambio de color de celda
				$fpdf->Cell(35, 10, 'ARCHIVO', 1, 0, 'C', true); // Cambio de color de celda


				$fpdf->SetTextColor(40, 40, 40);
				$fpdf->SetDrawColor(255, 255, 255);
				$fpdf->SetFillColor(230, 240, 240);

				$fpdf->SetFont('Arial', 'B', 12);



				$fpdf->Ln(10);

				$fpdf->SetFont('Arial', '', 9);


			}

		}
		$fpdf->Output();
	}
	public function reporteInforme()
	{
		$data = $this->model->getEntradaInforme();

		require "fpdf186/fpdf.php";

		$fpdf = new FPDF('landscape');
		$anchoPagina = $fpdf->GetPageWidth(); // Obtiene el ancho de la página en modo landscape

		$fpdf->AddPage();
		$fpdf->SetTitle('Reporte de entradas');

		$fpdf->Image('Assets/images/logo.jpg', 15, 4, 50, 45);
		$fpdf->Cell(70);
		$fpdf->SetFont('Arial', 'B', 16);
		$fpdf->SetTextColor(56, 54, 129);
		$fpdf->Cell(0, 20, utf8_decode('DIRECCIÓN DISTRITAL DE EDUCACIÓN DE SACABA'));
		$fpdf->Cell(30);
		$fpdf->Ln(20);

		$fpdf->Cell(114);
		$fpdf->SetFont('Arial', 'B', 12);
		$fpdf->SetTextColor(0, 0, 0);
		$fpdf->Cell(50, 10, 'REPORTE TOTAL DE ENTRADAS DE DOCUMENTOS', 0, 1, 'C');


		$fpdf->Ln(5);
		$fpdf->Cell(80);
		// Crear la primera tabla con colores
		$fpdf->SetFont('Arial', 'B', 12);
		$fpdf->SetFillColor(40, 40, 40); // Color de fondo de la fila de encabezado
		$fpdf->SetTextColor(255, 255, 255); // Color de texto en el encabezado
		$fpdf->Cell(60, 10, utf8_decode('Área'), 1, 0, 'C', true);
		$fpdf->Cell(60, 10, 'Total Registros', 1, 1, 'C', true);
		$fpdf->SetFillColor(230, 240, 240); // Color de fondo de las filas de datos
		$fpdf->SetTextColor(0, 0, 0); // Restablecer el color de texto a negro

		foreach ($data['data1'] as $row) {
			$fpdf->Cell(80);
			$fpdf->Cell(60, 10, utf8_decode($row['Areas'] == null ? 'TOTAL' : $row['Areas']), 1);
			$fpdf->Cell(60, 10, $row['Total Registros'], 1, 1, 'C');
		}

		$fpdf->Ln(10);

		// Título de la segunda tabla
		$fpdf->Cell(0, 10, 'REPORTE DE ENTRADAS POR USUARIO', 0, 1, 'C');
		$fpdf->Ln(4);

		// Crear la segunda tabla con colores
		$fpdf->SetFont('Arial', 'B', 12);
		$fpdf->SetFillColor(40, 40, 40); // Color de fondo de la fila de encabezado
		$fpdf->SetTextColor(255, 255, 255); // Color de texto en el encabezado
		$fpdf->Cell(45, 10, 'Usuario', 1, 0, 'C', true);
		$fpdf->Cell(45, 10, 'Recursos Humanos', 1, 0, 'C', true);
		$fpdf->Cell(47, 10, 'Seguimiento Urbano', 1, 0, 'C', true);
		$fpdf->Cell(45, 10, 'Seguimiento Rural', 1, 0, 'C', true);
		$fpdf->Cell(50, 10, utf8_decode('Participación Social'), 1, 0, 'C', true);
		$fpdf->Cell(20, 10, 'SIE', 1, 0, 'C', true);
		$fpdf->Cell(25, 10, 'TOTAL', 1, 1, 'C', true);
		$fpdf->SetFillColor(230, 240, 240); // Color de fondo de las filas de datos
		$fpdf->SetTextColor(0, 0, 0); // Restablecer el color de texto a negro

		foreach ($data['data2'] as $row) {
			$fpdf->Cell(45, 10, utf8_decode($row['Usuarios'] == null ? 'TOTAL' : $row['Usuarios']), 1);
			$fpdf->Cell(45, 10, $row['Recursos Humanos'], 1, 0, 'C');
			$fpdf->Cell(47, 10, $row['Seguimiento Urbano'], 1, 0, 'C');
			$fpdf->Cell(45, 10, $row['Seguimiento Rural'], 1, 0, 'C');
			$fpdf->Cell(50, 10, $row['Participación Social'], 1, 0, 'C');
			$fpdf->Cell(20, 10, $row['SIE'], 1, 0, 'C');
			$fpdf->Cell(25, 10, $row['TOTAL'], 1, 1, 'C');
		}

		// Salida del PDF
		$fpdf->Output();
	}

	public function reporteArea()
	{
		$listArea = $_POST['reporteArea'];
		$fechaDesde = date('Y-m-d', strtotime($_POST['fecharecepcionD']));
		$fechaHasta = date('Y-m-d', strtotime($_POST['fecharecepcionH']));
		$data = $this->model->getEntradaArea($listArea, $fechaDesde, $fechaHasta);

		require "fpdf186/fpdf.php";

		$fpdf = new FPDF('landscape');
		$anchoPagina = $fpdf->GetPageWidth(); // Obtiene el ancho de la página en modo landscape

		$fpdf->AddPage();
		$fpdf->SetTitle('Reporte de entradas');

		$fpdf->Image('Assets/images/logo.jpg', 15, 4, 50, 45);
		$fpdf->Cell(70);
		$fpdf->SetFont('Arial', 'B', 16);
		$fpdf->SetTextColor(56, 54, 129);
		$fpdf->Cell(0, 20, utf8_decode('DIRECCIÓN DISTRITAL DE EDUCACIÓN DE SACABA'));

		$fpdf->Cell(30);
		$fpdf->Ln(30);

		$fpdf->Cell(114);
		$fpdf->SetFont('Arial', 'B', 12);
		$fpdf->SetTextColor(0, 0, 0);
		$fpdf->Cell(50, 10, utf8_decode('REPORTE TOTAL POR ÁREA DE ENTRADAS DE DOCUMENTOS'), 0, 1, 'C');
		$fpdf->SetDrawColor(61, 174, 233);
		$fpdf->SetLineWidth(2.5);
		$fpdf->Line(84, 50, 215, 50);
		$fpdf->Ln(14);

		$fpdf->SetMargins(10, 0, 0);
		$fpdf->SetTitle('Reporte de entradas');
		$fpdf->SetFont('Arial', 'B', 8);
		$fpdf->SetLineWidth(1);
		$fpdf->SetFillColor(40, 40, 40);
		$fpdf->SetDrawColor(255, 255, 255);
		$fpdf->SetTextColor(255, 255, 255);
		$fpdf->Cell(12);
		$fpdf->Cell(8, 10, '#', 1, 0, 'C', true);
		$fpdf->Cell(30, 10, 'TITULO', 1, 0, 'C', true);
		$fpdf->Cell(25, 10, 'HOJA RUTA', 1, 0, 'C', true);
		$fpdf->Cell(30, 10, 'NOMB. USUARIO', 1, 0, 'C', true);
		$fpdf->Cell(30, 10, 'APE. USUARIO', 1, 0, 'C', true);
		$fpdf->Cell(32, 10, 'AREA', 1, 0, 'C', true);
		$fpdf->Cell(35, 10, 'REMITENTE', 1, 0, 'C', true);
		$fpdf->Cell(33, 10, 'FECHA RECEPCION', 1, 0, 'C', true);
		$fpdf->Cell(35, 10, 'ARCHIVO', 1, 0, 'C', true);


		$fpdf->SetTextColor(40, 40, 40);
		$fpdf->SetDrawColor(255, 255, 255);
		$fpdf->SetFillColor(230, 240, 240);
		$fpdf->Ln(10);

		$fpdf->SetFont('Arial', '', 9);

		$contador = 0; // Inicializa el contador en 0
		foreach ($data as $columna) {
			$contador++; // Aumenta el contador en 1 en cada iteración
			$fpdf->Cell(12);
			$fpdf->Cell(8, 15, $contador, 1, 0, 'C', true); // Muestra el contador en lugar de $columna['id_doc']
			$fpdf->Cell(30, 15, $columna['titulo_doc'], 1, 0, 'C', true);
			$fpdf->Cell(25, 15, $columna['hojaderuta'], 1, 0, 'C', true);
			$fpdf->Cell(30, 15, $columna['nombres_usuario'], 1, 0, 'C', true);
			$fpdf->Cell(30, 15, $columna['apellidos_usuario'], 1, 0, 'C', true);
			$fpdf->Cell(32, 15, utf8_decode($columna['nombre_area']), 1, 0, 'C', true);
			$fpdf->Cell(35, 15, $columna['remitente_doc'], 1, 0, 'C', true);
			$fpdf->Cell(33, 15, $columna['fecha_recepcion'], 1, 0, 'C', true);

			// Obtiene la extensión del archivo
			$extension = pathinfo($columna['archivo_doc'], PATHINFO_EXTENSION);

			// Obtiene los primeros 12 caracteres si la longitud es mayor a 11
			$archivoMostrar = strlen($columna['archivo_doc']) > 11 ? substr($columna['archivo_doc'], 0, 11) : $columna['archivo_doc'];

			// Concatena la extensión si la longitud es mayor a 11
			if (strlen($columna['archivo_doc']) > 11) {
				$archivoMostrar .= '.' . $extension;
			}

			$fpdf->Cell(35, 15, utf8_decode($archivoMostrar), 1, 0, 'C', true);
			$fpdf->Ln();


			if ($fpdf->GetY() > 170) {
				$fpdf->AddPage();
				$fpdf->AliasNbPages('tpagina');

				$fpdf->SetFont('Arial', '', 10);
				$fpdf->SetY(20);
				$fpdf->SetX($anchoPagina / 2);

				// Establece un color de texto más claro (gris claro)
				$fpdf->SetTextColor(150, 150, 150);

				// Obtiene el número de página actual
				$currentPage = $fpdf->PageNo();

				// Escribe el número de página con el color de texto más claro
				$fpdf->Write(2, $currentPage . '/tpagina');

				// Restaura el color del texto a su valor original (negro)
				$fpdf->SetTextColor(0, 0, 0);


				$fpdf->Ln(10);
				$fpdf->SetMargins(10, 0, 0);
				$fpdf->SetTitle('Reporte de entradas');
				$fpdf->SetFont('Arial', 'B', 8);
				$fpdf->SetLineWidth(1);
				$fpdf->SetFillColor(40, 40, 40);
				$fpdf->SetDrawColor(255, 255, 255); // Cambio de color de las líneas
				$fpdf->SetTextColor(255, 255, 255);
				$fpdf->Cell(12);
				$fpdf->Cell(8, 10, '#', 1, 0, 'C', true); // Cambio de color de celda
				$fpdf->Cell(30, 10, 'TITULO', 1, 0, 'C', true); // Cambio de color de celda
				$fpdf->Cell(25, 10, 'HOJA RUTA', 1, 0, 'C', true); // Cambio de color de celda
				$fpdf->Cell(30, 10, 'NOMB. USUARIO', 1, 0, 'C', true); // Cambio de color de celda
				$fpdf->Cell(30, 10, 'APE. USUARIO', 1, 0, 'C', true); // Cambio de color de celda
				$fpdf->Cell(32, 10, 'AREA', 1, 0, 'C', true); // Cambio de color de celda
				$fpdf->Cell(35, 10, 'REMITENTE', 1, 0, 'C', true); // Cambio de color de celda
				$fpdf->Cell(33, 10, 'FECHA RECEPCION', 1, 0, 'C', true); // Cambio de color de celda
				$fpdf->Cell(35, 10, 'ARCHIVO', 1, 0, 'C', true); // Cambio de color de celda


				$fpdf->SetTextColor(40, 40, 40);
				$fpdf->SetDrawColor(255, 255, 255);
				$fpdf->SetFillColor(230, 240, 240);

				$fpdf->SetFont('Arial', 'B', 12);



				$fpdf->Ln(10);

				$fpdf->SetFont('Arial', '', 9);


			}

		}
		$fpdf->Output();
	}

	public function reporteFechaR()
	{

		$fechaDesde = date('Y-m-d', strtotime($_POST['fecharecepcionD']));
		$fechaHasta = date('Y-m-d', strtotime($_POST['fecharecepcionH']));
		$data = $this->model->getEntradaFecha($fechaDesde, $fechaHasta);



		require "fpdf186/fpdf.php";

		$fpdf = new FPDF('landscape');
		$anchoPagina = $fpdf->GetPageWidth(); // Obtiene el ancho de la página en modo landscape

		$fpdf->AddPage();
		$fpdf->SetTitle('Reporte de entradas');

		$fpdf->Image('Assets/images/logo.jpg', 15, 4, 50, 45);
		$fpdf->Cell(70);
		$fpdf->SetFont('Arial', 'B', 16);
		$fpdf->SetTextColor(56, 54, 129);
		$fpdf->Cell(0, 20, utf8_decode('DIRECCIÓN DISTRITAL DE EDUCACIÓN DE SACABA'));

		$fpdf->Cell(30);
		$fpdf->Ln(30);

		$fpdf->Cell(114);
		$fpdf->SetFont('Arial', 'B', 12);
		$fpdf->SetTextColor(0, 0, 0);
		$fpdf->Cell(50, 10, 'REPORTE TOTAL POR RANGO DE FECHAS DE ENTRADAS DE DOCUMENTOS', 0, 1, 'C');
		$fpdf->SetDrawColor(61, 174, 233);
		$fpdf->SetLineWidth(2.5);
		$fpdf->Line(67, 50, 233, 50);
		$fpdf->Ln(14);

		$fpdf->SetMargins(10, 0, 0);
		$fpdf->SetTitle('Reporte de entradas');
		$fpdf->SetFont('Arial', 'B', 8);
		$fpdf->SetLineWidth(1);
		$fpdf->SetFillColor(40, 40, 40);
		$fpdf->SetDrawColor(255, 255, 255);
		$fpdf->SetTextColor(255, 255, 255);
		$fpdf->Cell(12);
		$fpdf->Cell(8, 10, '#', 1, 0, 'C', true);
		$fpdf->Cell(30, 10, 'TITULO', 1, 0, 'C', true);
		$fpdf->Cell(25, 10, 'HOJA RUTA', 1, 0, 'C', true);
		$fpdf->Cell(30, 10, 'NOMB. USUARIO', 1, 0, 'C', true);
		$fpdf->Cell(30, 10, 'APE. USUARIO', 1, 0, 'C', true);
		$fpdf->Cell(32, 10, 'AREA', 1, 0, 'C', true);
		$fpdf->Cell(35, 10, 'REMITENTE', 1, 0, 'C', true);
		$fpdf->Cell(33, 10, 'FECHA RECEPCION', 1, 0, 'C', true);
		$fpdf->Cell(35, 10, 'ARCHIVO', 1, 0, 'C', true);


		$fpdf->SetTextColor(40, 40, 40);
		$fpdf->SetDrawColor(255, 255, 255);
		$fpdf->SetFillColor(230, 240, 240);
		$fpdf->Ln(10);

		$fpdf->SetFont('Arial', '', 9);

		$contador = 0;
		foreach ($data as $columna) {
			$contador++;
			$fpdf->Cell(12);
			$fpdf->Cell(8, 15, $contador, 1, 0, 'C', true);
			$fpdf->Cell(30, 15, $columna['titulo_doc'], 1, 0, 'C', true);
			$fpdf->Cell(25, 15, $columna['hojaderuta'], 1, 0, 'C', true);
			$fpdf->Cell(30, 15, $columna['nombres_usuario'], 1, 0, 'C', true);
			$fpdf->Cell(30, 15, $columna['apellidos_usuario'], 1, 0, 'C', true);
			$fpdf->Cell(32, 15, utf8_decode($columna['nombre_area']), 1, 0, 'C', true);
			$fpdf->Cell(35, 15, $columna['remitente_doc'], 1, 0, 'C', true);
			$fpdf->Cell(33, 15, $columna['fecha_recepcion'], 1, 0, 'C', true);

			// Obtiene la extensión del archivo
			$extension = pathinfo($columna['archivo_doc'], PATHINFO_EXTENSION);

			// Obtiene los primeros 12 caracteres si la longitud es mayor a 11
			$archivoMostrar = strlen($columna['archivo_doc']) > 11 ? substr($columna['archivo_doc'], 0, 11) : $columna['archivo_doc'];

			// Concatena la extensión si la longitud es mayor a 11
			if (strlen($columna['archivo_doc']) > 11) {
				$archivoMostrar .= '.' . $extension;
			}

			$fpdf->Cell(35, 15, utf8_decode($archivoMostrar), 1, 0, 'C', true);
			$fpdf->Ln();


			if ($fpdf->GetY() > 170) {
				$fpdf->AddPage();
				$fpdf->AliasNbPages('tpagina');

				$fpdf->SetFont('Arial', '', 10);
				$fpdf->SetY(20);
				$fpdf->SetX($anchoPagina / 2);

				// Establece un color de texto más claro (gris claro)
				$fpdf->SetTextColor(150, 150, 150);

				// Obtiene el número de página actual
				$currentPage = $fpdf->PageNo();

				// Escribe el número de página con el color de texto más claro
				$fpdf->Write(2, $currentPage . '/tpagina');

				// Restaura el color del texto a su valor original (negro)
				$fpdf->SetTextColor(0, 0, 0);


				$fpdf->Ln(10);
				$fpdf->SetMargins(10, 0, 0);
				$fpdf->SetTitle('Reporte de entradas');
				$fpdf->SetFont('Arial', 'B', 8);
				$fpdf->SetLineWidth(1);
				$fpdf->SetFillColor(40, 40, 40);
				$fpdf->SetDrawColor(255, 255, 255); // Cambio de color de las líneas
				$fpdf->SetTextColor(255, 255, 255);
				$fpdf->Cell(12);
				$fpdf->Cell(8, 10, '#', 1, 0, 'C', true); // Cambio de color de celda
				$fpdf->Cell(30, 10, 'TITULO', 1, 0, 'C', true); // Cambio de color de celda
				$fpdf->Cell(25, 10, 'HOJA RUTA', 1, 0, 'C', true); // Cambio de color de celda
				$fpdf->Cell(30, 10, 'NOMB. USUARIO', 1, 0, 'C', true); // Cambio de color de celda
				$fpdf->Cell(30, 10, 'APE. USUARIO', 1, 0, 'C', true); // Cambio de color de celda
				$fpdf->Cell(32, 10, 'AREA', 1, 0, 'C', true); // Cambio de color de celda
				$fpdf->Cell(35, 10, 'REMITENTE', 1, 0, 'C', true); // Cambio de color de celda
				$fpdf->Cell(33, 10, 'FECHA RECEPCION', 1, 0, 'C', true); // Cambio de color de celda
				$fpdf->Cell(35, 10, 'ARCHIVO', 1, 0, 'C', true); // Cambio de color de celda


				$fpdf->SetTextColor(40, 40, 40);
				$fpdf->SetDrawColor(255, 255, 255);
				$fpdf->SetFillColor(230, 240, 240);

				$fpdf->SetFont('Arial', 'B', 12);



				$fpdf->Ln(10);

				$fpdf->SetFont('Arial', '', 9);


			}

		}
		$fpdf->Output();
	}

}
?>