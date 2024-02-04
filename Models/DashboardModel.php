<?php

class DashboardModel extends Mysql
{
    public function __construct()
    {
        parent::__construct();
    }

    public function totalTipoUsuario()
    {
        $sql = "SELECT COUNT(*) AS total_tipos_usuario FROM tipousuario WHERE estado_tu != 0";
        $request = $this->select($sql); 

        if ($request) {
            return $request['total_tipos_usuario'];
        } else {
            return 0;
        }
    }
    public function totalUsuarios()
    {
        $sql = "SELECT COUNT(*) AS total_usuarios FROM usuario WHERE estado_usuario != 0";
        $request = $this->select($sql); 

        if ($request) {
            return $request['total_usuarios'];
        } else {
            return 0;
        }
    }
    public function totalAreas()
    {
        $sql = "SELECT COUNT(*) AS total_areas FROM area WHERE estado_area != 0";
        $request = $this->select($sql); 

        if ($request) {
            return $request['total_areas'];
        } else {
            return 0;
        }
    }
    public function totalRRrhh()
    {
        $sql = "SELECT COUNT(*) AS total_RRrhh FROM documento WHERE area_id = 1 AND id_doc > 0";
        $request = $this->select($sql); 

        if ($request) {
            return $request['total_RRrhh'];
        } else {
            return 0;
        }
    }
    public function totalRSie()
    {
        $sql = "SELECT COUNT(*) AS total_RSie FROM documento WHERE area_id = 2 AND id_doc > 0";
        $request = $this->select($sql); 

        if ($request) {
            return $request['total_RSie'];
        } else {
            return 0;
        }
    }
    public function totalRUrbano()
    {
        $sql = "SELECT COUNT(*) AS total_RUrbano FROM documento WHERE area_id = 3 AND id_doc > 0";
        $request = $this->select($sql); 

        if ($request) {
            return $request['total_RUrbano'];
        } else {
            return 0;
        }
    }
    public function totalRRural()
    {
        $sql = "SELECT COUNT(*) AS total_RRural FROM documento WHERE area_id = 4 AND id_doc > 0";
        $request = $this->select($sql); 

        if ($request) {
            return $request['total_RRural'];
        } else {
            return 0;
        }
    }
    public function totalRSocial()
    {
        $sql = "SELECT COUNT(*) AS total_RSocial FROM documento WHERE area_id = 5 AND id_doc > 0";
        $request = $this->select($sql); 

        if ($request) {
            return $request['total_RSocial'];
        } else {
            return 0;
        }
    }
    
    public function totalRecepcionados()
    {
        $sql = "SELECT COUNT(*) AS total_Recepcionados FROM documento WHERE id_doc > 0";
        $request = $this->select($sql); 

        if ($request) {
            return $request['total_Recepcionados'];
        } else {
            return 0;
        }
    }
    public function totalSRrhh()
    {
        $sql = "SELECT COUNT(*) AS total_registros
        FROM salidadoc
        INNER JOIN documento ON salidadoc.doc_id = documento.id_doc
        INNER JOIN area ON documento.area_id = area.id_area
        WHERE area.id_area = 1 AND id_salida > 0";
        $request = $this->select($sql); 

        if ($request) {
            return $request['total_registros'];
        } else {
            return 0;
        }
    }
    public function totalSSie()
    {
        $sql = "SELECT COUNT(*) AS total_registros
        FROM salidadoc
        INNER JOIN documento ON salidadoc.doc_id = documento.id_doc
        INNER JOIN area ON documento.area_id = area.id_area
        WHERE area.id_area = 2 AND id_salida > 0";
        $request = $this->select($sql); 

        if ($request) {
            return $request['total_registros'];
        } else {
            return 0;
        }
    }
    public function totalSUrbano()
    {
        $sql = "SELECT COUNT(*) AS total_registros
        FROM salidadoc
        INNER JOIN documento ON salidadoc.doc_id = documento.id_doc
        INNER JOIN area ON documento.area_id = area.id_area
        WHERE area.id_area = 3 AND id_salida > 0";
        $request = $this->select($sql); 

        if ($request) {
            return $request['total_registros'];
        } else {
            return 0;
        }
    }
    public function totalSRural()
    {
        $sql = "SELECT COUNT(*) AS total_registros
        FROM salidadoc
        INNER JOIN documento ON salidadoc.doc_id = documento.id_doc
        INNER JOIN area ON documento.area_id = area.id_area
        WHERE area.id_area = 4 AND id_salida > 0";
        $request = $this->select($sql); 

        if ($request) {
            return $request['total_registros'];
        } else {
            return 0;
        }
    }
    public function totalSSocial()
    {
        $sql = "SELECT COUNT(*) AS total_registros
        FROM salidadoc
        INNER JOIN documento ON salidadoc.doc_id = documento.id_doc
        INNER JOIN area ON documento.area_id = area.id_area
        WHERE area.id_area = 5 AND id_salida > 0";
        $request = $this->select($sql); 

        if ($request) {
            return $request['total_registros'];
        } else {
            return 0;
        }
    }
    public function totalSalidas()
    {
        $sql = "SELECT COUNT(*) AS total_registros
        FROM salidadoc
        INNER JOIN documento ON salidadoc.doc_id = documento.id_doc
        INNER JOIN area ON documento.area_id = area.id_area
        WHERE id_salida > 0";
        $request = $this->select($sql); 

        if ($request) {
            return $request['total_registros'];
        } else {
            return 0;
        }
    }



}
?>