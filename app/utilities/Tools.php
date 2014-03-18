<?php

require_once 'TrimCuston.php';
require_once 'ImageProcess.php';


class Tools{

    public static function valida_imagen($archivo,$prefijo="",$minW=405,$minH=305,$maxWidth=600,$path="img/uploads/"){
       
        $success = "ERROR";
        $message = "ERROR";

        if(isset($_FILES[$archivo]['name'])){
            $nombre = $_FILES[$archivo]['name'];
            $tipo = $_FILES[$archivo]['type'];
            $temporal =$_FILES[$archivo]['tmp_name'];
            $is_error = $_FILES[$archivo]['error'] ;
            $tamano = $_FILES[$archivo]['size'] ;
            $extension = pathinfo($nombre, PATHINFO_EXTENSION);


            $nuevo_nombre = $prefijo."-".strtolower(TrimCuston::sanear_string(basename($nombre, ".".$extension)))."-".date("ymdhis").".".$extension;

            if ( $is_error == 0 ){
                if (($extension != "jpg") && ($extension != "png")){
                    $message = "La extensión no es valida ( Solo se permiten archivos .jpg y .png )";
                }else{
                    if ( round(intval($tamano/1048576, 2) > 5) ){
                        $message = 'La imagen no puede superar los 5 Mb.';
                    }else{
                        list($mW, $mH) = getimagesize($temporal);         
                        if (($mW >= $minW)&&($mH >= $minH)){
                            //chmod($original_image_location, 0777);
                            if(move_uploaded_file($temporal,"img/uploads/".$nuevo_nombre )){
                                $width = ImageProcess::getWidth($path.$nuevo_nombre);
                                $height = ImageProcess::getHeight($path.$nuevo_nombre);
                           
                                if ($width > $maxWidth){
                                    $scale = $maxWidth/$width;
                                    $uploaded = ImageProcess::resizeImage($path.$nuevo_nombre,$width,$height,$scale);
                                }else{
                                    $scale = 1;
                                    $uploaded = ImageProcess::resizeImage($path.$nuevo_nombre,$width,$height,$scale);
                                }

                                $success = $nuevo_nombre;
                                $message = 'OK';                            
                            }else{
                                $message = 'Error al mover la imagen a la carpeta uploads.';
                            }
                        }else{
                            $message ='Las dimensiones de la imagen cargada son de : '.$mW.' x '.$mH.' pixeles (Baja calidad), el minimo requerido es de : '.$minW.' x '.$minH.' pixeles.' ;
                        }
                    }
                }
            }else{
                $message = "La imagen contine errores o un virus en todo caso, intente nuevamente."; 
            } 
        }else{
            $message = "La imagen no ha sido seleccionada."; 
        }

        return array('success' =>$success ,'message' =>$message ); 
    }
}    