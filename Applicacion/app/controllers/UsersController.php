<?php

namespace App\Controllers;

use App\Core\App;
use App\Core\Controller;
use App\Models\Users;


class UsersController extends Controller{

      


    public function __construct(){
        $this->model = new Users();
    }

    /**
     * Show all users.
     */
    public function index(){
        $users = $this->model->get();
        return view('users', compact('users'));
    }

    /**
     * Store a new user in the database.
     */
    public function store(){
        $dest_path = './private/users/default/perfil.jpg';
        if (
            isset($_FILES['archivosubido']) &&
            is_uploaded_file($_FILES['archivosubido']['tmp_name'])
        ) {
            $fileTmpPath = $_FILES['archivosubido']['tmp_name'];
            $mail = $_POST['mailUser'];
            $uploadFileDir = './private/users/' . $mail . '/';
            mkdir($uploadFileDir, 0777, true);
            $dest_path = $uploadFileDir . '/perfil.jpg';
            move_uploaded_file($fileTmpPath, $dest_path);
        }
        $dest_path = substr($dest_path, 1);
        $statement = $this->model->agregarUsuario(
            $_POST['nameUser'],
            $_POST['nombreUser'],
            $_POST['apellidoUser'],
            $_POST['mailUser'],
            $_POST['paisUser'],
            $_POST['telefonoUser'],
            $_POST['passwordNueva'],
            $dest_path
        );
        header('Location: /inicio');
        exit();
    }

    public function validarLogin() {
        $user = $_POST['userName'];
        $password = $_POST['password'];
        $statement = $this->model->validarLogin($user, $password);
        if ($statement == 1) {
            // Start the session
            session_start();
            $s = $this->model->getDatosUsuario($user);
            $_SESSION['user'] = $s[0]->nombreUsuario;
            return 1;
        } else {
            return 0;
        }
    }

    public function actualizarPerfil()  {
        $user = $_POST['mailUser'];
        $nombre = $_POST['nombreUser'];
        $apellido = $_POST['apellidoUser'];
        $ubicacion = $_POST['ubicacionUser'];
        $telefono = $_POST['telefonoUser'];
        $statement = $this->model->updateUsuario(
            $user,
            $nombre,
            $apellido,
            $ubicacion,
            $telefono
        );
        if ($statement == 1) {
            session_start();
            $datos['user'] = ' ';
            if (isset($_SESSION['user'])) {
                $datos['user'] = $_SESSION['user'];
                $datos['data'] = $this->model->getUsuario($_SESSION['user']);
                return view('/users/dashboard', compact('datos'));
            }
        } else {
            return view('/errors/internal-error', compact('datos'));
        }
    }

    public function actualizarPassword(){
        $user = $_POST['userName'];
        $passwordOLD = $_POST['passwordAntigua'];
        $password = $_POST['passwordNueva'];
        $statement = $this->model->validarLogin($user, $passwordOLD);
        if ($statement == 1) {
            return $this->model->updatePassword($user, $password);
        } else {
            return 0;
        }
    }

    public function cerrarLogin()
    {
        session_start();
        unset($_SESSION['user']);
        unset($datos['user']);
        session_destroy();
        return 1;
    }

    public function cargarSitios()
    {
        $datos = $this->model->getUsuario($_SESSION['user']);
        return view('/sitios/NearSitios', compact('data'));
    }

    public function dash(){
        session_start();
        $datos['user'] = ' ';
        if (isset($_SESSION['user'])) {
            $datos['user'] = $_SESSION['user'];
            $datos['data'] = $this->model->getUsuario($_SESSION['user']);
            return view('/users/dashboard', compact('datos'));
        } else {
            header('Location: /inicio');
            exit();
        }
    }

    public function dash_sitios()
    {
        session_start();
        $datos['user'] = ' ';
        if (isset($_SESSION['user'])) {
            $datos['user'] = $_SESSION['user'];

            $datos['data'] = $this->model->getUsuario($_SESSION['user']);
            $datos['sitios'] = $this->model->getSitiosUsuario(
                $_SESSION['user']
            );
            return view('/users/dashboard-sitios', compact('datos'));
        } else {
            header('Location: /');
            exit();
        }
    }

    public function dash_platos()
    {
        session_start();
        $datos['user'] = ' ';
        if (isset($_SESSION['user'])) {
            $datos['user'] = $_SESSION['user'];
            $datos['data'] = $this->model->getUsuario($_SESSION['user']);
            $datos['platos'] = $this->model->getPlatosFromSitios(
                $_GET['Sitio']
            );
            $data = $this->model->getNombreSitios(htmlspecialchars($_GET['Sitio']));
            $datos['idSitio'] = $data[0]->idSitio;
            $datos['NameSitio'] = $data[0]->nombre;
            return view('/users/dashboard-platos', compact('datos'));
        } else {
            header('Location: /');
            exit();
        }
    }

    public function dash_password()
    {
        session_start();
        $datos['user'] = ' ';
        if (isset($_SESSION['user'])) {
            $datos['user'] = $_SESSION['user'];
            $datos['data'] = $this->model->getUsuario($_SESSION['user']);
            return view('/users/dashboard-password', compact('datos'));
        } else {
            header('Location: /');
            exit();
        }
    }

    public function new_user(){
        $datos = '';
        return view('/users/create_user', compact('datos'));
    }
}
