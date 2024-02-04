<?php

class ReporteSalidasModel extends Mysql
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getSalidaTotal()
    {
        $sql = "SELECT
        S.id_salida,
        u.nombres_usuario,
        u.apellidos_usuario,
        d.titulo_doc,
        d.hojaderuta,
        a.nombre_area,
        d.archivo_doc,
        s.destinatario_salida,
        s.fecha_salida
    FROM
        salidadoc s
    INNER JOIN
        usuario u ON s.usuario_id = u.id_usuario
    INNER JOIN
        documento d ON s.doc_id = d.id_doc
    INNER JOIN
        area a ON d.area_id = a.id_area";
        $data = $this->select_all($sql);
        return $data;
    }


    public function getSalidaInforme()
    {
        // Consulta 1: Resumen de Áreas y Total de Registros
        $query1 = "SELECT
        IFNULL(area.nombre_area, 'TOTAL') AS Areas,
        COUNT(salidadoc.id_salida) AS `Total Registros`
        FROM
            area
         LEFT JOIN
            documento ON area.id_area = documento.area_id
        LEFT JOIN
            salidadoc ON documento.id_doc = salidadoc.doc_id
         GROUP BY
            Areas
        WITH ROLLUP;  
        ";
        // Consulta 2: Resumen de Usuarios y Suma de Registros por Área
        $query2 = "SELECT
        IFNULL(CONCAT(usuario.nombres_usuario, ' ', usuario.apellidos_usuario), 'TOTAL') AS Usuarios,
        SUM(IF(area.nombre_area = 'Recursos Humanos', 1, 0)) AS `Recursos Humanos`,
        SUM(IF(area.nombre_area = 'Seguimiento Urbano', 1, 0)) AS `Seguimiento Urbano`,
        SUM(IF(area.nombre_area = 'Seguimiento Rural', 1, 0)) AS `Seguimiento Rural`,
        SUM(IF(area.nombre_area = 'Participación Social', 1, 0)) AS `Participación Social`,
        SUM(IF(area.nombre_area = 'SIE', 1, 0)) AS `SIE`,
        COUNT(*) AS `TOTAL`
       FROM
            usuario
      LEFT JOIN
            salidadoc ON usuario.id_usuario = salidadoc.usuario_id
       LEFT JOIN
            documento ON salidadoc.doc_id = documento.id_doc
       LEFT JOIN
            area ON documento.area_id = area.id_area
       GROUP BY
            Usuarios
       WITH ROLLUP;      
        ";

        // Ejecutar las consultas y obtener los resultados
        $data1 = $this->select_all($query1);
        $data2 = $this->select_all($query2);

        // Retorna los resultados
        return ['data1' => $data1, 'data2' => $data2];
    }
    public function getSalidaArea(string $area_id, string $fechaDesde, string $fechaHasta)
    {
        $sql = "SELECT
        S.id_salida,
        u.nombres_usuario,
        u.apellidos_usuario,
        d.titulo_doc,
        d.hojaderuta,
        a.nombre_area,
        d.archivo_doc,
        s.destinatario_salida,
        s.fecha_salida
    FROM
        salidadoc s
    INNER JOIN
        usuario u ON s.usuario_id = u.id_usuario
    INNER JOIN
        documento d ON s.doc_id = d.id_doc
    INNER JOIN
        area a ON d.area_id = a.id_area
        WHERE d.area_id = '$area_id'
         AND s.fecha_salida BETWEEN '$fechaDesde' AND '$fechaHasta';
    ";
        $data = $this->select_all($sql);
        return $data;
    }
    public function getSalidaFecha(string $fechaDesde, string $fechaHasta)
    {
        $sql = "SELECT
        S.id_salida,
        u.nombres_usuario,
        u.apellidos_usuario,
        d.titulo_doc,
        d.hojaderuta,
        a.nombre_area,
        d.archivo_doc,
        s.destinatario_salida,
        s.fecha_salida
    FROM
        salidadoc s
    INNER JOIN
        usuario u ON s.usuario_id = u.id_usuario
    INNER JOIN
        documento d ON s.doc_id = d.id_doc
    INNER JOIN
        area a ON d.area_id = a.id_area WHERE s.fecha_salida  
        BETWEEN '$fechaDesde' AND '$fechaHasta'";

        $data = $this->select_all($sql);
        return $data;
    }
}
?>