<?php

namespace App\Controllers;

use App\Core\Controller;

use App\Models\Plato;
use App\Models\Sitio;
use App\Models\Users;


class PlatoController extends Controller{
    protected $patron_pass = "^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$^";
    protected $patron_texto = "^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$^";
    protected $patron_tel = "^(\(\+?\d{2,3}\)[\*|\s|\-|\.]?(([\d][\*|\s|\-|\.]?){6})(([\d][\s|\-|\.]?){2})?|(\+?[\d][\s|\-|\.]?){8}(([\d][\s|\-|\.]?){2}(([\d][\s|\-|\.]?){2})?)?)$^";
    protected $idSitio;
    protected $idPlato;
    
    public function __construct(){
        $this->model = new Plato();
        $this->Sitios = new Sitio();
        $this->Users = new Users();
    }
    
    public function index(){
     $todosPlatos = $this->model->getAll(); 
        $datos['todosPlatos'] = $todosPlatos;
    /*    $datos["userLogueado"] = $_SESSION['user'];*/
        return view('/plato/platoTodos', compact('datos'));
    }
    
    public function getOne(){
        $idSitio = htmlspecialchars($_GET['Sitio']);
        $idPlato = htmlspecialchars($_GET['Plato']);
        $plato = $this->model->getOne($idSitio,$idPlato);
        return $plato;
    }

    public function newOne($data = null){
        if ($data == null){
            $data = [  
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
                    ['idSitio' => 0],
            ];
            $idSitio = $_GET["Sitio"];
        }else{
            $idSitio = $data[11]['idSitio'];
        }
        session_start();
        $datos["user"] = " ";
        if (isset($_SESSION["user"])){
            $datos["user"] =  $_SESSION["user"];
            $datos['form']= $data;
            $dat = $this->Sitios->getNombreSitios($idSitio);
            if(!empty($dat)){
                $datos['idSitio'] = $dat[0]->idSitio;
                $datos['NameSitio'] = $dat[0]->nombre;
                return view('/sitios/NewPlatos', compact('datos'));
            }else{
                return view('/errors/internal-error', compact('datos'));  
            }
            
        }else{
            header('Location: /inicio');
            exit();
        }
        
    }


    public function verificar_params($POST,$FILES,$datos){
        $extensiones = array(0=>'image/jpg',1=>'image/jpeg',2=>'image/png');
        $error_count = 0;
        // Comprobar si llegaron los campos requeridos:
      //   namePlato
      $POST['namePlato'] = filter_var($POST['namePlato'], FILTER_SANITIZE_STRING);
      if(empty($POST['namePlato']) ){
        $error_count++;
        $datos[0]['input'] = $POST['namePlato'];
        $datos[0]['estado'] = "input-error";
        $datos[0]['mensaje'] = "Completa este campo";   
        }else{
       // si tiene mas de 4 letras
       // Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
       $datos[0]['input'] = $POST['namePlato'];
              if( strlen( $POST['namePlato'] ) < 4 ){
                $error_count++;
                $datos[0]['input'] = $POST['namePlato'];
                $datos[0]['estado'] = "input-error";
                $datos[0]['mensaje'] = "Completa este campo";   
                
            }
        }
   
      //   subject
      $POST['subject'] = filter_var($POST['subject'], FILTER_SANITIZE_STRING);
      if( empty($POST['subject']) ){
        $error_count++;
        $datos[1]['input'] = $POST['subject'];
        $datos[1]['estado'] = "input-error";
        $datos[1]['mensaje'] = "Completa este campo";   
        }else{
       // si tiene mas de 4 letras
       // Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
       $datos[1]['input'] = $POST['subject'];
            if( strlen( $POST['subject'] ) < 4 ){
                $error_count++;
                $datos[1]['input'] = $POST['subject'];
                $datos[1]['estado'] = "input-error";
                $datos[1]['mensaje'] = "Completa este campo";   
            }
        }
   
   
      $POST['InformaciónPeso'] = filter_var($POST['InformaciónPeso'], FILTER_SANITIZE_STRING);
      if( empty($POST['InformaciónPeso']) ){
        $error_count++;
        $datos[2]['input'] = $POST['InformaciónPeso'];
        $datos[2]['estado'] = "input-error";
        $datos[2]['mensaje'] = "Completa este campo";   
        }else{
            $datos[2]['input'] = $POST['InformaciónPeso'];
            
            if (!(filter_var($POST['InformaciónPeso'], FILTER_VALIDATE_FLOAT))) {
                $error_count++;
               
                $datos[2]['estado'] = "input-error";
                $datos[2]['mensaje'] =  "El valor debe ser mayor de o igual a 0.1"; 
            }
        }
   
        $POST['InformaciónEnergia'] = filter_var($POST['InformaciónEnergia'], FILTER_SANITIZE_STRING);
        if( empty($POST['InformaciónEnergia']) ){
          $error_count++;
          $datos[3]['input'] = $POST['InformaciónEnergia'];
            $datos[3]['estado'] = "input-error";
            $datos[3]['mensaje'] = "Completa este campo";   
          }else{
            $datos[3]['input'] = $POST['InformaciónEnergia'];
            if (!(filter_var($POST['InformaciónEnergia'], FILTER_VALIDATE_FLOAT))) {
                  $error_count++;
                  
                  $datos[3]['estado'] = "input-error";
                  $datos[3]['mensaje'] =  "El valor debe ser mayor de o igual a 0.1"; 
              }
          }

          $POST['InformaciónCarbohidratos'] = filter_var($POST['InformaciónCarbohidratos'], FILTER_SANITIZE_STRING);
            if( empty($POST['InformaciónCarbohidratos']) ){
                $error_count++;
                $datos[4]['input'] = $POST['InformaciónCarbohidratos'];
                    $datos[4]['estado'] = "input-error";
                    $datos[4]['mensaje'] = "Completa este campo";   
                }else{
                    $datos[4]['input'] = $POST['InformaciónCarbohidratos'];
                    if (!(filter_var($POST['InformaciónCarbohidratos'], FILTER_VALIDATE_FLOAT))) {
                        $error_count++;
                        $datos[4]['input'] = $POST['InformaciónCarbohidratos'];
                        $datos[4]['estado'] = "input-error";
                        $datos[4]['mensaje'] =  "El valor debe ser mayor de o igual a 0.1";  
                    }
                }
       $POST['InformaciónProteina'] = filter_var($POST['InformaciónProteina'], FILTER_SANITIZE_STRING);
      if( empty($POST['InformaciónProteina']) ){
        $error_count++;
        $datos[5]['input'] = $POST['InformaciónProteina'];
            $datos[5]['estado'] = "input-error";
            $datos[5]['mensaje'] = "Completa este campo";   
        }else{
            $datos[5]['input'] = $POST['InformaciónProteina'];
            if (!(filter_var($POST['InformaciónProteina'], FILTER_VALIDATE_FLOAT))) {
                $error_count++;
                $datos[5]['estado'] = "input-error";
                $datos[5]['mensaje'] = "El valor debe ser mayor de o igual a 0.1";
             
            }
        }
        $POST['InformaciónGrasas'] = filter_var($POST['InformaciónGrasas'], FILTER_SANITIZE_STRING);
        if( empty($POST['InformaciónGrasas']) ){
          $error_count++;
          $datos[6]['input'] = $POST['InformaciónGrasas'];
          $datos[6]['estado'] = "input-error";
          $datos[6]['mensaje'] = "Completa este campo";   
          }else{
            $datos[6]['input'] = $POST['InformaciónGrasas'];
            if (!(filter_var($POST['InformaciónGrasas'], FILTER_VALIDATE_FLOAT))) {
                  $error_count++;
                  $datos[6]['estado'] = "input-error";
                  $datos[6]['mensaje'] =  "El valor debe ser mayor de o igual a 0.1";
              }
          }
          $POST['InformaciónSodio'] = filter_var($POST['InformaciónSodio'], FILTER_SANITIZE_STRING);
          if( empty($POST['InformaciónSodio']) ){
            $error_count++;
            $datos[7]['input'] = $POST['InformaciónSodio'];
            $datos[7]['estado'] = "input-error";
            $datos[7]['mensaje'] = "Completa este campo";   
            }else{
                $datos[7]['input'] = $POST['InformaciónSodio'];
                if (!(filter_var($POST['InformaciónSodio'], FILTER_VALIDATE_FLOAT))) {
                    $error_count++;
                    $datos[7]['estado'] = "input-error";
                    $datos[7]['mensaje'] =  "El valor debe ser mayor de o igual a 0.1";   
                }
            }
            if( !empty($POST['caracteristicas']) ){
                foreach ( ($POST['caracteristicas']) as $value) {
                     if (!(filter_var($value, FILTER_VALIDATE_INT) === 0 || !filter_var($value, FILTER_VALIDATE_INT) === false)) {
                         if ( ($value < 1 ) || ($value > 6  ) ){
                             $error_count++;
                             $datos[8]['input']= $POST['caracteristicas'];
                             $datos[8]['estado']= "input-error";
                             $datos[8]['mensaje']= "La selección ingresada no es valida";
                         }
                     }
                 }
             } 
             if( !empty($FILES['archivosubido']) ){
                    if ($FILES['archivosubido']['name']) {
                        $filetype = $FILES['archivosubido']['type'];
                        if ( ! in_array( $filetype, $extensiones) ) {
                            $error_count++;
                            $datos[9]['input']="";
                            $datos[9]['estado']= "input-error";
                            $datos[9]['mensaje']= "Los Archivos deben ser imagenes";
                          }
                    }
               
            }
        $datos[10]['errores'] = $error_count;
        return $datos;
    }

    //    var_dump($_POST); 
    //    var_dump($_FILES);  
    public function store(){
      session_start();
        $datos['user'] = ' ';
        if (isset($_SESSION['user'])) {
                $datos['user'] = $_SESSION['user'];
                /*  if (  //si formulario valido) {
                     //=>>> store*/
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
                        ['idSitio' => 0],
                    ];
                    $data = $this->verificar_params($_POST,$_FILES,$data);
                    $ok =  $data[10]['errores'];
                    $data[11]['idSitio'] = $_POST["idSitio"];
                if ( $ok == 0){
                    $idPlato = $this->model->agregarPlato($_POST['namePlato'],$_POST['subject'],
                    $_POST["idSitio"],$_POST['InformaciónPeso'],$_POST['InformaciónEnergia'],
                    $_POST['InformaciónCarbohidratos'], $_POST['InformaciónProteina'],
                    $_POST['InformaciónGrasas'],$_POST['InformaciónSodio'],
                    $_FILES,$_POST['caracteristicas']);
                    if ($idPlato == 1){ //si valido
                        $dat = $this->Users->getUsuario($_SESSION['user']);
                        $datas[0]['input'] = $dat[0]->nombreUsuario;
                        $datas[1]['input'] = $dat[0]->nombre;
                        $datas[2]['input'] = $dat[0]->apellido;
                        $datas[3]['input'] = $dat[0]->mail;
                        $datas[7]['input'] = $dat[0]->fotoPerfil;
                        $datos['data']  = $datas;
                        $datos['platos'] = $this->Sitios->getPlatosFromSitios($_POST["idSitio"]);
                        $data = $this->Sitios->getNombreSitios(htmlspecialchars($_POST["idSitio"]));
                        $datos['idSitio'] = $data[0]->idSitio;
                        $datos['NameSitio'] = $data[0]->nombre;
                        return view('/users/dashboard-platos', compact('datos'));
                    }else{ //si errores
                       var_dump("internal-error");
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
            $idSitio = $this->model->deletePlato($_POST['idPlato']);
            return $idSitio; 
            if ($idSitio == 1){
                return 1;   
            }else{
                return 0;   
            }
        } 
    }

    public function getPlatos(){
        $idSitio = htmlspecialchars($_GET['Sitio']);
        $pageN = htmlspecialchars($_GET['page']);
        $PlatosPag =  $this->model->getAllPlatos($idSitio,$pageN);
        return $PlatosPag;
    }

    public function getAll(){
        $idSitio = htmlspecialchars($_GET['Sitio']);
        $datos['OneSitio'] = $this->model->getOne($idSitio);
        $datos['Ubicacion'] = $this->model->getUbicacion($idSitio);
        $datos['Horario'] = $this->model->getHorario($idSitio);
        $datos['Imagenes'] = $this->model->getImagenesSitio($idSitio);
        $datos['Comentarios'] = $this->model->getComentariosSitio($idSitio);
        $datos['Valoracion'] =  $this->model->getValoracionSitio($idSitio);
        $datos['Caract'] =  $this->model->getCaractSitio($idSitio);
     // var_dump( $datos['Caract']);
        return view('/sitios/OneSitio',compact('datos'));
    }
   
}
