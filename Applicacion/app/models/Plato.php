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

    public function agregarPlato($namePlato,$subject, $namePrecio,$idSitio){
        $datos = $this->db->agregarPlato($namePlato,$subject, $namePrecio,$idSitio);
        return $datos;
        
    }
 
    public function deletePlato($idPlato){
        $op1 = $this->db->eliminarCaracPlatos($idPlato);
        if ($op1==1){
            $op2 =  $this->db->eliminarValorPlatos($idPlato);
            if ($op2==1){
                $op3 = $this->db->eliminarImagenesPlatos($idPlato);
            if ($op3==1){
                $op4 =$this->db->eliminarPlatos($idPlato);
            if($op4==1){
                return 1;
            }
            }
            }
        }
        return 0;
    }

    public function agregarImagenes($Archivos,$idPlato){
        if ((isset($Archivos['archivosubido']) && is_uploaded_file($Archivos['archivosubido']['tmp_name']) )){
            $fileTmpPath = $_FILES['archivosubido']['tmp_name'];
            $uploadFileDir = "./private/plates/".$idPlato."/";
            mkdir($uploadFileDir, 0777, true);
            $dest_path =  $uploadFileDir."/1.jpg";
            move_uploaded_file($fileTmpPath, $dest_path);
        }
        $dest_path = substr( $dest_path, 1);
        $this->db->agregarImagenes1($idPlato, $dest_path);
    }

 

    public function agregarCaracteristicas($caracteristicas,$idPlato){
         foreach ($caracteristicas as $value) {
            $datos = $this->db->agregarCaracteristicas($value,$idPlato);
        }
        return $datos;
    }


    public function agregarInfor($InformaciónPeso,$InformaciónEnergia,$InformaciónCarbohidratos,$InformaciónProteina,$InformaciónGrasas,$InformaciónSodio,$idPlato){
        $this->db->agregarInfor(1,$InformaciónPeso,$idPlato);
        $this->db->agregarInfor(2,$InformaciónEnergia,$idPlato);
        $this->db->agregarInfor(3,$InformaciónCarbohidratos,$idPlato); 
        $this->db->agregarInfor(4,$InformaciónProteina,$idPlato);
        $this->db->agregarInfor(5,$InformaciónGrasas,$idPlato);
        $this->db->agregarInfor(6,$InformaciónSodio,$idPlato);   
    }

    

    public function getOne($idSitio,$idPlato){
        $Plato = $this->db->selectPlato($idSitio,$idPlato);
        $listaValor= $this->db->selectInfo($idPlato);
        $imagen = $this->db->selectImagenPlato($idPlato);
        $caract =$this->db->selectListaCaract($idPlato);
        $basicPlato['info'] =(json_encode($Plato));
        $basicPlato['img'] =json_encode($imagen);
        $basicPlato['caract'] =json_encode($caract);
        $basicPlato['lista'] =json_encode($listaValor);
        return  (json_encode($basicPlato));
    }


}