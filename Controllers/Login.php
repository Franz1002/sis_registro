<?php

class Login extends Controllers
{
    public $views;
    public $model;
    public function __construct()
    {
        session_start();     
        if (isset($_SESSION['login'])) {
            header('location: ' . BASE_URL . '/dashboard');
        }
        parent::__construct();
    }

    public function login()
    {

        $data['page_tag'] = "Sistema de Registro de documentos";
        $data['page_title'] = "Login";
        $data['page_functions_js'] = "functions_login.js";
        $this->views->getView($this, "login", $data);
    }

    public function loginUser()
    {
     //   dep($_POST);
        if ($_POST) {
            if (empty($_POST['txtEmailLog']) || empty($_POST['txtPasswordLog'])) {
                $arrResponse = array('status' => false, 'msg' => 'Error de datos');
            } else {
                $strUsuario = strtolower(strClean($_POST['txtEmailLog']));
                $strPassword = $_POST['txtPasswordLog'];
                $requestUser = $this->model->loginUser($strUsuario, $strPassword);
                if (empty($requestUser)) {
                    $arrResponse = array('status' => false, 'msg' => 'El correo o la contraseña es incorrecto.');
                } else {
                    $arrData = $requestUser;
                    if ($arrData['estado_usuario'] == 1) {
                        $_SESSION['idUser'] = $arrData['id_usuario'];
                        $_SESSION['login'] = true;
                        $_SESSION['timeout'] = true;
                        $_SESSION['inicio'] = time();

                        $arrData = $this->model->sessionLogin($_SESSION['idUser']);

                        sessionUser($_SESSION['idUser']);	
                        //$_SESSION['idUser'] = $arrData;
                        
                        $arrResponse = 1;
                    } else {
                        $arrResponse = array('status' => false, 'msg' => 'Usuario inactivo.');
                    }
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header('location: ' . base_url());

    }
}