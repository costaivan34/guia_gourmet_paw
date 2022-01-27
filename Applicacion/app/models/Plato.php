<?php

namespace App\Models;

use App\Core\Model;

class Plato extends Model{
    protected $table = 'plato';
    protected $n_per_plato = 6;


    public function getAll()
    {
        $todos = $this->db->selectAllPlato('plato');
        $All = json_decode(json_encode($todos), true);
        return $All;
    } 
   
    public function getAllPlatos($idSitio, $page){
        $offset = ($page - 1) * $this->n_per_plato;
        $Platos = $this->db->selectAllPlatos(
            $idSitio,
            $offset,
            $this->n_per_plato
        );
       // var_dump($Platos);
        $basicPlatos = json_encode($Platos);
        return $basicPlatos;
    }



    public function getOne($idSitio, $idPlato)  {
        $Plato = $this->db->selectPlato($idSitio, $idPlato);

        $listaValor = $this->db->selectInfo($idPlato);
        $imagen = $this->db->selectImagenPlato($idPlato);
        $caract = $this->db->selectListaCaract($idPlato);
        $basicPlato['info'] = json_encode($Plato);
        $basicPlato['img'] = json_encode($imagen);
        $basicPlato['caract'] = json_encode($caract);
        $basicPlato['lista'] = json_encode($listaValor);
        return json_encode($basicPlato);
    }

    public function agregarPlato($namePlato, $subject, $idSitio,
        $IP,$IE,$IC,$IPP,$IG,$IS,$archivos,$Carac){
            $Sitio = $this->db->selectSitio($idSitio);
            if($Sitio){
                $this->db->agregarPlato(
                $namePlato, $subject, $idSitio,$IP,$IE,$IC,$IPP,$IG,$IS,
                $archivos,$Carac);
                return 1;
            }else{
                return 0;
            }
    }


    public function deletePlato($idPlato)  {
        $this->db->eliminarCaracPlatos($idPlato);
        $this->db->eliminarValorPlatos($idPlato);
        $this->db->eliminarImagenesPlatos($idPlato);
        $op4 = $this->db->eliminarPlatos($idPlato);
        return 1;
    }

    public function getPaginacionPlatos($idSitio){
        $total_rows = $this->db->getPages($idSitio, 'platos');
        $total_pages = ceil($total_rows / $this->n_per_plato);
        return $total_pages;
    }



}
