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
/*

      //Como el elemento es un arreglos utilizamos foreach para extraer todos los valores
	//foreach($Archivos['archivosubido']['tmp_name'] as $key => $tmp_name){
		//Validamos que el archivo exista
		if($Archivos['archivosubido']['tmp_name']) {
			$filename = $Archivos['archivosubido']['tmp_name']; //Obtenemos el nombre original del archivo
			$source = $Archivos['archivosubido']["tmp_name"]; //Obtenemos un nombre temporal del archivo
			$directorio = "./private/plates/".$idPlato."/";//Declaramos un  variable con la ruta donde guardaremos los archivos
			//Validamos si la ruta de destino existe, en caso de no existir la creamos
			if(!file_exists($directorio)){
				mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");	
			}
			$dir=opendir($directorio); //Abrimos el directorio de destino
			$target_path = $directorio.'/'.$filename; //Indicamos la ruta de destino, así como el nombre del archivo
			//Movemos y validamos que el archivo se haya cargado correctamente
			//El primer campo es el origen y el segundo el destino
			if(move_uploaded_file($source, $target_path)) {	
                $target_path = substr( $target_path, 1);
                $this->db->agregarImagenes1($idPlato,$target_path);
				echo "El archivo $filename se ha almacenado en forma exitosa.<br>";
				} else {	
				echo "Ha ocurrido un error, por favor inténtelo de nuevo.<br>";
			}
			closedir($dir); //Cerramos el directorio de destino
		}
//	}*/
 

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
        $basicPlato['info'] =json_encode($Plato);
        $basicPlato['img'] =json_encode($imagen);
        $basicPlato['caract'] =json_encode($caract);
        $basicPlato['lista'] =json_encode($listaValor);
        return  (json_encode($basicPlato));
    }


}