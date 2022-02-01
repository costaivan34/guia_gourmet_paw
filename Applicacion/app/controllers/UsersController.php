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

   
    
    public function verificar_params($POST,$FILES,$datos){
        $extensiones = array(0=>'image/jpg',1=>'image/jpeg',2=>'image/png');
        $error_count = 0;
        // Comprobar si llegaron los campos requeridos:
        //   nameUser
        $POST['nameUser'] = filter_var($POST['nameUser'], FILTER_SANITIZE_STRING);
        if( empty($POST['nameUser']) ){
            $error_count++;
            $datos[0]['input']= $POST['nameUser'];
            $datos[0]['estado']= "input-error";
            $datos[0]['mensaje']= "Completa este campo";
            }else{
                // si tiene mas de 4 letras
                // Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
                $datos[0]['input'] = $POST['nameUser'];
                if( strlen( $POST['nameUser'] ) < 4 ){
                    $error_count++;
                   
                    $datos[0]['estado'] = "input-error";
                    $datos[0]['mensaje'] = "Alarga el texto a 4 o más caracteres";
            }
        }

         //   nombreUser
        $POST['nombreUser'] = filter_var($POST['nombreUser'], FILTER_SANITIZE_STRING);
        if( empty($POST['nombreUser']) ){
            $error_count++;
            $datos[1]['input']= $POST['nombreUser'];
            $datos[1]['estado']= "input-error";
            $datos[1]['mensaje']= "Completa este campo";
            }else{
                // si tiene mas de 4 letras
                // Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
                $datos[1]['input'] = $POST['nombreUser'];
                if( strlen( $POST['nombreUser'] ) < 4 ){
                    $error_count++;
                    
                    $datos[1]['estado'] = "input-error";
                    $datos[1]['mensaje'] = "Alarga el texto a 4 o más caracteres";
            }
        }
     
          //    apellidoUser
        $POST['apellidoUser'] = filter_var($POST['apellidoUser'], FILTER_SANITIZE_STRING);
        if( empty($POST['apellidoUser']) ){
            $error_count++;
            $datos[2]['input']= $POST['apellidoUser'];
            $datos[2]['estado']= "input-error";
            $datos[2]['mensaje']= "Completa este campo";
            }else{
                // si tiene mas de 4 letras
                // Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
                $datos[2]['input'] = $POST['apellidoUser'];
                if( strlen( $POST['apellidoUser'] ) < 4 ){
                    $error_count++;
                   
                    $datos[2]['estado'] = "input-error";
                    $datos[2]['mensaje'] = "Alarga el texto a 4 o más caracteres";
            }
        }
    
     
        //  mailUser
        $POST['mailUser'] = filter_var($POST['mailUser'], FILTER_SANITIZE_EMAIL);
        if( empty($POST['mailUser']) ){
            $error_count++;
            $datos[3]['input'] = $POST['mailUser'];
            $datos[3]['estado'] = "input-error";
            $datos[3]['mensaje'] = "Completa este campo";
        }else{
            // si tiene mas de 4 letras
            // Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
            $datos[3]['input'] = $POST['mailUser'];
            if (!filter_var($POST['mailUser'], FILTER_VALIDATE_EMAIL)) {
                    $error_count++;
                    $datos[3]['estado']= "input-error";
                    $datos[3]['mensaje']= "Incluye un signo '@' en la dirección de correo electrónico.";
            }
        }
        //   paisUser  
        $POST['paisUser'] = filter_var($POST['paisUser'], FILTER_SANITIZE_STRING);
        if( empty($POST['paisUser']) ){
            $error_count++;
            $datos[4]['input']= $POST['paisUser'];
            $datos[4]['estado']= "input-error";
            $datos[4]['mensaje']= "Completa este campo";
            }else{
                // si tiene mas de 4 letras
                // Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
                $datos[4]['input'] = $POST['paisUser'];
                if( strlen( $POST['paisUser'] ) < 4 ){
                    $error_count++;
                   
                    $datos[4]['estado'] = "input-error";
                    $datos[4]['mensaje'] = "Alarga el texto a 4 o más caracteres";
            }
        }
   
 
        //   telefonoUser
        $POST['telefonoUser'] = filter_var($POST['telefonoUser'], FILTER_SANITIZE_STRING);
        if( empty($POST['telefonoUser']) ){
          $error_count++;
          $datos[5]['input']= $POST['telefonoUser'];
          $datos[5]['estado']= "input-error";
          $datos[5]['mensaje']= "Completa este campo";
          }else{
         // si tiene mas de 4 letras
         // Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
         $datos[5]['input']= $POST['telefonoUser'];
              if(! preg_match($this->patron_tel, $POST['telefonoUser']) ){
                  $error_count++;
      
                  $datos[5]['estado']= "input-error";
                  $datos[5]['mensaje']= "Haz coincidir el formato solicitado.";
              }
          }

    
      //   passwordNueva
      if( empty($POST['passwordNueva']) ){
        $error_count++;
        $datos[6]['input']= "";
        $datos[6]['estado']= "input-error";
        $datos[6]['mensaje']= "Completa este campo";
        }else{
       // si tiene mas de 4 letras
       // Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
        if(! preg_match($this->patron_pass,$POST['passwordNueva']) ){
            $error_count++;
            $datos[6]['input']= "";
            $datos[6]['estado']= "input-error";
            $datos[6]['mensaje']= "Haz coincidir el formato solicitado.";
            }
        }
        if( !empty($FILES['archivosubido']) ){
            if ($FILES['archivosubido']['name']) {
                $filetype = $FILES['archivosubido']['type'];
                if ( ! in_array( $filetype, $extensiones) ) {
                    $error_count++;
                    $datos[7]['input']="";
                    $datos[7]['estado']= "input-error";
                    $datos[7]['mensaje']= "Los Archivos deben ser imagenes";
                  }
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
        $data =  [ 
            
            ['input' => "",
            'estado' => "",//class="" o class="input-error"0
            'mensaje' =>"",//"mensaje de error si hay
            ],
            ['input' => "",
            'estado' => "",//class="" o class="input-error"1
            'mensaje' =>"",//"mensaje de error si hay
            ],
            ['input' => "",
            'estado' => "",//class="" o class="input-error"2
            'mensaje' =>"",//"mensaje de error si hay
            ],
            ['input' =>"",
            'estado' => "",//class="" o class="input-error"3
            'mensaje' =>"",//"mensaje de error si hay
            ],
            ['input' =>"",
            'estado' => "",//class="" o class="input-error"4
            'mensaje' =>"",//"mensaje de error si hay
            ],
            ['input' =>"",
            'estado' => "",//class="" o class="input-error"5
            'mensaje' =>"",//"mensaje de error si hay
            ],
            ['input' =>"",
            'estado' => "",//class="" o class="input-error" el passwor6
            'mensaje' =>"",//"mensaje de error si hay
            ],
            ['errores' => 0],//7
        ];
        $data = $this->verificar_params($_POST,$_FILES,$data);
        $ok =  $data['errores'];
       // var_dump( $data);
        if ($ok == 0){
            $statement = $this->model->agregarUsuario(
                $_POST['nameUser'],
                $_POST['nombreUser'],
                $_POST['apellidoUser'],
                $_POST['mailUser'],
                $_POST['paisUser'],
                $_POST['telefonoUser'],
                $_POST['passwordNueva'],
                $_FILES
            ); 
            if ($statement > 1){ //si valido
                session_start();
                $_SESSION['user'] =  $_POST['nameUser'];
               return $this->dash();
            }else{ //si errores
              // var_dump("internal-error");
              var_dump("si internal errores");
              $datos['user']= '';
                return view('/errors/internal-error', compact('datos'));  
            }
        } else {
            //si formulario invalido
            //=>> reeenviar con errores
             //var_dump("si formulario invalido");
            return  $this->new_user($data);
        }

     
    }

    public function new_user($data = null){
        if ($data == null){
            $data = [ 
            
                ['input' => "",
                'estado' => "",//class="" o class="input-error"0
                'mensaje' =>"",//"mensaje de error si hay
                ],
                ['input' => "",
                'estado' => "",//class="" o class="input-error"1
                'mensaje' =>"",//"mensaje de error si hay
                ],
                ['input' => "",
                'estado' => "",//class="" o class="input-error"2
                'mensaje' =>"",//"mensaje de error si hay
                ],
                ['input' =>"",
                'estado' => "",//class="" o class="input-error"3
                'mensaje' =>"",//"mensaje de error si hay
                ],
                ['input' =>"",
                'estado' => "",//class="" o class="input-error"4
                'mensaje' =>"",//"mensaje de error si hay
                ],
                ['input' =>"",
                'estado' => "",//class="" o class="input-error"5
                'mensaje' =>"",//"mensaje de error si hay
                ],
                ['input' =>"",
                'estado' => "",//class="" o class="input-error" el passwor6
                'mensaje' =>"",//"mensaje de error si hay
                ],
                ['errores' => 0],//7
            ];
        }
        $datos['form']= $data;
        $datos['user'] = '';
     
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
            'estado' => "",//class="" o class="input-error"0
            'mensaje' =>"",//"mensaje de error si hay
            ],
            ['input' => "",
            'estado' => "",//class="" o class="input-error"1
            'mensaje' =>"",//"mensaje de error si hay
            ],
            ['input' => "",
            'estado' => "",//class="" o class="input-error"2
            'mensaje' =>"",//"mensaje de error si hay
            ],
            ['input' =>"",
            'estado' => "",//class="" o class="input-error"3
            'mensaje' =>"",//"mensaje de error si hay
            ],
            ['input' =>"",
            'estado' => "",//class="" o class="input-error"4
            'mensaje' =>"",//"mensaje de error si hay
            ],
            ['input' =>"",
            'estado' => "",//class="" o class="input-error"5
            'mensaje' =>"",//"mensaje de error si hay
            ],
            ['input' =>"",
            'estado' => "",//class="" o class="input-error" el passwor6
            'mensaje' =>"",//"mensaje de error si hay
            ],
            ['errores' => 0],//7
        ];
        session_start();
        $datos['user'] = '';
        if (isset($_SESSION['user'])) {
            $datos['user'] = $_SESSION['user'];
            $_POST['nameUser'] = $_SESSION['user'];
            $_POST['passwordNueva'] = "123456As";
            $datas =  $this->verificar_params($_POST,$datas,null);
            $ok = $datas['errores'];
                if ( $ok == 0){
                    $user = $_POST['mailUser'];
                    $nombre = $_POST['nombreUser'];
                    $apellido = $_POST['apellidoUser'];
                    $ubicacion = $_POST['paisUser'];
                    $telefono = $_POST['telefonoUser'];
                    $statement = $this->model->updateUsuario( $user, $nombre, $apellido, $ubicacion, $telefono );
                    if ($statement == 1) {
                        return $this->dash();
                    } else {
                        return view('/errors/internal-error', compact('datos'));
                    }
                }else{
                     return $this->dash($datas);
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

    public function cerrarLogin()  {
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

    public function dash($data=null){
        if ($data == null){
            $data = [ 
            
                ['input' => "",
                'estado' => "",//class="" o class="input-error"0
                'mensaje' =>"",//"mensaje de error si hay
                ],
                ['input' => "",
                'estado' => "",//class="" o class="input-error"1
                'mensaje' =>"",//"mensaje de error si hay
                ],
                ['input' => "",
                'estado' => "",//class="" o class="input-error"2
                'mensaje' =>"",//"mensaje de error si hay
                ],
                ['input' =>"",
                'estado' => "",//class="" o class="input-error"3
                'mensaje' =>"",//"mensaje de error si hay
                ],
                ['input' =>"",
                'estado' => "",//class="" o class="input-error"4
                'mensaje' =>"",//"mensaje de error si hay
                ],
                ['input' =>"",
                'estado' => "",//class="" o class="input-error"5
                'mensaje' =>"",//"mensaje de error si hay
                ],
                ['input' =>"",
                'estado' => "",//class="" o class="input-error" el passwor6
                'mensaje' =>"",//"mensaje de error si hay
                ],
                ['errores' => 0],//7
            ];
        }
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
            $datas[5]['input'] = $data[0]->telefono;
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
                $datas[7]['input'] = $data[0]->fotoPerfil;
                $datos['data']  = $datas;
            $datos['sitios'] = $this->model->getSitiosUsuario( $_SESSION['user']);
            return view('/users/dashboard-sitios', compact('datos'));
        } else {
            header('Location: /inicio');
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
            $datas[7]['input'] = $data[0]->fotoPerfil;
            $datos['data']  = $datas;
            $data = $this->Sitios->getNombreSitios(htmlspecialchars($_GET['Sitio']));
            if(!empty($data)){
                $datos['platos'] = $this->Sitios->getPlatosFromSitios( $_GET['Sitio'] );
                $datos['idSitio'] = $data[0]->idSitio;
                $datos['NameSitio'] = $data[0]->nombre;
                return view('/users/dashboard-platos', compact('datos'));
            }else{
                header('Location: /inicio');
                exit();
            }
        } else {
            header('Location: /inicio');
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
                $datas[7]['input'] = $data[0]->fotoPerfil;
                $datos['data']  = $datas;
            return view('/users/dashboard-password', compact('datos'));
        } else {
            header('Location: /inicio');
            exit();
        }
    }
  


}
