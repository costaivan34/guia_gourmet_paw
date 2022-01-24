<?php

namespace App\Models;

use App\Core\Model;

class Plato extends Model
{
    protected $idSitio;
    protected $idPlato;
    protected $table = 'plato';

    public function getAll()
    {
        $todos = $this->db->selectAllPlato('plato');
        $All = json_decode(json_encode($todos), true);
        return $All;
    } 
   
    public function agregarPlato($namePlato, $subject, $namePrecio, $idSitio,
        $IP,$IE,$IC,$IPP,$IG,$IS,$archivos,$Carac){
            $Sitio = $this->db->selectSitio($idSitio);
            if( $Sitio){
                $this->db->agregarPlato(
                $namePlato, $subject, $namePrecio,$idSitio,$IP,$IE,$IC,$IPP,$IG,$IS,
                $archivos,$Carac);
                return true;
            }else{
                return false;
            }
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

    public function getNombreSitios($idSitio){
        $datos = $this->db->selectSitio($idSitio);
        //return json_decode(json_encode($datos),true);
        return $datos;
    }
    public function deletePlato($idPlato)
    {
        $this->db->eliminarCaracPlatos($idPlato);
        $this->db->eliminarValorPlatos($idPlato);
        $this->db->eliminarImagenesPlatos($idPlato);
        $op4 = $this->db->eliminarPlatos($idPlato);
        return 1;
    }
}
