<?php

namespace App\Controllers;

use App\Core\Controller;

use App\Models\Page;

class PagesController extends Controller{

    public function __construct(){
        $this->model = new Page();
    }
    
    /**
     * Show the Error 404 page.
     */
    public function notFound(){
        session_start();
        if (isset($_SESSION["user"])){
            $datos["user"] = $_SESSION["user"];
        }else{
            $datos["user"] = " " ;
        }
        return view('/errors/not-found', compact('datos'));
    }

    /**
     * Show the Error 500 page
     */
    public function internalError(){
        session_start();
        if (isset($_SESSION["user"])){
            $datos["user"] = $_SESSION["user"];
        }else{
            $datos["user"] = " " ;
        }
        return view('/errors/internal-error', compact('datos'));
    }
    
    public function contacto($data = null){
        if ($data == null){
            $data = [  
                ['input' => "",
                'estado' => "",//class="" o class="input-error"
                'mensaje' =>"",//"mensaje de error si hay
                ],
                ['input' => "",
                'estado' => "",//class="" o class="input-error"
                'mensaje' =>"",//"mensaje de error si hay
                ],
                ['input' => "",
                'estado' => "",//class="" o class="input-error"
                'mensaje' =>"",//"mensaje de error si hay
                ],
                ['input' =>"",
                'estado' => "",//class="" o class="input-error"
                'mensaje' =>"",//"mensaje de error si hay
                ],
                ['errores' => 0],
            ];
        }
        session_start();
        if (isset($_SESSION["user"])){
            $datos["user"] =  $_SESSION["user"];
        }else{
            $datos["user"] = " ";
        }
        $datos["form"] = $data;
        return view('/home/contact', compact('datos'));
    }

    public function verificar_params($POST, $datos){
        $error_count = 0;
        // Comprobar si llegaron los campos requeridos:
         //   nombreUser
        $POST['nombreUser'] = filter_var($POST['nombreUser'], FILTER_SANITIZE_STRING);
        if( empty($POST['nombreUser']) ){
            $error_count++;
            $datos[0]['input']= $POST['nombreUser'];
            $datos[0]['estado']= "input-error";
            $datos[0]['mensaje']= "Completa este campo";
            }else{
                // si tiene mas de 4 letras
                // Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
                $datos[0]['input'] = $POST['nombreUser'];
                if( strlen( $POST['nombreUser'] ) < 4 ){
                    $error_count++;
                    $datos[0]['estado'] = "input-error";
                    $datos[0]['mensaje'] = "Alarga el texto a 4 o más caracteres";
            }
        }
     
          //    apellidoUser
        $POST['apellidoUser'] = filter_var($POST['apellidoUser'], FILTER_SANITIZE_STRING);
        if( empty($POST['apellidoUser']) ){
            $error_count++;
            $datos[1]['input']= $POST['apellidoUser'];
            $datos[1]['estado']= "input-error";
            $datos[1]['mensaje']= "Completa este campo";
            }else{
                // si tiene mas de 4 letras
                // Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
                $datos[1]['input'] = $POST['apellidoUser'];
                if( strlen( $POST['apellidoUser'] ) < 5 ){
                    $error_count++;
                    $datos[1]['estado'] = "input-error";
                    $datos[1]['mensaje'] = "Alarga el texto a 4 o más caracteres";
            }
        }
        //  mailUser
        $POST['mailUser'] = filter_var($POST['mailUser'], FILTER_SANITIZE_EMAIL);
        if( empty($POST['mailUser']) ){
            $error_count++;
            $datos[2]['input'] = $POST['mailUser'];
            $datos[2]['estado'] = "input-error";
            $datos[2]['mensaje'] = "Completa este campo";
        }else{
            // si tiene mas de 4 letras
            // Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
            $datos[2]['input'] = $POST['mailUser'];
            if (!filter_var($POST['mailUser'], FILTER_VALIDATE_EMAIL)) {
                    $error_count++;
                    $datos[2]['estado']= "input-error";
                    $datos[2]['mensaje']= "Incluye un signo '@' en la dirección de correo electrónico.";
            }
        }

        $POST['subject'] = filter_var($POST['subject'], FILTER_SANITIZE_STRING);
        if( empty($POST['subject']) ){
            $error_count++;
            $datos[3]['input']= $POST['subject'];
            $datos[3]['estado']= "input-error";
            $datos[3]['mensaje']= "Completa este campo";
            }else{
        // si tiene mas de 4 letras
        // Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
             $datos[3]['input']= $POST['subject'];
            if(strlen( $POST['subject']) < 40 ){
                    $error_count++;
                    $datos[3]['estado']= "input-error";
                    $datos[3]['mensaje']= "Alarga el texto a 4 o más caracteres";
                }
            }
 
        $datos['errores'] = $error_count;
        return $datos;
    }

    public function sendConsulta(){	
        $data = [  
            ['input' => "",
            'estado' => "",//class="" o class="input-error"
            'mensaje' =>"",//"mensaje de error si hay
            ],
            ['input' => "",
            'estado' => "",//class="" o class="input-error"
            'mensaje' =>"",//"mensaje de error si hay
            ],
            ['input' => "",
            'estado' => "",//class="" o class="input-error"
            'mensaje' =>"",//"mensaje de error si hay
            ],
            ['input' =>"",
            'estado' => "",//class="" o class="input-error"
            'mensaje' =>"",//"mensaje de error si hay
            ],
            ['errores' => 0],
        ];
        $data = $this->verificar_params($_POST,$data);
        $ok =  $data[4]['errores'];
        if ( $ok == 0){
            $statement= $this->model->agregarConsulta($_POST['nombreUser'],$_POST['apellidoUser'],$_POST['mailUser'],
            $_POST['subject']);
            if(($statement)==1){
                return $this->contacto();
            }else{
                return $this->internalError();
            }
        }else{
            return $this->contacto($data);
       }     
   }
    
   
}


