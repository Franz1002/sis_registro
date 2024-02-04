<?php
class AreasModel extends Mysql
{
    public $intIdArea;
    public $strArea;
    public $strResponsable;
    public $strDescripcion;
    public $intStatus;

    public function __construct()
    {
        parent::__construct();
    }
    public function selectAreas()
    {
        $sql = "SELECT * FROM area       
        WHERE estado_area != 0 AND id_area > 0";
        $request = $this->select_all($sql);
        return $request;
    }


    public function registerArea(
        string $nombre_area, string $responsable_area,
        string $descripcion_area, int $estado_area
    ) {
        $return = "";
        $this->strArea = $nombre_area;
        $this->strResponsable = $responsable_area;
        $this->strDescripcion = $descripcion_area;
        $this->intStatus = $estado_area;

        $sql = "SELECT * FROM area WHERE nombre_area = '{$this->strArea}' AND estado_area != 0";
        $existe = $this->select_all($sql);

        if (empty($existe)) {
            $query = "INSERT INTO area(nombre_area,responsable_area,descripcion_area,estado_area) VALUES (?,?,?,?)";
            $arrData = array($this->strArea, $this->strResponsable, $this->strDescripcion, $this->intStatus);
            $request = $this->insert($query, $arrData);
            $return = $request;
        } else {
            $return = 0;
        }
        return $return;
    }
    public function getSelectArea($id_area)
    {
        $intIdArea = $id_area;
        $sql = "SELECT * FROM area WHERE id_area = $intIdArea";
        $arrData = $this->select($sql);
        return $arrData;
    }
    public function editArea(
        int $id_area,
        string $nombre_area, string $responsable_area,
        string $descripcion_area, int $estado_area
    ) {

        $this->intIdArea = $id_area;
        $this->strArea = $nombre_area;
        $this->strResponsable = $responsable_area;
        $this->strDescripcion = $descripcion_area;
        $this->intStatus = $estado_area;

        $sql = "SELECT * FROM area WHERE nombre_area = '{$this->strArea}' AND id_area != $this->intIdArea";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $query = "UPDATE area SET nombre_area = ?, responsable_area = ?,
             descripcion_area = ?, estado_area = ? WHERE id_area = $this->intIdArea ";
              $arrData = array(
                $this->strArea,
                $this->strResponsable,
                $this->strDescripcion,
                $this->intStatus
            );
            $request = $this->update($query, $arrData);
        } else {
            $request = 0;
        }
        return $request;
    }





    public function deletArea(int $id_area)
    {
        $this->intIdArea = $id_area;
        $query = "UPDATE area SET estado_area = 0 WHERE id_area = ?";
        $arrData = array($this->intIdArea);
        $request = $this->update($query, $arrData);
        return $request;
    }


}