<?php

	





		if (empty($_POST['dni'])||empty($_POST['apellido'])) {
           $errors[] = "Apellido  vacío  ";
        } else if (!empty($_POST['dni'])){
		/* Connect To Database*/


		require_once("../conexion.php");
		

	
		$dni=$_POST["dni"];
		$apellido=$_POST["apellido"];
		$nombres=$_POST["nombres"];
		$te1=$_POST["te1"];
		$tel2=$_POST["tel2"];
		$nacionalidad=$_POST["nacionalidad"];
		$mail=$_POST["mail"];
		$naci=$_POST["naci"];
		$fecha=$_POST["fecha"];
		$catego=$_POST["catego"];
		$condicion=$_POST["condicion"];
		$domicilio=$_POST["domicilio"];
		$cobertura=$_POST["cobertura"];

		$date = str_replace('/', '-', $_POST['fecha']);
		$fecha=date('Y-m-d', strtotime($date));
		$date = str_replace('/', '-', $_POST['naci']);
		$naci=date('Y-m-d', strtotime($date));
		$foto="c:\usuarios\fotos";
		
		$hoy = date("Y-m-d");

	
		$sql="UPDATE  `socios` SET `apellidos`='$apellido',`nombres`='$nombres',`fecha_nacimiento`='$naci',`nacionalidad`='nacionalidad',`telefono`='$te1',`celular`='$tel2',`domicilio`='$domicilio',`id_categoria`=$catego,`id_condicion`=$condicion,`mail`='$mail',`fecha_apto`='$fecha',`cobertura`='$cobertura',`foto`='$foto' WHERE dni='$dni' ";


			//die($sql);



		$query_new_insert = mysqli_query($link,$sql);
	
		$id=mysqli_insert_id($link);
			
			
		


			if ($query_new_insert){
				// 	if($ctacte=="SI"){
				// 		$sqlcta="INSERT INTO cta_cte_clientes (id_cta_cte,cta_cte_id_cliente) VALUES ('NULL',$id) ";
				// 		$ejecuto=mysqli_query($link,$sqlcta);	
							
				// }							
		
				$messages[] = "Socio se ha actualizado satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($link);
			}
		} else {
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

mysqli_close($link);
?>