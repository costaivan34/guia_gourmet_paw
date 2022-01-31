<?php

namespace App\Controllers;


use App\Models\Page;

class PagesController{

    public function __construct(){
        
        $this->model = new Page();
    }
    
    /**
     * Show the Error 404 page.
     */
    public function notFound(){
        session_start();
        if (isset($_SESSION["user"])){
            $datos["user"] = $_SESSION["user"];
        }else{
            $datos["user"] = " " ;
        }
        return view('/errors/not-found', compact('datos'));
    }

    /**
     * Show the Error 500 page
     */
    public function internalError(){
        session_start();
        if (isset($_SESSION["user"])){
            $datos["user"] = $_SESSION["user"];
        }else{
            $datos["user"] = " " ;
        }
        return view('/errors/internal-error', compact('datos'));
    }
    
    public function contacto(){
        session_start();
        if (isset($_SESSION["user"])){
            $datos["user"] =  $_SESSION["user"];
        }else{
            $datos["user"] = " ";
        }
        return view('/home/contact', compact('datos'));
    }

    public function sendConsulta(){	
        $comentario = [ 
            'nombre' => $_POST['nombre'],
            'apellido' => $_POST['apellido'],
            'mail' => $_POST['mail'],
            'texto' => $_POST['texto'],
        ];
        $statement= $this->model->agregarConsulta($_POST['nombre'],$_POST['apellido'],$_POST['mail'],
        $_POST['texto']);
        if(($statement)==1){
            return 1;
        }else{
            return 0;
        }
   }
    
   
}


