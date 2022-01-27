<?php

namespace App\Controllers;

use App\Core\App;
use App\Core\Controller;


use App\Models\Sitio;
use App\Models\Plato;
use App\Models\Users;

class UsersController extends Controller{
    // Patrón para usar en expresiones regulares (admite letras acentuadas y espacios):
    protected $patron_pass = "^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$^";
    protected $patron_texto = "^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$^";
    protected $patron_tel = "^(\(\+?\d{2,3}\)[\*|\s|\-|\.]?(([\d][\*|\s|\-|\.]?){6})(([\d][\s|\-|\.]?){2})?|(\+?[\d][\s|\-|\.]?){8}(([\d][\s|\-|\.]?){2}(([\d][\s|\-|\.]?){2})?)?)$^";

    public function __construct(){
        $this->model = new Users();
        $this->Platos = new Plato();
        $this->Sitios = new Sitio();
    }

    /**
     * Show all users.
     */
    public function index(){
        $users = $this->model->get();
        return view('users', compact('users'));
    }

    public function save_image($FILES){
        $dest_path = './private/users/default/perfil.jpg';
        if ( isset($FILES['archivosubido']) &&is_uploaded_file($FILES['archivosubido']['tmp_name'])
        ) {
            $fileTmpPath = $FILES['archivosubido']['tmp_name'];
            $mail = $_POST['mailUser'];
            $uploadFileDir = './private/users/' . $mail . '/';
            mkdir($uploadFileDir, 0777, true);
            $dest_path = $uploadFileDir . '/perfil.jpg';
            move_uploaded_file($fileTmpPath, $dest_path);
        }
        $dest_path = substr($dest_path, 1);
        return  $dest_path;
    }
    
    public function verificar_params($POST,$datos){
        $error_count = 0;
        // Comprobar si llegaron los campos requeridos:
      //   nameUser
      if( empty($POST['nameUser']) ){
        $error_count++;
        $datos[0][0]= "";
        $datos[0][1]= "input-error";
        $datos[0][2]= "Completa este campo";
        }else{
       // si tiene mas de 4 letras
       // Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
            if(! preg_match("^[a-z0-9_-]{3,16}$^", $POST['nameUser']) ){
                $error_count++;
                $datos[0][0]= $POST['nameUser'];
                $datos[0][1]= "input-error";
                $datos[0][2]= "Debe especificar el nombre";
                
            }
        }
   

      //   nombreUser
      if( empty($POST['nombreUser']) ){
        $error_count++;
        $datos[1][0]= "";
        $datos[1][1]= "input-error";
        $datos[1][2]= "Completa este campo";
        }else{
       // si tiene mas de 4 letras
       // Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
            if(! preg_match($this->patron_texto, $POST['nombreUser']) ){
                $error_count++;
                $datos[1][0]= $POST['nombreUser'];
                $datos[1][1]= "input-error";
                $datos[1][2]= "Debe especificar el nombre";
            }
        }
   
      //    apellidoUser
      if( empty($POST['apellidoUser']) ){
        $error_count++;
        $datos[2][0]= "";
        $datos[2][1]= "input-error";
        $datos[2][2]= "Completa este campo";
        }else{
       // si tiene mas de 4 letras
       // Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
            if(! preg_match($this->patron_texto, $POST['apellidoUser']) ){
                $error_count++;
                $datos[2][0]= $POST['apellidoUser'];
                $datos[2][1]= "input-error";
                $datos[2][2]= "Completa este campo";
            }
        }
   
     //     mailUser
     if( empty($POST['mailUser']) ){
        $error_count++;
        $datos[3][0]= "";
        $datos[3][1]= "input-error";
        $datos[3][2]= "Completa este campo";
        }else{
       // si tiene mas de 4 letras
       // Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
       if (!filter_var($POST['mailUser'], FILTER_VALIDATE_EMAIL)) {
        $error_count++;
                $datos[3][0]= $POST['mailUser'];
                $datos[3][1]= "input-error";
                $datos[3][2]= "Incluye un signo '@' en la dirección de correo electrónico.";
            }
        }
   
      //   paisUser
      if( empty($POST['paisUser']) ){
        $error_count++;
        $datos[4][0]= "";
        $datos[4][1]= "input-error";
        $datos[4][2]= "Completa este campo";
        }else{
       // si tiene mas de 4 letras
       // Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
            if(! preg_match($this->patron_texto, $POST['nameUser']) ){
                $error_count++;
                $datos[4][0]= $POST['paisUser'];
                $datos[4][1]= "input-error";
                $datos[4][2]= "Debe especificar el nombre";
            }
        }
   
      //   telefonoUser
      if( empty($POST['telefonoUser']) ){
        $error_count++;
        $datos[5][0]= "";
        $datos[5][1]= "input-error";
        $datos[5][2]= "Completa este campo";
        }else{
       // si tiene mas de 4 letras
       // Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
            if(! preg_match($this->patron_tel, $POST['nameUser']) ){
                $error_count++;
                $datos[5][0]= $POST['telefonoUser'];
                $datos[5][1]= "input-error";
                $datos[5][2]= "Haz coincidir el formato solicitado.";
            }
        }
   
      //   passwordNueva
      if( empty($POST['passwordNueva']) ){
        $error_count++;
        $datos[5][0]= "";
        $datos[5][1] = "input-error";
        $datos[5][2]= "Completa este campo";
        }else{
       // si tiene mas de 4 letras
       // Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
        if(! preg_match($this->patron_pass,$POST['passwordNueva']) ){
            $error_count++;
            $datos[5][0]= $POST['telefonoUser'];
            $datos[5][1]= "input-error";
            $datos[5][2]= "Haz coincidir el formato solicitado.";
            }
        }
        $datos['errores'] = $error_count;
        return $datos;
    }

    /**
     * Store a new user in the database.  $datos['form'] 
     */
    public function store(){
        //si los parametros tienen errores
            //reenviar form new_user
        // enviar a db y insertar
        $datos =  [ 
            
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
            ['errores' => 0],
        ];
        $this->verificar_params($_POST,$datos);
        $ok = $datos[7]['errores'];
        if ( $ok == 0){
              $dest_path =  $this->save_image($_FILES);
          //  $dest_path = substr($dest_path, 1);
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
            if ( $statement == 1){   
                return  $this->new_user($datos);
               
            }else{
             return view('/errors/not-found');
            }
        }else{
           $this->new_user($datos);
        }
    }

    public function new_user($datos = null){
        if ($datos == null){
            $datos = [ 
            
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
                ['errores' => 0],
            ];
          
        }
        $datos['form']= $datos;
        $datos['user'] = ' ';
        // var_dump($datos);
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
        $datas =  [ 
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
            ['errores' => 0],
        ];
        session_start();
        $datos['user'] = ' ';
        if (isset($_SESSION['user'])) {
            $datos['user'] = $_SESSION['user'];
            $this->verificar_params($_POST,$datos);
            $ok = $datos[7]['errores'];
                if ( $ok == 0){
                    $user = $_POST['mailUser'];
                    $nombre = $_POST['nombreUser'];
                    $apellido = $_POST['apellidoUser'];
                    $ubicacion = $_POST['ubicacionUser'];
                    $telefono = $_POST['telefonoUser'];
                    $statement = $this->model->updateUsuario( $user, $nombre, $apellido, $ubicacion, $telefono );
                    if ($statement == 1) {
                      $data = $this->model->getUsuario($_SESSION['user']);
                      $datas[0] =$data[0];
                      $datas[1] =$data[1];
                      $datas[2] =$data[2];
                      $datas[3] =$data[3];
                      $datas[4] =$data[4];
                      $datos['data']  = $datas;
                      return view('/users/dashboard', compact('datos'));
                    } else {
                        return view('/errors/internal-error', compact('datos'));
                    }
                }else{
                    $datos['data']  = $datas;
                     return view('/users/dashboard', compact('datos'));
                    }
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

    public function cargarSitios() {
        $datos = $this->model->getUsuario($_SESSION['user']);
        return view('/sitios/NearSitios', compact('data'));
    }

    public function dash(){
        $datas =  [ 
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
            ['errores' => 0],
        ];
        session_start();
        $datos['user'] = ' ';
        if (isset($_SESSION['user'])) {
            $datos['user'] = $_SESSION['user'];
            $data = $this->model->getUsuario($_SESSION['user']);
            $datas[0]['input'] = $data[0]->nombreUsuario;
            $datas[1]['input'] = $data[0]->nombre;
            $datas[2]['input'] = $data[0]->apellido;
            $datas[3]['input'] = $data[0]->mail;
            $datas[4]['input'] = $data[0]->pais;
            $datas[6]['input'] = $data[0]->telefono;
            $datas[5]['input'] = $data[0]->direccion;
            $datas[7]['input'] = $data[0]->fotoPerfil;
            $datos['data']  = $datas;
            return view('/users/dashboard', compact('datos'));
        } else {
            header('Location: /inicio');
            exit();
        }
    }

    public function dash_sitios() {
        $datas =  [ 
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
            ['errores' => 0],
        ];
            session_start();
            $datos['user'] = ' ';
            if (isset($_SESSION['user'])) {
                $datos['user'] = $_SESSION['user'];
                $data = $this->model->getUsuario($_SESSION['user']);
                $datas[0]['input'] = $data[0]->nombreUsuario;
                $datas[1]['input'] = $data[0]->nombre;
                $datas[2]['input'] = $data[0]->apellido;
                $datas[3]['input'] = $data[0]->mail;
                $datas[4]['input'] = $data[0]->pais;
                $datas[6]['input'] = $data[0]->telefono;
                $datas[5]['input'] = $data[0]->direccion;
                $datas[7]['input'] = $data[0]->fotoPerfil;
                $datos['data']  = $datas;
            $datos['sitios'] = $this->model->getSitiosUsuario( $_SESSION['user']);
            return view('/users/dashboard-sitios', compact('datos'));
        } else {
            header('Location: /');
            exit();
        }
    }

    public function dash_platos() {
        $datas =  [ 
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
            ['errores' => 0],
        ];
        session_start();
            $datos['user'] = ' ';
            if (isset($_SESSION['user'])) {
                $datos['user'] = $_SESSION['user'];
                $data = $this->model->getUsuario($_SESSION['user']);
                $datas[0]['input'] = $data[0]->nombreUsuario;
                $datas[1]['input'] = $data[0]->nombre;
                $datas[2]['input'] = $data[0]->apellido;
                $datas[3]['input'] = $data[0]->mail;
                $datas[4]['input'] = $data[0]->pais;
                $datas[6]['input'] = $data[0]->telefono;
                $datas[5]['input'] = $data[0]->direccion;
                $datas[7]['input'] = $data[0]->fotoPerfil;
                $datos['data']  = $datas;

            $datos['platos'] = $this->Sitios->getPlatosFromSitios( $_GET['Sitio'] );
            $data = $this->Sitios->getNombreSitios(htmlspecialchars($_GET['Sitio']));
            $datos['idSitio'] = $data[0]->idSitio;
            $datos['NameSitio'] = $data[0]->nombre;
            return view('/users/dashboard-platos', compact('datos'));
        } else {
            header('Location: /');
            exit();
        }
    }

    public function dash_password($datos = null) {
        $datas =  [ 
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
            ['errores' => 0],
        ];
        session_start();
            $datos['user'] = ' ';
            if (isset($_SESSION['user'])) {
                $datos['user'] = $_SESSION['user'];
                $data = $this->model->getUsuario($_SESSION['user']);
                $datas[0]['input'] = $data[0]->nombreUsuario;
                $datas[1]['input'] = $data[0]->nombre;
                $datas[2]['input'] = $data[0]->apellido;
                $datas[3]['input'] = $data[0]->mail;
                $datas[4]['input'] = $data[0]->pais;
                $datas[6]['input'] = $data[0]->telefono;
                $datas[5]['input'] = $data[0]->direccion;
                $datas[7]['input'] = $data[0]->fotoPerfil;
                $datos['data']  = $datas;
            return view('/users/dashboard-password', compact('datos'));
        } else {
            header('Location: /');
            exit();
        }
    }
  


}
