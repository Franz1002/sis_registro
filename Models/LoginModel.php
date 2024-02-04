<?php

class LoginModel extends Mysql
{
    private $intIdUsuario;
    private $strUsuario;
    private $strPassword;
    private $strToken;

    public function __construct()
    {
        parent::__construct();
    }
    public function loginUser(string $email_usuario, string $password_usuario)
    {
        $this->strUsuario = $email_usuario;
        $this->strPassword = $password_usuario;
        $sql = "SELECT * FROM usuario
           INNER JOIN tipousuario ON tu_id = id_tu  
              WHERE email_usuario = '$this->strUsuario' and
                    password_usuario = '$this->strPassword' and
                    estado_usuario != 0 ";


        $request = $this->select($sql);
        return $request;
    }

    public function sessionLogin(int $idusuario)
    {
        $this->intIdUsuario = $idusuario;
     
        $sql = "SELECT * FROM usuario u
        INNER JOIN tipousuario t ON u.tu_id = t.id_tu                         
                        WHERE u.id_usuario = $this->intIdUsuario";
        $request = $this->select($sql);
        $_SESSION['userData'] = $request;
        return $request;
    }

    /*public function getUserEmail(string $strEmail)
    {
        $this->strUsuario = $strEmail;
        $sql = "SELECT idpersona,nombres,apellidos,status FROM persona WHERE email_user = '$this->strUsuario'
                    AND status = 1 ";
        $request = $this->select($sql);
        return $request;
    }

    public function setTokenUser(int $idpersona, string $token)
    {
        $this->intIdUsuario = $idpersona;
        $this->strToken = $token;
        $sql = "UPDATE persona SET token = ? WHERE idpersona = $this->intIdUsuario";
        $arrData = array($this->strToken);
        $request = $this->update($sql, $arrData);
        return $request;
    }

    public function getUsuario(string $email, string $token)
    {
        $this->strUsuario = $email;
        $this->strToken = $token;
        $sql = "SELECT idpersona FROM persona WHERE
                    email_user = '$this->strUsuario' and
                    token = '$this->strToken' and
                    status = 1 ";
        $request = $this->select($sql);
        return $request;
    }

    public function insertPassword(int $idpersona, string $password)
    {
        $this->intIdUsuario = $idpersona;
        $this->strPassword = $password;
        $sql = "UPDATE persona SET password = ?, token = ? WHERE idpersona = $this->intIdUsuario";
        $arrData = array($this->strPassword, "");
        $request = $this->update($sql, $arrData);
        return $request;
    }*/
}
?>