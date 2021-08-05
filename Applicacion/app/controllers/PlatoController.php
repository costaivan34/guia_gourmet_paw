<?php

namespace App\Controllers;

use App\Core\Controller;

use App\Models\Plato;

class PlatoController extends Controller{
    protected $idSitio;
    protected $idPlato;
    public function __construct(){
        $this->model = new Plato();

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
        return  $plato;
    }

    public function newOne(){
        session_start();
        $datos["user"] = " ";
        if (isset($_SESSION["user"])){
            $datos["user"] =  $_SESSION["user"];
        }
        $datos["idSitio"] = htmlspecialchars($_GET['Sitio']);
        $datos["NameSitio"] = htmlspecialchars($_GET['Name']);
        return view('/sitios/NewPlatos', compact('datos'));
    }

    public function store(){
        $idPlato = $this->model->agregarPlato($_POST['namePlato'],$_POST['subject'], $_POST['namePrecio'],$_POST["idSitio"]);
        if ($idPlato>0){
            $this->model->agregarImagenes($_FILES,$idPlato);
             $this->model->agregarCaracteristicas($_POST['caracteristicas'],$idPlato);
            $this->model->agregarInfor($_POST['InformaciónPeso'],$_POST['InformaciónEnergia'],$_POST['InformaciónCarbohidratos'],$_POST['InformaciónProteina'],$_POST['InformaciónGrasas'],$_POST['InformaciónSodio'],$idPlato);
           return 1;   
        }else{
           return 0;   
        }
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
