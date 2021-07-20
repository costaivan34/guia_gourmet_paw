<?php

namespace App\Controllers;

use App\Core\Controller;

use App\Models\Sitio;

class SitioController extends Controller{
    protected $idSitio;

    public function __construct(){
      
        $this->model = new Sitio();
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
     $this->model->agregarComentario($comentario);
    
    return $this->model->getPaginacionComentarios($_POST['sitio']);
   }

    public function getOne(){
        session_start();
        $datos["user"] = " ";
        if (isset($_SESSION["user"])){
            $datos["user"] =  $_SESSION["user"];
        }
        $idSitio = htmlspecialchars($_GET['Sitio']);
        $datos['OneSitio'] = $this->model->getOne($idSitio);
        $datos['Ubicacion'] = $this->model->getUbicacion($idSitio);
        $datos['Horario'] = $this->model->getHorario($idSitio);
        $datos['Imagenes'] = $this->model->getImagenesSitio($idSitio);
        $datos['Valoracion'] =  $this->model->getValoracionSitio($idSitio);
        $datos['Caract'] =  $this->model->getCaractSitio($idSitio);
        return view('/sitios/OneSitio',compact('datos'));
    }

    public function getPlatos(){
        $idSitio = htmlspecialchars($_GET['Sitio']);
        $pageN = htmlspecialchars($_GET['page']);
        $PlatosPag =  $this->model->getAllPlatos($idSitio,$pageN);
        return $PlatosPag;
    }

    public function getComentarios(){
        $idSitio = htmlspecialchars($_GET['Sitio']);
        $pageN = htmlspecialchars($_GET['page']);
        $Comentarios=  $this->model->getAllComentarios($idSitio,$pageN);
      // var_dump($Comentarios);
        return $Comentarios;
    }

    public function getPlatoPage(){
        $idSitio = htmlspecialchars($_GET['Sitio']);
        $PaginacionPlatos =  $this->model->getPaginacionPlatos($idSitio);
        //var_dump($datos);
        return $PaginacionPlatos;
    }


    public function getComentarioPage(){
        $idSitio = htmlspecialchars($_GET['Sitio']);
        $pageN = htmlspecialchars($_GET['page']);
        $PaginacionComentarios =  $this->model->getPaginacionComentarios($idSitio);
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
    
    public function getRealIP() {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
            return $_SERVER['HTTP_CLIENT_IP'];
           
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        return $_SERVER['REMOTE_ADDR'];
    }

    public function cerca(){
        session_start();
        $ip = $this->getRealIP();
        $ip = "190.50.95.168";
        //$ip = '108.62.211.172';
        $informacionSolicitud = file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip);
        $dataSolicitud = json_decode($informacionSolicitud);
        $datos["latitud"] = $dataSolicitud->geoplugin_latitude;
        $datos["longitud"] = $dataSolicitud->geoplugin_longitude;
        $datos["latitud"] =-35.0007752 ;
        $datos["longitud"] =-59.276512 ;
        $datos["ciudad"]= $dataSolicitud->geoplugin_city;
        $datos["region"]= $dataSolicitud->geoplugin_region;
       
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
        $Ciudad = htmlspecialchars($_GET['Ciudad']);
        $Provincia = htmlspecialchars($_GET['Provincia']);
        $Datos=$this->model->getMarcadores($Ciudad,$Provincia);
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



