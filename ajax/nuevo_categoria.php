<?php

		if (empty($_POST['nombrecat'])) {
           $errors[] = "Nombre de la Actividad vacío  ";
        } else if (!empty($_POST['nombrecat'])){
		/* Connect To Database*/



		require_once("../conexion.php");
	
		$categoria=$_POST["nombrecat"];

	
		$sql="INSERT INTO categorias (ca_nombre) VALUES ('$categoria')";
		
		//die($sql);

		$query_new_insert = mysqli_query($link,$sql);
	
		// $id=mysqli_insert_id($link);
			
			
		


			if($query_new_insert){
    			$messages[] = "Categoría ha sido ingresado satisfactoriamente.";
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

?>