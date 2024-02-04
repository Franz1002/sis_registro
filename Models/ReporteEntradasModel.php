<?php

class ReporteEntradasModel extends Mysql
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getEntradaTotal()
    {
        $sql = "SELECT 
        d.*,
        u.nombres_usuario,
        u.apellidos_usuario,
        a.nombre_area
    FROM 
        documento d
    LEFT JOIN 
        usuario u ON d.usuario_id = u.id_usuario
    LEFT JOIN 
        area a ON d.area_id = a.id_area;
    ";
        $data = $this->select_all($sql);
        return $data;
    }
    public function getEntradaInforme()
    {
        // Consulta 1: Resumen de Áreas y Total de Registros
        $query1 = "SELECT
        IFNULL(area.nombre_area, 'TOTAL') AS Areas,
        COUNT(documento.id_doc) AS `Total Registros`
        FROM
            area
        LEFT JOIN
            documento ON area.id_area = documento.area_id
        GROUP BY
            Areas
        WITH ROLLUP
    
        ";

        // Consulta 2: Resumen de Usuarios y Suma de Registros por Área
        $query2 = "SELECT IFNULL(CONCAT(usuario.nombres_usuario, ' ', usuario.apellidos_usuario), 'TOTAL') AS Usuarios,
        SUM(IF(area.nombre_area = 'Recursos Humanos', 1, 0)) AS `Recursos Humanos`,
        SUM(IF(area.nombre_area = 'Seguimiento Urbano', 1, 0)) AS `Seguimiento Urbano`,
        SUM(IF(area.nombre_area = 'Seguimiento Rural', 1, 0)) AS `Seguimiento Rural`,
        SUM(IF(area.nombre_area = 'Participación Social', 1, 0)) AS `Participación Social`,
        SUM(IF(area.nombre_area = 'SIE', 1, 0)) AS `SIE`,
        COUNT(*) AS `TOTAL`
        FROM
            usuario
        LEFT JOIN
            documento ON usuario.id_usuario = documento.usuario_id
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

    public function getEntradaArea(string $area_id, string $fechaDesde, string $fechaHasta)
    {
        $sql = "SELECT 
            d.*,
            u.nombres_usuario,
            u.apellidos_usuario,
            a.nombre_area
        FROM 
            documento d
        LEFT JOIN 
            usuario u ON d.usuario_id = u.id_usuario
        LEFT JOIN 
            area a ON d.area_id = a.id_area
        WHERE 
            d.area_id = '$area_id'
        AND 
            d.fecha_recepcion BETWEEN '$fechaDesde' AND '$fechaHasta'";

        $data = $this->select_all($sql);
        return $data;
    }


    public function getEntradaFecha(string $fechaDesde, string $fechaHasta)
    {
        $sql = "SELECT 
        d.*,
        u.nombres_usuario,
        u.apellidos_usuario,
        a.nombre_area
    FROM 
        documento d
    LEFT JOIN 
        usuario u ON d.usuario_id = u.id_usuario
    LEFT JOIN 
        area a ON d.area_id = a.id_area WHERE d.fecha_recepcion  
        BETWEEN '$fechaDesde' AND '$fechaHasta'";

        $data = $this->select_all($sql);
        return $data;
    }
}
?>