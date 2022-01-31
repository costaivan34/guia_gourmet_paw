<?php

namespace App\Controllers;

use App\Core\Controller;

use App\Models\Sitio;
use App\Models\Comentario;
use App\Models\Plato;
use App\Models\Users;

class SitioController extends Controller{
    protected $patron_pass = "(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$";
    protected $patron_texto = "[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]";
    protected $patron_tel = "(\(\+?\d{2,3}\)[\*|\s|\-|\.]?(([\d][\*|\s|\-|\.]?){6})(([\d][\s|\-|\.]?){2})?|(\+?[\d][\s|\-|\.]?){8}(([\d][\s|\-|\.]?){2}(([\d][\s|\-|\.]?){2})?)?)";
    protected $idSitio;
    protected $Comentarios;
    protected $Platos;

    public function __construct(){
        $this->Comentarios = new Comentario();
        $this->Platos = new Plato();
        $this->model = new Sitio();
        $this->Users = new Users();
    }
    
   public function getAll(){
    session_start();
    $datos["user"] = " ";
    if (isset($_SESSION["user"])){
        $datos["user"] = $_SESSION["user"];
    }
    $infoBasica = $this->model->getAll();
    $datos['AllSitios'] = $infoBasica;

    return view('restauranteSingle',compact('datos'));
   }
   
   public function sendComentario(){	
    $comentario = [ 
        'idSitio' => $_POST['sitio'],
        'nombre' => $_POST['nombre'],
        'mail' => $_POST['mail'],
        'descripcion' => $_POST['texto'],
        'valoracionSabor' => $_POST['precio'],
        'valoracionPrecio' => $_POST['sabor'],
        'valoracionAmbiente' => $_POST['ambiente']
    ];
     $this->Comentarios->store($comentario);
    
    return $this->Comentarios->getPaginacionComentarios($_POST['sitio']);
   }


    public function newOne($datos = null){
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
                ['errores' => 0],
            ];
        }
        session_start();
        if (isset($_SESSION["user"])){
            $datos['form']= $datos;
            $datos["user"] =  $_SESSION["user"];
            return view('/sitios/NewSitio',compact('datos'));
        }else{
            header('Location: /inicio');
            exit();
        }
    }
  


    public function verificar_params($POST,$datos){
        $error_count = 0;
            // Comprobar si llegaron los campos requeridos:
        //   namePlato
        $POST['nameSitio'] = filter_var($POST['nameSitio'], FILTER_SANITIZE_STRING);
        if(empty($POST['nameSitio']) ){
            $error_count++;
            $datos[0]['input'] = $POST['nameSitio'];
            $datos[0]['estado'] = "input-error";
            $datos[0]['mensaje'] = "Completa este campo";   
            }else{
        // si tiene mas de 4 letras
        // Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
                if( strlen( $POST['nameSitio'] ) < 4 ){
                    $error_count++;
                   $datos[0]['input'] = $POST['nameSitio'];
                   $datos[0]['estado'] = "input-error";
                   $datos[0]['mensaje'] = "Debe especificar el nombre";
                }
            }
        //   subject
        $POST['subject'] = filter_var($POST['subject'], FILTER_SANITIZE_STRING);
        if( empty($POST['subject']) ){
            $error_count++;
            $datos[1]['input']= $POST['subject'];
            $datos[1]['estado']= "input-error";
            $datos[1]['mensaje']= "Completa este campo";
            }else{
        // si tiene mas de 4 letras
        // Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
            if(strlen( $POST['subject']) < 40 ){
                    $error_count++;
                    $datos[1]['input']= $POST['subject'];
                    $datos[1]['estado']= "input-error";
                    $datos[1]['mensaje']= "Debe especificar el nombre";
                }
            }
   
   
        $POST['DireccionSitio'] = filter_var($POST['DireccionSitio'], FILTER_SANITIZE_STRING);
        if( empty($POST['DireccionSitio']) ){
            $error_count++;
            $datos[2]['input']=  $POST['DireccionSitio'];
            $datos[2]['estado']= "input-error";
            $datos[2]['mensaje']= "Completa este campo";
            }else{
            // si tiene mas de 4 letras
            // Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
            if( strlen( $POST['DireccionSitio']) < 4){
                    $error_count++;
                    $datos[2]['input']= $POST['DireccionSitio'];
                    $datos[2]['estado']= "input-error";
                    $datos[2]['mensaje']= "Debe especificar el nombre";
                }
            }

            $POST['LocalidadSitio'] = filter_var($POST['LocalidadSitio'], FILTER_SANITIZE_STRING);
            if( empty($POST['LocalidadSitio']) ){
                $error_count++;
                $datos[3]['input']= $POST['LocalidadSitio'];
                $datos[3]['estado']= "input-error";
                $datos[3]['mensaje']= "Completa este campo";
                }else{
                    // si tiene mas de 4 letras
                    // Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
                    if( strlen( $POST['LocalidadSitio'] ) < 4 ){
                        $error_count++;
                        $datos[3]['input']= $POST['LocalidadSitio'];
                        $datos[3]['estado']= "input-error";
                        $datos[3]['mensaje']= "Debe especificar el nombre";
                }
            }
   
            $POST['ProvinciaSitio'] = filter_var($POST['ProvinciaSitio'], FILTER_SANITIZE_STRING);
            if( empty($POST['ProvinciaSitio']) ){
            $error_count++;
            $datos[4]['input']= $POST['ProvinciaSitio'];
            $datos[4][1]= "input-error";
            $datos[4]['mensaje']= "Completa este campo";
            }else{
            // si tiene mas de 4 letras
            // Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
            if( strlen( $POST['ProvinciaSitio'] ) < 4 ){
                    $error_count++;
                    $datos[4]['input']= $POST['ProvinciaSitio'];
                    $datos[4]['estado']= "input-error";
                    $datos[4]['mensaje']= "Debe especificar el nombre";
                }
            }

          $POST['MailSitio'] = filter_var($POST['MailSitio'], FILTER_SANITIZE_EMAIL);
            if( empty($POST['MailSitio']) ){
                $error_count++;
                $datos[5]['input']= $POST['MailSitio'];
                $datos[5]['estado']= "input-error";
                $datos[5]['mensaje']= "Completa este campo";
            }else{
                // si tiene mas de 4 letras
                // Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
                if (!filter_var($POST['MailSitio'], FILTER_VALIDATE_EMAIL)) {
                        $error_count++;
                        $datos[5]['input']= $POST['MailSitio'];
                        $datos[5]['estado']= "input-error";
                        $datos[5]['mensaje']= "Incluye un signo '@' en la dirección de correo electrónico.";
                }
            }
            $POST['TelefonoSitio'] = filter_var($POST['TelefonoSitio'], FILTER_SANITIZE_STRING);
            if( empty($POST['TelefonoSitio']) ){
              $error_count++;
              $datos[6]['input']= $POST['TelefonoSitio'];
              $datos[6]['estado']= "input-error";
              $datos[6]['mensaje']= "Completa este campo";
              }else{
             // si tiene mas de 4 letras
             // Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
                  if(! preg_match($this->patron_tel, $POST['TelefonoSitio']) ){
                      $error_count++;
                      $datos[6]['input']= $POST['TelefonoSitio'];
                      $datos[6]['estado']= "input-error";
                      $datos[6]['mensaje']= "Haz coincidir el formato solicitado.";
                  }
              }

            if( empty($POST['horarios']) ){
                $error_count++;
                $datos[7]['input']= "";
                $datos[7]['estado']= "input-error";
                $datos[7]['mensaje']= "Completa este campo";
            }else{
               // si tiene mas de 4 letras
               // Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
             //  var_dump(count($POST['horarios']));
                for ($x = 0; $x <count($POST['horarios']); $x+=3) {
               //       var_dump($x);
                    
                    $dia = $POST['horarios'][$x];// 0 a 6
                    $de =$POST['horarios'][$x+1]; // 0 a 23 menor que $hasta
                    $hasta =$POST['horarios'][$x+2];// 0 a 23 mayor que $de
                    if (
                    !(filter_var($dia, FILTER_VALIDATE_INT) === 0 || !filter_var($dia, FILTER_VALIDATE_INT) === false) &&
                    !(filter_var($de, FILTER_VALIDATE_INT) === 0 || !filter_var($de, FILTER_VALIDATE_INT) === false) &&
                    !(filter_var($hasta, FILTER_VALIDATE_INT) === 0 || !filter_var($hasta, FILTER_VALIDATE_INT) === false)) {
                        $error_count++;
                        $datos[7]['input']= $POST['horarios'];
                        $datos[7]['estado']= "input-error";
                        $datos[7]['mensaje']= "Uno de los horarios ingresados no es valido";
                    }else{
                        if (($dia<0 || $dia>6)){
                            if (($de<0 || $de>23)){
                                if (($hasta<0 || $hasta>23)){
                                    if (($de > $hasta) ) {
                                        $error_count++;
                                        $datos[7]['input']= $POST['horarios'];
                                        $datos[7]['estado']= "input-error";
                                        $datos[7]['mensaje']= "Uno de los horarios ingresados no es valido";
                                    }
                                }
                            }
                        }
                    }
                }
            }
            if( !empty($POST['servicios']) ){
               foreach ( ($POST['servicios']) as $value) {
                    if (!(filter_var($value, FILTER_VALIDATE_INT) === 0 || !filter_var($value, FILTER_VALIDATE_INT) === false)) {
                        if ( ($value < 1 ) || ($value > 6  ) ){
                            $error_count++;
                            $datos[8]['input']= $POST['servicios'];
                            $datos[8]['estado']= "input-error";
                            $datos[8]['mensaje']= "La selección ingresada no es valida";
                        }
                    }
                }
            }   
            $POST['longitud'] = filter_var($POST['longitud'], FILTER_SANITIZE_STRING);
            if( empty($POST['longitud']) ){
              $error_count++;
              $datos[9]['input']= $POST['longitud'];
              $datos[9]['estado']= "input-error";
              $datos[9]['mensaje']= "Completa este campo";
              }else{
                if (!(filter_var($POST['longitud'], FILTER_VALIDATE_FLOAT))) {
                      $error_count++;
                      $datos[9]['input']= $POST['longitud'];
                      $datos[9]['estado']= "input-error";
                      $datos[9]['mensaje']= "Las coordenadas ingresadas no son validas";
                }
              }

            //$POST['latitud'] = filter_var($POST['latitud'], FILTER_SANITIZE_STRING);
            if( empty($POST['latitud']) ){
                $error_count++;
                $datos[9]['input']= $POST['latitud'];
                $datos[9]['estado']= "input-error";
                $datos[9]['mensaje']= "Completa este campo";
            }else{
                if (!(filter_var($POST['latitud'], FILTER_VALIDATE_FLOAT))) {
                        $error_count++;
                        $datos[9]['input']= $POST['latitud'];
                        $datos[9]['estado']= "input-error";
                        $datos[9]['mensaje']= "Las coordenadas ingresadas no son validas";
                }
            }

        $datos[10]['errores'] = $error_count;
   //       var_dump( $datos['errores']);
        return $datos;
    }


    public function store(){
     //   var_dump($_POST); 
        session_start();
        $datos['user'] = ' ';
        if (isset($_SESSION['user'])) {
                $datos['user'] = $_SESSION['user'];
                $data =  [ 

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
                    ['input' =>"",
                    'estado' => "",//class="" o class="input-error" el passwor
                    'mensaje' =>"",//"mensaje de error si hay
                    ],
                    ['input' =>"",
                    'estado' => "",//class="" o class="input-error" el passwor
                    'mensaje' =>"",//"mensaje de error si hay
                    ],
                    ['input' =>"",
                    'estado' => "",//class="" o class="input-error" el passwor
                    'mensaje' =>"",//"mensaje de error si hay
                    ],
                    ['errores' => 0],
                ];
                $data = $this->verificar_params($_POST,$data);
                $ok =  $data[10]['errores'];
       //           var_dump($data);
                if ( $ok == 0){
                    $idSitio = $this->model->agregarSitio($_POST['nameSitio'],$_POST['subject'],
                    $_POST['DireccionSitio'],$_POST['LocalidadSitio'],$_POST['ProvinciaSitio'],
                    $_POST['longitud'],$_POST['latitud'], $_POST['MailSitio'], $_POST['TelefonoSitio'],
                    $_SESSION['user'],$_POST['horarios'],$_POST['servicios'],$_FILES);
                    if ($idSitio > 1){ //si valido
                        $this->idSitio = $idSitio;
                        return $this->getOne();
                    }else{ //si errores
                      // var_dump("internal-error");
                        return view('/errors/internal-error', compact('datos'));  
                    }
                } else {
                    //si formulario invalido
                    //=>> reeenviar con errores
                    return $this->newOne($data);
                }
        } else {
            //no esta logeado
            //=>> exit
            header('Location: /inicio');
            exit();
        }
 
    }

    public function delete(){
        session_start();
        $datos['user'] = ' ';
        if (isset($_SESSION['user'])) {
            
            if($this->model->tienePlatos($_POST['idSitio']) == 0){
                $idSitio = $this->model->deleteSitio($_POST['idSitio']);

                if ($idSitio == 1){
                    return 1;   
                }else{
                    return 0;   
                }
            }else{
                return 0;
            }
        } 
    }


    public function getOne(){
        session_start();
        if ($this->idSitio == 0){ //si valido
            $idSitio = htmlspecialchars($_GET['Sitio']);
        }else{ //si errores
            $idSitio = $this->idSitio;
        }
        $datos = $this->model->getOne($idSitio);
        $datos["user"] = " ";
        if (isset($_SESSION["user"])){
            $datos["user"] =  $_SESSION["user"];
        }
        if($datos == 0){
            return view('/errors/not-found', compact('datos'));
        }else{
            return view('/sitios/OneSitio',compact('datos'));
        }
    }


    public function getComentarios(){
        $idSitio = htmlspecialchars($_GET['Sitio']);
        $pageN = htmlspecialchars($_GET['page']);
        $Comentarios=  $this->Comentarios->getAllComentarios($idSitio,$pageN);
      // var_dump($Comentarios);
        return $Comentarios;
    }

    public function getPlatoPage(){
        $idSitio = htmlspecialchars($_GET['Sitio']);
        $PaginacionPlatos =  $this->Platos->getPaginacionPlatos($idSitio);
        //var_dump($datos);
        return $PaginacionPlatos;
    }


    public function getComentarioPage(){
        $idSitio = htmlspecialchars($_GET['Sitio']);
        $pageN = htmlspecialchars($_GET['page']);
        $PaginacionComentarios =  $this->Comentarios->getPaginacionComentarios($idSitio);
        return $PaginacionComentarios;
    }


    public function index(){
        session_start();
        $Destacados = $this->model->getDestacados(); 
        $datos["Destacados"] = $Destacados;
        $datos["user"] = " ";
        if (isset($_SESSION["user"])){
            $datos["user"] =  $_SESSION["user"];
        }
       // var_dump($datos);
       
        return view('/home/index', compact('datos'));
    }

    public function getCategorias(){
        $datos['categorias'] =  $this->model->getCategorias();
        //var_dump($datos);
        return  $this->model->getCategorias();
    }
 



    public function cerca(){
        session_start();
        if (isset($_SESSION["user"])){
            $datos["user"] = $_SESSION["user"];
        }else{
            $datos["user"] = " " ;
        }
        //$datos = json_encode( $datos, JSON_FORCE_OBJECT);
      //var_dump($datos);
        return view('/sitios/NearSitios', compact('datos'));
    }
    
    public function getMarcadores(){
        $currentX = ($_GET['clong']);
        $currentY = ($_GET['clat']);
        $Ulong = ($_GET['Ulong']);
        $Ulat = ($_GET['Ulat']);
        $Dlong = ($_GET['Dlong']);
        $Dlat = ($_GET['Dlat']);
        $Datos=$this->model->getMarcadores( $currentX, $currentY , $Ulong ,$Ulat,$Dlong,$Dlat );
      //  $data = json_encode( $Datos, JSON_FORCE_OBJECT);
       return  $Datos;
    }
    

    public function buscar(){
        if(isset($_GET['Clave'])){
            $Clave =htmlspecialchars ($_GET['Clave']);    
        }else{
            $Clave=" ";
        }
        $Pagina   =  htmlspecialchars($_GET['Pagina']);
        $Provincia =  (htmlspecialchars($_GET['Provincia']));
        $Categoria =  (htmlspecialchars($_GET['Categoria']));
        $Paginacion = $this->model->getPaginacionBuscame($Clave,$Provincia,$Categoria);
        $AllSitios = $this->model->buscame($Clave,$Provincia,$Categoria,$Pagina);
        $Datos['Paginacion'] =$Paginacion;
        $Datos['AllSitios'] =$AllSitios;
        $data = json_encode( $Datos, JSON_FORCE_OBJECT);
        return  $data;
        
    }

    public function buscador(){
        session_start();
        if (isset($_SESSION["user"])){
            $datos["user"] =  $_SESSION["user"];
        }else{
            $datos["user"] = " ";
        }
        if( (isset($_GET['Clave'])) ){
            $Clave =htmlspecialchars ($_GET['clave']);
            $datos['clave'] = $Clave;
        }else{
            $datos['clave'] = '';
        }
        if( (isset($_GET['provincia'])) ){
            $Provincia =  (htmlspecialchars($_GET['provincia']));
            $datos['provincia'] = $Provincia;
        }else{
            $datos['provincia'] = 'TODAS';
        }
        if((isset($_GET['categoria'])) ){
            $Categoria =  (htmlspecialchars($_GET['categoria']));
            $datos['categoria'] = $Categoria;
        }else{
            $datos['categoria'] = 0;
        }
      // $datos = json_encode( $datos, JSON_FORCE_OBJECT);
      // $datos = json_encode( $datos);
      //   var_dump($datos);
        return view('/sitios/SearchSitio', compact('datos'));
    }
        
}



