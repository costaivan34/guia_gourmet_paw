<?php

namespace App\Models;

use App\Core\Model;

class Sitio extends Model{
    protected $table;
    protected $idSitio;
    protected $n_per_plato = 6;
    protected $n_per_coment = 6;
    protected $n_per_page = 6;

    public function getAll(){
        $todos = $this->db->selectAllSitios();
        $All = json_decode(json_encode($todos), true);
        return $All;
    }

    public function tienePlatos($idSitio){
        $basic = $this->db->selectPlatosList($idSitio);
        return $basic;
    }

    public function getPlatosFromSitios($idSitio){
        $datos = $this->db->selectPlatos($idSitio);
        //return json_decode(json_encode($datos),true);
        return$datos;
    }

    public function getNombreSitios($idSitio){
        $datos = $this->db->selectSitio($idSitio);
        //return json_decode(json_encode($datos),true);
        return $datos;
    }


    public function getOne($idSitio){
        $datos['OneSitio'] = $this->db->selectSitio($idSitio);
       ///var_dump(count($datos['OneSitio']));
        if(count($datos['OneSitio']) == 0){
            return 0;
        }else{
            $datos['Ubicacion'] = $this->getUbicacion($idSitio);
            $datos['Horario'] = $this->getHorario($idSitio);
            $datos['Imagenes'] = $this->getImagenesSitio($idSitio);
            $datos['Valoracion'] = $this->getValoracionSitio($idSitio);
            $datos['Caract'] = $this->getCaractSitio($idSitio);
            //$basicSitio = json_encode($basic, true);
            return $datos;
        }
    }

    public function getUbicacion($idSitio){
        $ubicacion = $this->db->selectUbicacion($idSitio);
        return $ubicacion;
    }

    public function getHorario($idSitio){
        $horario = $this->db->selectHorarios($idSitio);
        return $horario;
    }

    public function getImagenesSitio($idSitio){
        $Imagenes = $this->db->selectImagenesSitio($idSitio);
        return $Imagenes;
    }

    public function getValoracionSitio($idSitio){
        $Valoracion = $this->db->selectValoracionSitio($idSitio);
        return $Valoracion;
    }

    public function getCaractSitio($idSitio){
        $Caract = $this->db->selectListaCaractSitio($idSitio);
        $basicCaract = json_encode($Caract);
        return $basicCaract;
    }


    public function getCategorias(){
        $Categorias = $this->db->getCategorias();
        $basicCategorias = json_encode($Categorias);
        return $basicCategorias;
    }

    public function getDestacados(){
        $Destacados = $this->db->selectDestacados();
        $basicDestacados = json_encode($Destacados);
        return $Destacados;
    }


    public function buscar($Clave, $Provincia, $Categoria){
        $busqueda = $this->db->selectSitioBuscar(
            $Clave,
            $Provincia,
            $Categoria
        );
        $basicBusqueda = json_encode($busqueda);
        return $basicBusqueda;
    }

    public function getPaginacionBuscador($idSitio){
        $total_rows = $this->db->getPages($idSitio, 'platos');
        $total_pages = ceil($total_rows / $this->n_per_plato);
        return $total_pages;
    }

    function distance($lat1, $lon1, $lat2, $lon2) {
 
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        return ($miles  * 1.609344);
      }
      

    public function getMarcadores( $currentX, $currentY , $Ulong ,$Ulat,$Dlong,$Dlat ){
        $Marcadores = $this->db->selectCerca();
       $mark= [];
        foreach ($Marcadores as $value){
            //calcular distancia al lugar || $dist_to_place > $distSbounds
            //si dub y ddb son manores eliminar del array   
            $dist_to_place = $this->distance( $currentX, $currentY,$value->Y,$value->X);       
            $distNbounds = $this->distance($currentY,$currentX, $Ulat, $Ulong);
            $distSbounds = $this->distance( $currentY,$currentX, $Dlat,$Dlong);
       //     var_dump($dist_to_place >= $distNbounds  ); 
      //      var_dump("------------"  );        var_dump(  $dist_to_place   );     var_dump(  $distNbounds );   var_dump(  $distSbounds );
            if ($dist_to_place <= $distNbounds ){
          //      var_dump("entro"); 
                array_push($mark, $value); 
            }
        }
       
        $basicMarcadores = json_encode( $mark);
        return $basicMarcadores;
    }

    public function getPaginacionAllSitios(){
        $total_rows = $this->db->getPagesAllSitios();
        $total_pages = ceil($total_rows / $this->n_per_page);
        return $total_pages;
    }

    public function getAllSitios($page){
        $offset = ($page - 1) * $this->n_per_page;
        $Sitios = $this->db->selectAllSitios($offset, $this->n_per_page);
        $basicSitios = json_encode($Sitios);
        return $Sitios;
    }

    public function buscame($Clave, $Provincia, $Categoria, $page){
        $offset = ($page - 1) * $this->n_per_plato;
        if ($Provincia != 'TODAS' && $Categoria != 0) {
            //buscar provincia=X y categoria=X con/sin palabra clave
            $Sitios = $this->db->selectSitioBuscar(
                $Clave,
                strtolower($Provincia),
                $Categoria,
                $offset,
                $this->n_per_page
            );
        } elseif ($Provincia == 'TODAS' && $Categoria != 0) {
            //buscar provincia=TODAS y categoria=X con/sin palabra clave
            $Sitios = $this->db->selectSitioBuscarCategoria(
                $Clave,
                $Categoria,
                $offset,
                $this->n_per_page
            );
        } elseif ($Provincia != 'TODAS' && $Categoria == 0) {
            //buscar provincia=X y categoria=TODAS con/sin palabra clave
            $Sitios = $this->db->selectSitioBuscarProvincia(
                $Clave,
                strtolower($Provincia),
                $offset,
                $this->n_per_page
            );
        } else {
            //buscar provincia=TODAS y categoria=TODAS con/sin palabra clave
            $Sitios = $this->db->selectSitioBuscarAllSitios(
                $Clave,
                $offset,
                $this->n_per_page
            );
        }
        //  $basicSitios = json_encode($Sitios);
        return $Sitios;
    }

    public function getPaginacionBuscame($Clave, $Provincia, $Categoria){
        if ($Provincia != 'TODAS' && $Categoria != 0) {
            //buscar provincia=X y categoria=X con/sin palabra clave
            $total_rows = $this->db->PAGselectSitioBuscar(
                $Clave,
                strtolower($Provincia),
                $Categoria
            );
        } elseif ($Provincia == 'TODAS' && $Categoria != 0) {
            //buscar provincia=todas y categoria=X  con/sin palabra clave
            $total_rows = $this->db->PAGselectSitioBuscarCategoria(
                $Clave,
                $Categoria
            );
        } elseif ($Provincia != 'TODAS' && $Categoria == 0) {
            //buscar provincia=X y categoria=TODAS con/sin palabra clave
            $total_rows = $this->db->PAGselectSitioBuscarProvincia(
                $Clave,
                strtolower($Provincia)
            );
        } else {
            //buscar provincia=todas y categoria=todas con/sin palabra clave
            $total_rows = $this->db->PAGselectSitioBuscarAllSitios($Clave);
        }
        $total_pages = ceil($total_rows / $this->n_per_page);
        return $total_pages;
    }
    
                
    public function agregarSitio($nameSitio,$subject,$DireccionSitio, $LocalidadSitio,$ProvinciaSitio,$longitud,$latitud, $MailSitio,$TelefonoSitio,$user,$horarios,$servicios,$FILES) {
       $datos = $this->db->agregarSitio($nameSitio,$subject,$DireccionSitio, $LocalidadSitio,$ProvinciaSitio,$longitud,$latitud, $MailSitio,$TelefonoSitio,$user,$horarios,$servicios,$FILES);
       return $datos;
    }

    public function deleteSitio($idSitio){
        $op4 = $this->db->eliminarSitio($idSitio);
        return  $op4;
    }
}
