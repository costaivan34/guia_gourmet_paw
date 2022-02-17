<?php

namespace App\Models;

use App\Core\Model;

class Plato extends Model{
    protected $table = 'plato';
    protected $n_per_plato = 6;


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
       //     return 1;
            if(empty($Sitio)){
                return 0;
            }else{
                 $plato = $this->db->agregarPlato(
                    $namePlato, $subject, $idSitio,$IP,$IE,$IC,$IPP,$IG,$IS,
                     $archivos,$Carac);
                    // var_dump("resultado 1");
                 return $plato;     
            }
    }


    public function deletePlato($idPlato)  {
        $op4 = $this->db->eliminarPlatos($idPlato);
        return  $op4;
    }

    public function getPaginacionPlatos($idSitio){
        $total_rows = $this->db->getPages($idSitio, 'platos');
        $total_pages = ceil($total_rows / $this->n_per_plato);
        return $total_pages;
    }



}
