<?php
class UsuariosModel extends Mysql
{
    public $intIdUsuario;
    public $strCiUsuario;
    public $strNombres;
    public $strApellidos;
    public $strCedula;
    public $intCelular;
    public $strEmail;
    public $strPassword;
    public $intTipoUsuario;
    public $intEstado;
    public function __construct()
    {
        parent::__construct();
    }
    public function selectUsuarios()
    {
        $sql = "SELECT u.id_usuario,u.nombres_usuario,u.apellidos_usuario,u.ci_usuario,u.email_usuario,u.password_usuario,u.telefono_usuario,u.estado_usuario,c.id_tu,c.rol_tu
        FROM `usuario` u
        INNER JOIN `tipousuario` c
        ON u.tu_id = c.id_tu
        WHERE u.estado_usuario != 0 ";
        $request = $this->select_all($sql);
        return $request;
    }


    public function registerUsuario(
        string $nombres_usuario, string $apellidos_usuario, string $ci_usuario,
        int $telefono_usuario, string $email_usuario, string $password_usuario, int $tu_id, int $estado_usuario
    ) {

        $return = "";
        $this->strNombres = $nombres_usuario;
        $this->strApellidos = $apellidos_usuario;
        $this->strCedula = $ci_usuario;
        $this->intCelular = $telefono_usuario;
        $this->strEmail = $email_usuario;
        $this->strPassword = $password_usuario;
        $this->intTipoUsuario = $tu_id;
        $this->intEstado = $estado_usuario;

        $sql = "SELECT u.nombres_usuario, u.apellidos_usuario, u.ci_usuario, u.telefono_usuario, u.email_usuario, u.tu_id, 
                            t.id_tu, u.estado_usuario FROM usuario u 
                            INNER JOIN tipousuario t
                            ON u.tu_id = t.id_tu
                            WHERE u.ci_usuario = '{$this->strCedula}' or u.email_usuario = '{$this->strEmail}'";
        $existe = $this->select_all($sql);

        if (empty($existe)) {
            $query = "INSERT INTO usuario(nombres_usuario,apellidos_usuario,ci_usuario,telefono_usuario,email_usuario,password_usuario,tu_id,estado_usuario) VALUES (?,?,?,?,?,?,?,?)";
            $arrData = array(
                $this->strNombres, $this->strApellidos, $this->strCedula, $this->intCelular,
                $this->strEmail, $this->strPassword, $this->intTipoUsuario, $this->intEstado
            );
            $request = $this->insert($query, $arrData);
            $return = $request;
        } else {
            $return = 0;
        }
        return $return;
    }
    public function editUsuario(
        int $id_usuario, string $nombres_usuario, string $apellidos_usuario,
        string $ci_usuario, int $telefono_usuario, string $email_usuario, string $password_usuario,
        int $tu_id, int $estado_usuario
    ) {

        $this->intIdUsuario = $id_usuario;
        $this->strNombres = $nombres_usuario;
        $this->strApellidos = $apellidos_usuario;
        $this->strCedula = $ci_usuario;
        $this->intCelular = $telefono_usuario;
        $this->strEmail = $email_usuario;
        $this->strPassword = $password_usuario;
        $this->intTipoUsuario = $tu_id;
        $this->intEstado = $estado_usuario;

        $sql = "SELECT * FROM usuario WHERE (email_usuario = '{$this->strEmail}' AND id_usuario != $this->intIdUsuario)
                                          OR (ci_usuario = '{$this->strCedula}' AND id_usuario != $this->intIdUsuario) ";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $query = "UPDATE usuario SET nombres_usuario = ?, apellidos_usuario = ?, ci_usuario = ?,
             telefono_usuario = ?, email_usuario = ?, password_usuario = ?, tu_id = ?, estado_usuario = ?  WHERE id_usuario = $this->intIdUsuario ";
            $arrData = array(
                $this->strNombres,
                $this->strApellidos,
                $this->strCedula,
                $this->intCelular,
                $this->strEmail,
                $this->strPassword,
                $this->intTipoUsuario,
                $this->intEstado
            );
            $request = $this->update($query, $arrData);
        } else {
            $request = 0;
        }
        return $request;
    }

    public function selectUsuario(int $id_usuario)
    {
        $this->intIdUsuario = $id_usuario;
        $sql = "SELECT u.id_usuario, u.nombres_usuario, u.apellidos_usuario, u.ci_usuario, u.email_usuario,
         u.telefono_usuario, u.password_usuario, u.tu_id, t.id_tu, t.rol_tu, u.estado_usuario        
            FROM usuario u
            INNER JOIN tipousuario t
            On u.tu_id = t.id_tu WHERE u.id_usuario = $this->intIdUsuario";
        $request = $this->select($sql);
        return $request;
    }


    public function deletUsuario(int $id_usuario)
    {
        $this->intIdUsuario = $id_usuario;
        $query = "UPDATE usuario SET estado_usuario = 0 WHERE id_usuario = ? ";
        $arrData = array($this->intIdUsuario);
        $request = $this->update($query, $arrData);
        return $request;
    }

    /*   public function updatePerfil(int $idusuario, string $ci, string $nombres, string $apellidos, int $telefono, string $password){
           $this->intIdUsuario = $idusuario;
           $this->strIdentificacion = $ci;
           $this->strNombre = $nombres;
           $this->strApellido = $apellidos;
           $this->intTelefono = $telefono;
           $this->strPassword = $password;

           if($this->strPassword != "")
           {
               $sql = "UPDATE usuario SET ci=?, nombres=?, apellidos=?, telefono=?, password=? WHERE idusuario = $this->intIdUsuario ";
               $arrData = array($this->strIdentificacion,
                               $this->strNombre,
                               $this->strApellido,
                               $this->intTelefono,
                               $this->strPassword);
           }else{
               $sql = "UPDATE usuario SET ci=?, nombres=?, apellidos=?, telefono=? WHERE idusuario = $this->intIdUsuario ";
               $arrData = array($this->strIdentificacion,
                                $this->strNombre,
                                $this->strApellido,
                                $this->intTelefono);
           }
           $request = $this->update($sql,$arrData);
           return $request;
       }*/
}