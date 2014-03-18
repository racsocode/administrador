<?php
function paginar($actual, $total, $por_pagina, $enlace){
   $total_paginas = ceil($total/$por_pagina);
  $anterior = $actual - 1;
  $posterior = $actual + 1;
  if ($actual>1)
    $texto = "<a href=\"$enlace$anterior\">&laquo;</a>";
  else
    $texto = "<a href='#'>&laquo;</a>";
  for ($i=1; $i<$actual; $i++)
    $texto .= "<a href=\"$enlace$i\">$i</a> ";
  $texto   .= "<b>$actual</b>";
  for ($i=$actual+1; $i<=$total_paginas; $i++)
    $texto .= "<a href=\"$enlace$i\">$i</a> ";
  if ($actual<$total_paginas)
    $texto .= "<a href=\"$enlace$posterior\">&raquo;</a>";
  else
    $texto .= "<a href='#'>&raquo;</a>";
  return $texto;
}

function paginar_catalogo($actual, $total, $por_pagina, $enlace) {
  $total_paginas = ceil($total/$por_pagina);
  $anterior = $actual - 1;
  $posterior = $actual + 1;
  	$texto = " " ;
	
	if ($actual>1)  
   $texto .= '<a  class="scroll_left" href="'.$enlace.$anterior.'"><img src="aplication/webroot/imgs/left.jpg"  alt="" /></a>';
  else
   $texto .= '<a class="scroll_left" href="#"><img src="aplication/webroot/imgs/left.jpg"  alt="" /></a>';
		$texto .= " ";
  for ($i=1; $i<$actual; $i++)
    $texto .= " <a href=\"$enlace$i\">$i</a>  ";
  	$texto .= "<a id='active_paginado'>$actual</a> ";
 for ($i=$actual+1; $i<=$total_paginas; $i++)
    $texto .= " <a href=\"$enlace$i\">$i</a> ";
	$texto .= " ";
  if ($actual<$total_paginas)
    $texto .= '<a class="scroll_righ" href="'.$enlace.$posterior.'"><img src="aplication/webroot/imgs/right.jpg" alt="" /></a>';
  else
    $texto .= '<a class="scroll_righ" href="#"><img src="aplication/webroot/imgs/right.jpg" alt="" /></a>';
	
  return $texto;
}

function comillas_inteligentes($valor){
    // Retirar las barras
    if (get_magic_quotes_gpc()) {
        $valor = stripslashes($valor);
    }

    // Colocar comillas si no es entero
    if (!is_numeric($valor)) {
        $valor = "'" . mysql_real_escape_string($valor) . "'";
    }
	
	//utilizar con sprintf($consulta)
    return $valor;
}


function formato_date($comodin,$fecha){
	$nfecha=explode($comodin,$fecha);
	$dia=$nfecha[0];
	$mes=$nfecha[1];
	$a�o=$nfecha[2];
	$ufecha=$a�o."-".$mes."-".$dia;
	return $ufecha;
}
function formato_slash($comodin,$fecha){
	$nfecha=explode($comodin,$fecha);
	$dia=$nfecha[2];
	$mes=$nfecha[1];
	$a�o=$nfecha[0];
	$ufecha=$dia."/".$mes."/".$a�o;
	return $ufecha;
}

function send($text) {
    header("Content-type: text/html; charset=utf-8");
    echo utf8_encode($text);
}

function passcont($psw){
	$txt=strlen($psw);
	$txt1=substr($psw,0,3);
	$txt2=substr($psw,3,3);

}

function impSelect($tabla,$extra,$idd){
	
	if($tabla == "provincias"){		
		$cat = "departamento";
	}else if($tabla == "distritos"){		
		$cat = "provincia";
	}	
	
	$where=" WHERE id_$cat = '".$idd."' ";
		
	$sql="SELECT * FROM ".$tabla." ".$where ;	
	$query = mysql_query($sql); 
	
	$retur = "";
	$retur.= '<select name = "'.$tabla.'" '.$extra.'   >
		<option value="">Seleccionar... </option>';
		while($row = mysql_fetch_array($query)){
			$retur .= " <option value='".$row[0]."' > ".$row[2]." ";
		} 
		//$retur.= $nuevo_valor; 
	$retur .= "</select>";
	// echo  $retur;
	echo $retur ;
}

function passencode($password){	
	$newpass = ( md5($password) . '&' . strrev(strlen($password))  );
	return $newpass;	 
}

function passdecode($password ){
	$newpass = strrev($password);
	$newpass = explode('&', $newpass);
	$newpass = $newpass[0];	
	return $newpass;
}

function encriptar($valor){
	$cad=strlen($valor);
	$subcad=ceil($cad/2);
	$prev_valor=substr(strrev($valor),0,$subcad);
	$next_valor=substr(strrev($valor),$subcad,$cad);
	$pcad=$cad*647667904564;	
	$pass=$pcad.'|'.$prev_valor.'$'.$subcad.'|'.$next_valor.'$w3809245n0t9';	
	return str_replace("'","?",$pass);		
}

function desencriptar($valor){
	$cad=strlen($valor);
	$subcad=ceil($cad/2);
	$new_valor=explode("|",$valor);
	
	$pvalor=explode("$",$new_valor[1]);
	$prev_valor=$pvalor[0];
	
	$nvalor=explode("$",$new_valor[2]);
	$next_valor=$nvalor[0];
	
	$pass=strrev($prev_valor.$next_valor);
	return str_replace('?',"'",$pass);		
}
function in_multi_array($needle, $haystack)
{
    $in_multi_array = false;
    if(in_array($needle, $haystack))
    {
        $in_multi_array = true;
    }
    else
    {   
        for($i = 0; $i < sizeof($haystack); $i++)
        {
            if(is_array($haystack[$i]))
            {
                if(in_multi_array($needle, $haystack[$i]))
                {
                    $in_multi_array = true;
                    break;
                }
            }
        }
    }
    return $in_multi_array;
} 

function encode_json($array){
	$array_claves = array_keys($array);
	$filas = count($array, COUNT_RECURSIVE);
	$filas_array = count($array);
	if($filas == 0 or $filas == "")
		return false;
	else{
		if($filas>$filas_array){
			$coma = "";
			for($j=0; $j<$filas_array; $j++){
				$array_claves = array_keys($array[$j]);
				$filas = count($array[$j]);
				$array_array = $array[$j];
				$vector = $vector . $coma .recuperar_array($array_claves,$filas,$array_array);
				$coma=", ";
			}
			$vector = '['.$vector.']';
			return $vector;
		}
		else
		{
		$vector = recuperar_array($array_claves,$filas,$array);
		}			
	}
}

function recuperar_array($array_claves,$filas,$array){
	for($i=0; $i<$filas; $i++){
		$coma=", ";
		if(($i+1)==$filas)
		$coma="";
		$vector= $vector . '"' . $array_claves[$i] . '":"' . eregi_replace("[\n|\r|\n\r]", ' ', utf8_encode($array[$array_claves[$i]])). '"' . $coma;
	}
	$vector="{".$vector."}";
	return $vector;
}
function Month($fecha){
	$nfecha = explode("-",$fecha);
	$dia = $nfecha[2];
	$mes = $nfecha[1];
	$ano = $nfecha[0];
	$meses = array('01' => 'Enero','02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril', '05' => 'Mayo', '06' => 'Junio', '07' => 'Julio', '08' => 'Agosto', '09' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre');
	return  $meses[$mes]." ".$ano; 
}
function fecha_long($fecha){
	$nfecha = explode("-",$fecha);
	$dia = $nfecha[2];
	$mes = $nfecha[1];
	$ano = $nfecha[0];
	$meses = array('01' => 'Enero','02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril', '05' => 'Mayo', '06' => 'Junio', '07' => 'Julio', '08' => 'Agosto', '09' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre');
	return  $dia." de ".$meses[$mes]." del ".$ano; 
}
function ext($archivo) {
	$trozos = explode("." , $archivo);
	$ext = $trozos[ count($trozos) - 1];
	return (string) $ext;
}

function formatVideo($video, $w, $h){
	$nvideo = str_replace('width="640" height="385"','width="'.$w.'" height="'.$h.'"',$video);
	$nvideo = str_replace('width="560" height="340"','width="'.$w.'" height="'.$h.'"',$nvideo);
	$nvideo = str_replace('width="480" height="385"','width="'.$w.'" height="'.$h.'"',$nvideo);
	$nvideo = str_replace('allowfullscreen="true"','allowfullscreen="true" wmode="transparent"',$nvideo);
	return $nvideo;
}

function puntuacion($user=0){
	$obj   = new ClienteAdmin($user);	
	$array = $obj->__get("_puntos"); 
	
	$votes = ($array[0]['voto']);
	$sum   = ($array[0]['punto']);
	if($votes > 0){
		$avg = ($sum / $votes);
	}else{
		$avg = 0;
	}
	$form = '<form class="puntaje" action="" method="post">
				<input type="radio" name="rate" value="0.5" ';$form .= ($avg  >= 0.5 && $avg  < 1) ? "checked='checked'" : "";$form .=' disabled="disabled"" />
				<input type="radio" name="rate" value="1" ';$form .= ($avg  >= 1 && $avg  < 1.5) ? "checked='checked'" : "";$form .=' disabled="disabled"" />
				<input type="radio" name="rate" value="1.5" ';$form .= ($avg  >= 1.5 && $avg  < 2) ? "checked='checked'" : "";$form .=' disabled="disabled"" />
				<input type="radio" name="rate" value="2" ';$form .= ($avg  >= 2 && $avg  < 2.5) ? "checked='checked'" : "";$form .=' disabled="disabled"" />
				<input type="radio" name="rate" value="2.5" ';$form .= ($avg  >= 2.5 && $avg  < 3) ? "checked='checked'" : "";$form .=' disabled="disabled"" />
				<input type="radio" name="rate" value="3" ';$form .= ($avg  >= 3 && $avg  < 3.5) ? "checked='checked'" : "";$form .=' disabled="disabled"" />
				<input type="radio" name="rate" value="3.5" ';$form .= ($avg  >= 3.5 && $avg  < 4) ? "checked='checked'" : "";$form .=' disabled="disabled"" />
				<input type="radio" name="rate" value="4" ';$form .= ($avg  >= 4 && $avg  < 4.5) ? "checked='checked'" : "";$form .=' disabled="disabled"" />
				<input type="radio" name="rate" value="4.5" ';$form .= ($avg  >= 4.5 && $avg  < 5) ? "checked='checked'" : "";$form .=' disabled="disabled"" />
				<input type="radio" name="rate" value="5" ';$form .= ($avg  == 5) ? "checked='checked'" : "";$form .=' disabled="disabled"" />&nbsp;<font color="#FF6410">'.$avg." / 5</font>
			</form> ";
			
	return $form;
}

function puntuacionS($user=0){
	$obj   = new ClienteAdmin($user);	
	$array = $obj->__get("_puntos"); 
	
	$votes = ($array[0]['voto']);
	$sum   = ($array[0]['punto']);
	if($votes > 0){
		$avg = ($sum / $votes);
	}else{
		$avg = 0;
	}
	$form = '<form class="puntaje" action="" method="post">
				<input type="radio" name="rate" value="0.5" ';$form .= ($avg  >= 0.5 && $avg  < 1) ? "checked='checked'" : "";$form .=' disabled="disabled"" />
				<input type="radio" name="rate" value="1" ';$form .= ($avg  >= 1 && $avg  < 1.5) ? "checked='checked'" : "";$form .=' disabled="disabled"" />
				<input type="radio" name="rate" value="1.5" ';$form .= ($avg  >= 1.5 && $avg  < 2) ? "checked='checked'" : "";$form .=' disabled="disabled"" />
				<input type="radio" name="rate" value="2" ';$form .= ($avg  >= 2 && $avg  < 2.5) ? "checked='checked'" : "";$form .=' disabled="disabled"" />
				<input type="radio" name="rate" value="2.5" ';$form .= ($avg  >= 2.5 && $avg  < 3) ? "checked='checked'" : "";$form .=' disabled="disabled"" />
				<input type="radio" name="rate" value="3" ';$form .= ($avg  >= 3 && $avg  < 3.5) ? "checked='checked'" : "";$form .=' disabled="disabled"" />
				<input type="radio" name="rate" value="3.5" ';$form .= ($avg  >= 3.5 && $avg  < 4) ? "checked='checked'" : "";$form .=' disabled="disabled"" />
				<input type="radio" name="rate" value="4" ';$form .= ($avg  >= 4 && $avg  < 4.5) ? "checked='checked'" : "";$form .=' disabled="disabled"" />
				<input type="radio" name="rate" value="4.5" ';$form .= ($avg  >= 4.5 && $avg  < 5) ? "checked='checked'" : "";$form .=' disabled="disabled"" />
				<input type="radio" name="rate" value="5" ';$form .= ($avg  == 5) ? "checked='checked'" : "";$form .=' disabled="disabled"" />&nbsp;<font color="#99d92a">'.$avg." / 5</font>
			</form> ";
			
	return $form;
}

function validateUser($id){
	$objca  = new ClienteAdmin($id);
	$plan = $objca->__get("_planes");
	
	if($plan[0]['estado'] == 0){
		return FALSE;
	}else{
		return TRUE;
	}
}

function aumentarMonth($desde, $cant){
	$fecha = $desde;
	return date("Y-m-d", strtotime("$fecha +".$cant." month"));  
}

function updateEstatus(){
	$query = new Consulta("SELECT * FROM clientes_planes WHERE fecha_finaliza < '".date("Y-m-d")."'");
	while($row = $query->VerRegistro()){
		$queryU = new Consulta("UPDATE clientes_planes SET estado = '0' 
										WHERE id_cliente_plan = '".$row['id_cliente_plan']."'");
	}
}

function PHP_mail_html($content, $asunto, $email){
	
$html='
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        	<style type="text/css">
				body{ color:#555; margin:0; padding:0; font:normal 11px Verdana, Geneva, sans-serif; width:100%}
            	h3{ font:bold 13px Arial, Helvetica, sans-serif; color:#000000}
            	.emails{ margin-top:30px}
				.contenido{ padding:10px 0 50px 20px}
				p{ font:normal 11px Verdana, Geneva, sans-serif}
				div{ font:normal 11px Verdana, Geneva, sans-serif}
				.firma{ padding-top:20px ; color:#666}
				a{ color:#03C;}
				a:hover{ color:#009}
            </style>
        </head>
        <body bgcolor="#DADAD8">
        	<table width="100%" cellpadding="0" cellspacing="0" style="background:#DADAD8">
				<tr>
					<td>
						<table width="600" align="center" cellpadding="0" cellspacing="0" style="padding:30px 0" class="emails">
							<tr>
								<td background="http://www.develoweb.pe/truequeando/aplication/webroot/imgs/top_email.jpg" height="111">&nbsp;</td>
							</tr>
							<tr>
								<td style="border:1px solid #7A7A79; border-top:none; border-bottom:none" height="auto" bgcolor="#FFFFFF" valign="top">
									<table>
										<tr>
											<td>
												<div class="contenido">
													<h3>'.$asunto.'</h3>
													'.$content.'
													
													<div class="firma">
														Atte<br />
														Truequeando
													</div>
													
												   <p><a href=""> http://www.truequeando.com/	</a></p>
												</div>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td background="http://www.develoweb.pe/truequeando/aplication/webroot/imgs/bottom_email.jpg" height="46">&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
        </body>
    </html>
    ';
	
	$cabeceras  = "MIME-Version: 1.0\r\n";
	$cabeceras .= "Content-type: text/html; charset=utf-8\r\n";

	$cabeceras .= 'From: Web Truequeando <webmaster@truequeando.com>' . "\r\n";
	mail($email, $asunto, $html, $cabeceras);
}

function getUrlActual(){
	$numero  = count($_GET);
	$tags 	 = array_keys($_GET);
	$valores = array_values($_GET);
	
	for($i=0;$i<$numero;$i++){
			$cad .=$tags[$i]."=".$valores[$i]."&";
	}
	$url = ($cad == '') ? basename($_SERVER['PHP_SELF']) : basename($_SERVER['PHP_SELF']).'?'.substr($cad,0,strlen($cad)-1);
	return $url;
}

?>