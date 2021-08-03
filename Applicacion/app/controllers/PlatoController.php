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

    public function new_plato(){
        session_start();
        $datos["user"] = " ";
        if (isset($_SESSION["user"])){
            $datos["user"] =  $_SESSION["user"];
        }
        $idSitio = htmlspecialchars($_GET['Sitio']);
        return view('/sitios/NewPlatos', compact('datos'));
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
