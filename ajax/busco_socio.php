<?php

$dni = $_POST["dni"];


require_once "../conexion.php";

function formato_fecha_dd_mm_Y($date)
{	
	$fecha = str_replace('/', '-', $date);
    return date('d/m/Y', strtotime($date));
}


if(!empty($dni)){
        
        
$sql= "SELECT socios.dni,socios.apellidos,socios.nombres,socios.fecha_apto,categorias.ca_nombre FROM socios,categorias WHERE socios.id_categoria =categorias.id_categoria and socios.dni='$dni'";
        //$sql = "SELECT apellidos, nombres,id_categoria,dni  FROM socios WHERE dni='$dni'";
        //die($sql);

        $res = mysqli_query($link, $sql);

        if(!$res){

            die('Error de consulta'. mysqli_error($link));
        } 

        $json=array();

        while($row=mysqli_fetch_array($res)){

            $json[]=array(
                'nombre'=> $row['nombres'],
                'apellido'=> $row['apellidos'],
                'categoria'=> $row['ca_nombre'],
                'apto'=>formato_fecha_dd_mm_Y($row['fecha_apto']) ,
                'dni'=> $row['dni']    
            );
        }; 

        $jsoncadena=json_encode($json);
        echo $jsoncadena;    

}

mysqli_close($link);

?>