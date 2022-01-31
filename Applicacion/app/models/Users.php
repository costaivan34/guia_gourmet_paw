<?php

namespace App\Models;

use App\Core\Model;

class Users extends Model{

    protected $table = 'usuarios';

    public function insert(array $user){
        $this->db->insert($this->table, $user);
    }

    public function agregarUsuario($nombreUsuario ,$nombre ,$apellido ,$mail ,$pais ,$telefono,$password,$path_img){
        $opciones = [  'cost' => 12, ];
        $password = password_hash($password, PASSWORD_BCRYPT, $opciones);
        $datos = $this->db->agregarUsuario($mail ,$nombreUsuario ,$nombre ,$apellido ,$pais ,$telefono,$password,$path_img);
        return $datos;
    }

    public function updateUsuario($mail, $nombre, $apellido, $ubicacion, $telefono){
        $datos = $this->db->updateUsuario($mail, $nombre, $apellido, $ubicacion, $telefono);
        return $datos;
    }

    public function updatePassword($user, $password){
        $password= md5($password,false);
        $datos = $this->db->updatePassword($user, $password);
        return $datos;
    }

    public function validarLogin($user, $password){
      
        $hash_BD = $this->db->validarLogin($user);
        if (password_verify( $password, $hash_BD[0]->password)) {
            return 1;
        } else {
            return 0; 
        }
    }

    public function isFree($mail){
        return $this->db->isFree($mail);
    }



    public function getUsuario($user){
        $datos = $this->db->getUsuario($user);
        //$datos = (json_encode($datos,true)); 
        $tdatos= json_decode(json_encode($datos), True);
       return $datos;
    }

    public function getDatosUsuario($user){
        $datos = $this->db->getDatosUsuario($user);
        //return json_encode($datos);
       return $datos;
    }

    public function getSitiosUsuario($user){
        $datos = $this->db->getSitiosUsuario($user);
        //return json_decode(json_encode($datos),true);
        return$datos;
    }

  
}



