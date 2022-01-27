<?php

namespace App\Models;

use App\Core\Model;

class Comentario extends Model{
    protected $table = "comentariositios";
    protected $idSitio;
    protected $n_per_coment = 2;


    public function store(array $comentario){
        $this->db->insert('comentariositios', $comentario);
    }


    public function getAll(){
        $todos = $this->db->selectAllSitios();
        $All = json_decode(json_encode($todos), True);
        return $All; 
    }

    public function getOne($idSitio){
        $basic = $this->db->selectSitio($idSitio);
        $basicSitio = (json_encode($basic,true));    
        return $basic;
    }
   
    public function getPaginacionComentarios($idSitio){
        //  $offset = ($pagenro-1) * $n_per_coment;
        $total_rows = $this->db->getPages($idSitio, 'comentariositios');
        $total_pages = ceil($total_rows / $this->n_per_coment);
        return $total_pages;
    }

    public function getAllComentarios($idSitio, $page){
        $offset = ($page - 1) * $this->n_per_coment;
        $Comentarios = $this->db->selectAllComentarios(
            $idSitio,
            $offset,
            $this->n_per_coment
        );
        $basicComentarios = json_encode($Comentarios);
        return $basicComentarios;
    }

  


  

  
    
    
}