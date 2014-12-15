<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>INMOBILIARIA</title>
</head>
<body>
	<?php
	require 'comunes/conectar.php';
	$con=conectar();
	$res=pg_query($con,"select *
						from propietarios 
						join inmuebles on propietarios.id=inmuebles.propietarios_id
						join extras on inmuebles.id=extras.inmuebles_id");
	/*$res=pg_query($con,"select inmuebles.numero as numero, inmuebles.caracteristicas as caracteristicas, 
								inmuebles.precio as precio, inmuebles.habitaciones as habitaciones
								inmuebles.banos as banos, inmuebles.extra as extra
						from inmuebles join propietarios on inmuebles.propietarios_id=propietarios.id");*/
	/*$res=pg_query($con,"select *
						from inmuebles, propietarios
						where inmuebles.propietarios_id=propietarios.id ");*/
	
	/*if (isset($_POST['p_max'])) {
		$p_max = (int) trim($_POST['p_max']);
		$res=pg_query($con,"select *
						from inmuebles, propietarios
						where inmuebles.propietarios_id=propietarios.id
						and inmuebles.precio< $p_max");
	}*/
	
	//venimos del submir
	if (isset($_POST['buscar'])) {
		$sentencia="select *
						from inmuebles, propietarios, extras
						where inmuebles.propietarios_id=propietarios.id 
						and inmuebles.id=extras.inmuebles_id ";
		//precio máximo
		if (isset($_POST['p_max']) && $_POST['p_max']!=0 ) {
			$p_max=(int) trim($_POST['p_max']);
			$aux="and inmuebles.precio <= $p_max ";
			$sentencia.=$aux;
		}
		//precio mínimo
		if (isset($_POST['p_min']) && $_POST['p_min']!=0 ) {
			$p_min=(int) trim($_POST['p_min']);
			$aux="and inmuebles.precio > $p_min ";
			$sentencia.=$aux;
			
		}
		//numero de habitaciones
		if (isset($_POST['nhabitaciones']) && $_POST['nhabitaciones']!=0) {
			$nhabitaciones=(int) trim($_POST['nhabitaciones']);
			$aux="and inmuebles.habitaciones >= $nhabitaciones ";
			$sentencia.=$aux;
			
		}
		//numero de baños
		if (isset($_POST['nbanos']) && $_POST['nbanos']!=0) {
			$nbanos=(int) trim($_POST['nbanos']);
			$aux="and inmuebles.banos >= $nbanos ";
			$sentencia.=$aux;
			
			
		}
		//lavavajillas
		if (isset($_POST['lavavajillas'])) {
			$lavavajillas=$_POST['lavavajillas'];
			//echo $lavavajillas;
			$aux="and extras.lavavajillas = $lavavajillas ";
			$sentencia.=$aux;
		}
		//trastero
		if (isset($_POST['trastero'])) {
			$trastero=$_POST['trastero'];
			//echo $trastero;
			$aux="and extras.trastero = $trastero ";
			$sentencia.=$aux;
		}
		//garaje
		if (isset($_POST['garaje'])) {
			$garaje=$_POST['garaje'];
			//echo $garaje;
			$aux="and extras.garaje = $garaje ";
			$sentencia.=$aux;
		}
		//ahora la sentencia está completa
		$res=pg_query($con, $sentencia);
		
	}
	if (isset($_POST['todos'])) {
		/*$res=pg_query($con,"select *
						from inmuebles, propietarios
						where inmuebles.propietarios_id=propietarios.id ");*/
		$res=pg_query($con,"select *
						from propietarios 
						join inmuebles on propietarios.id=inmuebles.propietarios_id
						join extras on inmuebles.id=extras.inmuebles_id");
		/*$fila2=pg_fetch_assoc($res);
		var_dump($fila2);*/
		/*$res=pg_query($con,'select clientes.*, usuarios.nick, roles.descripcion as rol
								from clientes 
								join usuarios on clientes.usuario_id=usuarios.id
								join roles on roles.id=usuarios.rol_id');*/
		
	}
	?>
	<table border="1">
		<thead>
			<tr>
				<td>Número</td>
				<td>Características</td>
				<td>Precio</td>
				<td>Habitaciones</td>
				<td>Baños</td>
				<td>Propietario</td>
				<td>DNI</td>
				<td>Teléfono</td>
			</tr>
		</thead>
		<tbody>
					<?php
					for ($i=0; $i < pg_num_rows($res); $i++) { 
						$fila=pg_fetch_assoc($res ,$i);
						?>
						<tr>
							<td><?= $fila['numero'] ?></td>
							<td><?= $fila['caracteristicas'] ?></td>
							<td><?= $fila['precio'] ?></td>
							<td><?= $fila['habitaciones'] ?></td>
							<td><?= $fila['banos'] ?></td>
							<td><?= $fila['nombre'] ?></td>
							<td><?= $fila['dni'] ?></td>
							<td>
								<?php
								if (isset($_POST['telefono'],$_POST['id']) && $_POST['id']==$fila['id']) {
									
										echo $fila['telefono'];
									
								}else{
									?>
									<form action="index.php" method="post">
	                           		<input type="hidden" name="id" value="<?=$fila['inmuebles_id']?>">
	                           		<input type="hidden" name="telefono" value="<?=$fila['telefono']?>">
	                            	<input type="submit" value="Estoy interesado">
	                        		</form>
	                        		<?php
								}
								?>
								
								
							</td>
							 
						</tr>
						<?php
					}
					?>
				</tbody>
	</table>
	<form action="index.php" method="post">
		<fieldset>
			<legend>Filtrar</legend>
			<label for="p_max">Precio Máximo: </label>
			<input type="number" name="p_max"><br>
			<label for="p_min">Precio Mínimo: </label>
			<input type="number" name="p_min"><br>
			<label for="nhabitaciones">Nº Mínimo de habitaciones: </label>
			<input type="number" name="nhabitaciones"><br>
			<label for="nbanos">Nº Mínimo de baños: </label>
			<input type="number" name="nbanos"><br>
			<label for="lav">Lavavajillas: </label><br>
			Si:<input type="radio" name="lavavajillas" value="true"> 
			No:<input type="radio" name="lavavajillas" value="false"><br>
			<label for="tras">Trastero: </label><br>
			Si:<input type="radio" name="trastero" value="true"> 
			No:<input type="radio" name="trastero" value="false"><br>
			<label for="gar">Garaje: </label><br>
			Si:<input type="radio" name="garaje" value="true"> 
			No:<input type="radio" name="garaje" value="false"><br>

			<input type="submit" name="buscar" value="Buscar">
		</fieldset>
	</form>
	<br>
	<form action="index.php" method="post">
		<input type="submit" name="todos" value="Ver todos">
	</form>
</body>
</html>