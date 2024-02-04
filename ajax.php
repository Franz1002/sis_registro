<?php
require_once "Config/cnn.php";

if (isset($_GET['term'])) {
    $datos = array();
    $archivo = $_GET['term'];
    
    // Agrega un mensaje de registro para ver el valor de $archivo
    error_log("Valor de archivo recibido: " . $archivo);
    
    $documento = mysqli_query($conexion, "SELECT * FROM documento WHERE archivo_doc LIKE '%$archivo%'");
    
    // Agrega un mensaje de registro para ver la consulta SQL generada
    error_log("Consulta SQL: " . "SELECT * FROM documento WHERE archivo_doc LIKE '%$archivo%'");
    
    while ($row = mysqli_fetch_assoc($documento)) {
        $data['id'] = $row['id_doc'];
        $data['label'] = $row['archivo_doc'];
        $data['tituloDocs'] = $row['titulo_doc'];
        $data['hojaRutas'] = $row['hojaderuta'];
        $data['remitentes'] = $row['remitente_doc'];
        $data['archi'] = $row['archivo_doc']; // Usa la misma clave 'archi'
        array_push($datos, $data);
    }
    
    // Agrega un mensaje de registro para ver los datos encontrados en la base de datos
    error_log("Datos encontrados: " . json_encode($datos));
    
    echo json_encode($datos);
    die();
} else {
    echo 'Error en el ajax';
}
?>