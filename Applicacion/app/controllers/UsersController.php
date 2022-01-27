<?php

namespace App\Controllers;

use App\Core\App;
use App\Core\Controller;
use App\Models\Users;


class UsersController extends Controller{
    // Patrón para usar en expresiones regulares (admite letras acentuadas y espacios):
    protected $patron_texto = "^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$";
    protected $error_count = 0;
    protected $datos = [ 
        ['input' => "",
        'estado' => "",//class="" o class="input-error"
        'mensaje' =>"",//"mensaje de error si hay
        ],
        ['input' => "",
        'estado' => "",//class="" o class="input-error"
        'mensaje' =>"",//"mensaje de error si hay
        ],
        ['input' => "",
        'estado' => "",//class="" o class="input-error"
        'mensaje' =>"",//"mensaje de error si hay
        ],
        ['input' =>"",
        'estado' => "",//class="" o class="input-error"
        'mensaje' =>"",//"mensaje de error si hay
        ],
        ['input' =>"",
        'estado' => "",//class="" o class="input-error"
        'mensaje' =>"",//"mensaje de error si hay
        ],
        ['input' =>"",
        'estado' => "",//class="" o class="input-error"
        'mensaje' =>"",//"mensaje de error si hay
        ],
        ['input' =>"",
        'estado' => "",//class="" o class="input-error" el passwor
        'mensaje' =>"",//"mensaje de error si hay
        ],
    ];



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

    public function save_image(){
        $dest_path = './private/users/default/perfil.jpg';
        if ( isset($_FILES['archivosubido']) &&is_uploaded_file($_FILES['archivosubido']['tmp_name'])
        ) {
            $fileTmpPath = $_FILES['archivosubido']['tmp_name'];
            $mail = $_POST['mailUser'];
            $uploadFileDir = './private/users/' . $mail . '/';
            mkdir($uploadFileDir, 0777, true);
            $dest_path = $uploadFileDir . '/perfil.jpg';
            move_uploaded_file($fileTmpPath, $dest_path);
        }
        return  $dest_path;
    }
    
    public function verificar_params(){
        $this->error_count = 0;
        // Comprobar si llegaron los campos requeridos:
      //   nameUser
      if( empty($_POST['nameUser']) ){
        $this->error_count++;
        $this->datos[0][0]= "";
        $this->datos[0][1]= "input-error";
        $this->datos[0][2]= "Debe especificar el nombre";
        }else{
       // si tiene mas de 4 letras
       // Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
            if(! preg_match($this->patron_texto, $_POST['nameUser']) ){
                $this->datos[0][0]= $_POST['nameUser'];
                $this->datos[0][1]= "input-error";
                $this->datos[0][2]= "Debe especificar el nombre";
                
            }
        }
   

      //   nombreUser
      if( empty($_POST['nombreUser']) ){
        $this->error_count++;
        $this->datos[1][0]= "";
        $this->datos[1][1]= "input-error";
        $this->datos[1][2]= "Debe especificar el nombre";
        }else{
       // si tiene mas de 4 letras
       // Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
            if(! preg_match($this->patron_texto, $_POST['nameUser']) ){
                $this->datos[1][0]= $_POST['nombreUser'];
                $this->datos[1][1]= "input-error";
                $this->datos[1][2]= "Debe especificar el nombre";
            }
        }
   
      //    apellidoUser
      if( empty($_POST['apellidoUser']) ){
        $this->error_count++;
        $this->datos[2][0]= "";
        $this->datos[2][1]= "input-error";
        $this->datos[2][2]= "Debe especificar el nombre";
        }else{
       // si tiene mas de 4 letras
       // Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
            if(! preg_match($this->patron_texto, $_POST['nameUser']) ){
                $this->datos[2][0]= $_POST['apellidoUser'];
                $this->datos[2][1]= "input-error";
                $this->datos[2][2]= "Debe especificar el nombre";
            }
        }
   
     //     mailUser
     if( empty($_POST['mailUser']) ){
        $this->error_count++;
        $this->datos[3][0]= "";
        $this->datos[3][1]= "input-error";
        $this->datos[3][2]= "Debe especificar el nombre";
        }else{
       // si tiene mas de 4 letras
       // Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
            if(! preg_match($this->patron_texto, $_POST['nameUser']) ){
                $this->datos[3][0]= $_POST['mailUser'];
                $this->datos[3][1]= "input-error";
                 $this->datos[3][2]= "Debe especificar el nombre";
            }
        }
   
      //   paisUser
      if( empty($_POST['paisUser']) ){
        $this->error_count++;
        $this->datos[4][0]= "";
        $this->datos[4][1]= "input-error";
        $this->datos[4][2]= "Debe especificar el nombre";
        }else{
       // si tiene mas de 4 letras
       // Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
            if(! preg_match($this->patron_texto, $_POST['nameUser']) ){
                $this->datos[4][0]= $_POST['paisUser'];
                $this->datos[4][1]= "input-error";
                $this->datos[4][2]= "Debe especificar el nombre";
            }
        }
   
      //   telefonoUser
      if( empty($_POST['telefonoUser']) ){
        $this->error_count++;
        $this->datos[5][0]= "";
        $this->datos[5][1]= "input-error";
        $this->datos[5][2]= "Debe especificar el nombre";
        }else{
       // si tiene mas de 4 letras
       // Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
            if(! preg_match("^(\(\+?\d{2,3}\)[\*|\s|\-|\.]?(([\d][\*|\s|\-|\.]?){6})(([\d][\s|\-|\.]?){2})?|(\+?[\d][\s|\-|\.]?){8}(([\d][\s|\-|\.]?){2}(([\d][\s|\-|\.]?){2})?)?)$", $_POST['nameUser']) ){
                $this->datos[5][0]= $_POST['telefonoUser'];
                $this->datos[5][1]= "input-error";
                $this->datos[5][2]= "No coincide el patron solicitado";
            }
        }
   
      //   passwordNueva
      if( empty($_POST['passwordNueva']) ){
        $this->error_count++;
        $this->datos[5][0]= "";
        $this->datos[5][1] = "input-error";
        $this->datos[5][2]= "Debe especificar el nombre";
        }else{
       // si tiene mas de 4 letras
       // Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
        if(! preg_match("^(\(\+?\d{2,3}\)[\*|\s|\-|\.]?(([\d][\*|\s|\-|\.]?){6})(([\d][\s|\-|\.]?){2})?|(\+?[\d][\s|\-|\.]?){8}(([\d][\s|\-|\.]?){2}(([\d][\s|\-|\.]?){2})?)?)$",$_POST['passwordNueva']) ){
            $this->datos[5][0]= $_POST['telefonoUser'];
            $this->datos[5][1]= "input-error";
            $this->datos[5][2]= "No coincide el patron solicitado";
            }
        }
   
    }

    /**
     * Store a new user in the database. $this->verificar_params($_POST,$_FILES)
     */
    public function store(){
        //si los parametros tienen errores
            //reenviar form new_user
        // enviar a db y insertar
        $this->verificar_params();
        $ok = $this->error_count;
        if ( $ok == 0){
            $dest_path =  $this->save_image();
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
            $this->error_count = 0;
            header('Location: /inicio');
            exit();
        }else{
           $this->new_user($this->data);
        }
        
    }

    public function new_user($datos = null){
        if ($datos == null){
            $datos['form'] = [ 
                ['input' => "",
                'estado' => "",//class="" o class="input-error"
                'mensaje' =>"",//"mensaje de error si hay
                ],
                ['input' => "",
                'estado' => "",//class="" o class="input-error"
                'mensaje' =>"",//"mensaje de error si hay
                ],
                ['input' => "",
                'estado' => "",//class="" o class="input-error"
                'mensaje' =>"",//"mensaje de error si hay
                ],
                ['input' =>"",
                'estado' => "",//class="" o class="input-error"
                'mensaje' =>"",//"mensaje de error si hay
                ],
                ['input' =>"",
                'estado' => "",//class="" o class="input-error"
                'mensaje' =>"",//"mensaje de error si hay
                ],
                ['input' =>"",
                'estado' => "",//class="" o class="input-error"
                'mensaje' =>"",//"mensaje de error si hay
                ],
                ['input' =>"",
                'estado' => "",//class="" o class="input-error" el passwor
                'mensaje' =>"",//"mensaje de error si hay
                ],
            ];
        }
        $datos['user'] = ' ';
     
        return view('/users/create_user', compact('datos'));
    }


    public function validarLogin() {
        $user = htmlspecialchars ($_POST['userName']);
        $password = htmlspecialchars ($_POST['password']);
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

    public function getMail(){
        $idSitio= $this->model->isFree($_GET['mailUser']);
        if ($idSitio==1){
            return 1;   
        }else{
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
            $this->model->updatePassword($user, $password);
            return view('/users/dashboard-password', compact('datos'));
        } else {
            return view('/users/dashboard-password', compact('datos'));
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

    public function dash_sitios() {
        session_start();
        $datos['user'] = ' ';
        if (isset($_SESSION['user'])) {
            $datos['user'] = $_SESSION['user'];
            $datos['data'] = $this->model->getUsuario($_SESSION['user']);
            $datos['sitios'] = $this->model->getSitiosUsuario( $_SESSION['user']);
            return view('/users/dashboard-sitios', compact('datos'));
        } else {
            header('Location: /');
            exit();
        }
    }

    public function dash_platos() {
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

    public function dash_password() {
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
  


}
