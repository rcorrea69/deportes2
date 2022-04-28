<?php


require_once("../conexion.php");


if (!empty($_POST['codigo'])){

//print_r ($_POST);

	$dni=$_POST["dni"];
	$codigo=$_POST["codigo"];
	//$concepto=$_POST["concepto"];
	$periodo=$_POST["periodo"];
	
	$descuento=$_POST["descuento"];

	if ($descuento==""){
		$descuento=0;
	}



	$sqlcodigo="SELECT cod.cod_precio, ca.ca_nombre,ac.ac_nombre
            FROM codigos cod
            INNER JOIN categorias ca ON cod.id_categoria =  ca.id_categoria
            INNER JOIN actividades ac ON cod.id_actividad =  ac.id_actividad
            WHERE cod.id_codigo=$codigo";

    //die($sqlcodigo);

	$res = mysqli_query($link, $sqlcodigo);
			
	$totalFilas = mysqli_num_rows($res); 

    if ($totalFilas>0 ){
    			//print_r($res);
				$resul = mysqli_query($link, $sqlcodigo);
					while ($row=mysqli_fetch_array($resul)) {

					                $importe= $row['cod_precio'];
					                $concepto= $row['ac_nombre'];
					                $categoria= $row['ca_nombre'];
					                
					                $totallinea=$importe-($importe*$descuento)/100;
					           
					    # code...
					};




		$sql="INSERT INTO `op_tmp`(`id_socio`, `tmp_codigo`, `tmp_concepto`, `tmp_periodo`, `tmp_descuento`, `tmp_importe`) VALUES ('$dni',$codigo,'$concepto',$periodo,$descuento,$totallinea)";
		
		
		$query_new_insert = mysqli_query($link,$sql);

	

  		if (!$query_new_insert) {
    		die('No se ingreso correctamente el codigo');
  		}



		
	}	

};
		mysqli_close($link);

?>