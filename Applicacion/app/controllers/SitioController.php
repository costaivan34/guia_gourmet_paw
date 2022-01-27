<?php

namespace App\Controllers;

use App\Core\Controller;

use App\Models\Sitio;
use App\Models\Comentario;
use App\Models\Plato;
use App\Models\Users;

class SitioController extends Controller{
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


   public function newOne(){
    session_start();
        $datos["user"] = " ";
        if (isset($_SESSION["user"])){
            $datos["user"] =  $_SESSION["user"];
        }
        return view('/sitios/NewSitio',compact('datos'));
}

  

    public function store(){
        //si formulario valido
        //=>>> store
        //si formulario invalido
        //=>> reeenviar con errores
        var_dump($_POST); 
        var_dump($_FILES);  
       // $this->model->insertarSitio($_POST, $_FILES);
       $sitio = [ 
        'idSitio' => $_POST['sitio'],
        'nombre' => $_POST['nombre'],
        'descripcion' => $_POST['texto'],
        'telefono' => $_POST['precio'],
        'sitioWeb' => $_POST['mail'],
        'idUsuario' => $_POST['precio'],
        'idCategoria' => $_POST['sabor'],
    ];
        $idSitio= $this->model->agregarSitio($_POST['nameSitio'],$_POST['subject'], $_POST['TelefonoSitio'],
        $_POST['MailSitio'],$_POST["username"],1);
        if ($idSitio>0){
        $this->model->agregarImagenes($_FILES,$idSitio);
        $this->model->agregarServicios($_POST['servicios'],$idSitio);
        $this->model->agregarHorarios($_POST['Dia-Inicio'],$_POST['Dia-Fin'],$_POST['De-Inicio'],$_POST['Hasta-Fin'],$idSitio);
        $this->model->agregarUbicacion($idSitio, $_POST['DireccionSitio'],$_POST['LocalidadSitio'],$_POST['ProvinciaSitio'],$_POST['Longitud'],$_POST['Latitud']);
            return 1;   
        }else{
            return 0;   
        }
    }

    public function delete(){
        if($this->model->tienePlatos($_POST['idSitio'])>0){
            return 0;
        }else{
            $idSitio= $this->model->deleteSitio($_POST['idSitio']);
            if ($idSitio==1){
                return 1;   
            }else{
                return 0;   
            }
        }
        
    }


    public function getOne(){
        session_start();
        $idSitio = htmlspecialchars($_GET['Sitio']);
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



