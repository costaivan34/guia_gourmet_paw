<?php

namespace App\Models;

use App\Core\Model;

class Plato extends Model{
    protected $idSitio;
    protected $idPlato;
    protected $table = 'plato';

    public function getAll(){
        $todos = $this->db->selectAllPlato('plato');
        $All = json_decode(json_encode($todos), True);
        return $All; 
    }

    

    public function getOne($idSitio,$idPlato){
        $Plato = $this->db->selectPlato($idSitio,$idPlato);
        $listaValor= $this->db->selectInfo($idPlato);
        $imagen = $this->db->selectImagenPlato($idPlato);
        $caract =$this->db->selectListaCaract($idPlato);
        $basicPlato['info'] =json_encode($Plato);
        $basicPlato['img'] =json_encode($imagen);
        $basicPlato['caract'] =json_encode($caract);
        $basicPlato['lista'] =json_encode($listaValor);
        return  (json_encode($basicPlato));
    }
}