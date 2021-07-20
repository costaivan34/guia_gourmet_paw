<?php

namespace App\Models;

use App\Core\Model;

class Users extends Model
{
    protected $table = 'usuarios';

    public function insert(array $user)
    {
        $this->db->insert($this->table, $user);
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
        $password= md5($password,false);
        $datos = $this->db->validarLogin($user, $password);
        return $datos;
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


