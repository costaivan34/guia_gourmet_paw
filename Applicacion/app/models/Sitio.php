<?php

namespace App\Models;

use App\Core\Model;

class Sitio extends Model
{
    protected $table;
    protected $idSitio;
    protected $n_per_plato = 4;
    protected $n_per_coment = 4;
    protected $n_per_page = 4;

    public function getAll()
    {
        $todos = $this->db->selectAllSitios();
        $All = json_decode(json_encode($todos), true);
        return $All;
    }

    public function tienePlatos($idSitio)
    {
        $basic = $this->db->selectPlatosList($idSitio);
        return $basic;
    }

    public function getOne($idSitio)
    {
        $basic = $this->db->selectSitio($idSitio);
        $basicSitio = json_encode($basic, true);
        return $basic;
    }

    public function getUbicacion($idSitio)
    {
        $ubicacion = $this->db->selectUbicacion($idSitio);
        //$basicUbicacion = json_decode(json_encode($basic), True);
        return $ubicacion;
    }

    public function getHorario($idSitio)
    {
        $horario = $this->db->selectHorarios($idSitio);
        //$basicUbicacion = json_decode(json_encode($basic), True);
        return $horario;
    }
    public function getImagenesSitio($idSitio)
    {
        $Imagenes = $this->db->selectImagenesSitio($idSitio);
        //$basicUbicacion = json_decode(json_encode($basic), True);
        return $Imagenes;
    }

    public function getValoracionSitio($idSitio)
    {
        $Valoracion = $this->db->selectValoracionSitio($idSitio);
        //$basicUbicacion = json_decode(json_encode($basic), True);
        return $Valoracion;
    }
    public function getCaractSitio($idSitio)
    {
        $Caract = $this->db->selectListaCaractSitio($idSitio);
        $basicCaract = json_encode($Caract);
        return $basicCaract;
    }

    public function getPaginacionPlatos($idSitio)
    {
        $total_rows = $this->db->getPages($idSitio, 'platos');
        $total_pages = ceil($total_rows / $this->n_per_plato);
        return $total_pages;
    }

    public function agregarComentario(array $comentario)
    {
        $this->db->insert('comentariositios', $comentario);
    }

    public function getPaginacionComentarios($idSitio)
    {
        //  $offset = ($pagenro-1) * $n_per_coment;
        $total_rows = $this->db->getPages($idSitio, 'comentariositios');
        $total_pages = ceil($total_rows / $this->n_per_coment);
        return $total_pages;
    }

    public function getAllPlatos($idSitio, $page)
    {
        $offset = ($page - 1) * $this->n_per_plato;
        $Platos = $this->db->selectAllPlatos(
            $idSitio,
            $offset,
            $this->n_per_plato
        );
        $basicPlatos = json_encode($Platos);
        return $basicPlatos;
    }

    public function getAllComentarios($idSitio, $page)
    {
        $offset = ($page - 1) * $this->n_per_coment;
        $Comentarios = $this->db->selectAllComentarios(
            $idSitio,
            $offset,
            $this->n_per_coment
        );
        $basicComentarios = json_encode($Comentarios);
        return $basicComentarios;
    }

    public function getCategorias()
    {
        $Categorias = $this->db->getCategorias();
        $basicCategorias = json_encode($Categorias);
        return $basicCategorias;
    }

    public function getDestacados()
    {
        $Destacados = $this->db->selectDestacados();
        $basicDestacados = json_encode($Destacados);
        return $Destacados;
    }

    public function agregarConsulta($nombre, $apellido, $mail, $texto)
    {
        $datos = $this->db->agregarConsulta($nombre, $apellido, $mail, $texto);
        return $datos;
    }

    public function deleteSitio($idSitio)
    {
        $this->db->eliminarCaractSitio($idSitio);
        $this->db->eliminarComentarioSitios($idSitio);
        $this->db->eliminarImagenesSitios($idSitio);
        $this->db->eliminarUbicacion($idSitio);
        $this->db->eliminarHorario($idSitio);
        $this->db->eliminarSitio($idSitio);
        return 1;
    }

    public function agregarSitio(
        $nameSitio,
        $subject,
        $TelefonoSitio,
        $MailSitio,
        $user,
        $cat
    ) {
        $datos = $this->db->agregarSitio(
            $nameSitio,
            $subject,
            $TelefonoSitio,
            $MailSitio,
            $user,
            $cat
        );
        return $datos;
    }
    public function agregarServicios($_servicios, $idSitio)
    {
        foreach ($_servicios as $value) {
            $datos = $this->db->agregarServicio($value, $idSitio);
        }
        return $datos;
    }

    public function agregarHorarios($Inicio, $Fin, $De, $Hasta, $idSitio)
    {
        for ($x = $Inicio; $x <= $Fin; $x++) {
            $datos = $this->db->agregarHorarios($idSitio, $x, $De, $Hasta);
        }
        return $datos;
    }

    public function agregarUbicacion(
        $idSitio,
        $direccion,
        $ciudad,
        $provincia,
        $X,
        $Y
    ) {
        $datos = $this->db->agregarUbicacion(
            $idSitio,
            $direccion,
            $ciudad,
            $provincia,
            $X,
            $Y
        );
        return $datos;
    }

    public function agregarImagenes($Archivos, $idSitio)
    {
        //Como el elemento es un arreglos utilizamos foreach para extraer todos los valores
        foreach ($Archivos['archivosubido']['tmp_name'] as $key => $tmp_name) {
            //Validamos que el archivo exista
            if ($Archivos['archivosubido']['name'][$key]) {
                $filename = $Archivos['archivosubido']['name'][$key]; //Obtenemos el nombre original del archivo
                $source = $Archivos['archivosubido']['tmp_name'][$key]; //Obtenemos un nombre temporal del archivo
                $directorio = './private/sites/' . $idSitio . '/'; //Declaramos un  variable con la ruta donde guardaremos los archivos
                //Validamos si la ruta de destino existe, en caso de no existir la creamos
                if (!file_exists($directorio)) {
                    mkdir($directorio, 0777) or
                        die(
                            'No se puede crear el directorio de extracci&oacute;n'
                        );
                }
                $dir = opendir($directorio); //Abrimos el directorio de destino
                $target_path = $directorio . '/' . $filename; //Indicamos la ruta de destino, así como el nombre del archivo
                //Movemos y validamos que el archivo se haya cargado correctamente
                //El primer campo es el origen y el segundo el destino
                if (move_uploaded_file($source, $target_path)) {
                    $target_path = substr($target_path, 1);
                    $this->db->agregarImagenes($idSitio, $target_path);
                    //	echo "El archivo $filename se ha almacenado en forma exitosa.<br>";
                } else {
                    //	echo "Ha ocurrido un error, por favor inténtelo de nuevo.<br>";
                }
                closedir($dir); //Cerramos el directorio de destino
            }
        }
    }

    public function getPaginacionBuscador($idSitio)
    {
        $total_rows = $this->db->getPages($idSitio, 'platos');
        $total_pages = ceil($total_rows / $this->n_per_plato);
        return $total_pages;
    }

    public function buscar($Clave, $Provincia, $Categoria)
    {
        $busqueda = $this->db->selectSitioBuscar(
            $Clave,
            $Provincia,
            $Categoria
        );
        $basicBusqueda = json_encode($busqueda);
        return $basicBusqueda;
    }

    public function busqueda()
    {
    }

    public function getMarcadores()
    {
        $Marcadores = $this->db->selectCerca();
        $basicMarcadores = json_encode($Marcadores);
        return $basicMarcadores;
    }

    public function getPaginacionAllSitios()
    {
        $total_rows = $this->db->getPagesAllSitios();
        $total_pages = ceil($total_rows / $this->n_per_page);
        return $total_pages;
    }

    public function getAllSitios($page)
    {
        $offset = ($page - 1) * $this->n_per_page;
        $Sitios = $this->db->selectAllSitios($offset, $this->n_per_page);
        $basicSitios = json_encode($Sitios);
        return $Sitios;
    }

    public function buscame($Clave, $Provincia, $Categoria, $page)
    {
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

    public function getPaginacionBuscame($Clave, $Provincia, $Categoria)
    {
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
}
