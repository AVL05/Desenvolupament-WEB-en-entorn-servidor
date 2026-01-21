<?php
	function formularioDisco(){//Esta función imprimirá en la página un formulario y llamará a la función registrar del objeto para registrar un disco nuevo
		echo '<button  onclick=location.href="./index.php">Volver</button>';
		echo '<h1>Crear nuevo disco</h1>';
		echo '<form action="disconuevo.php" method="post" enctype="multipart/form-data">';
		echo '<input type="text" required name="titulo" placeholder="Título"/>';
		echo '<input type="text" required name="discografia" placeholder="Discografía"/>';
		echo '<label>formato: </label>';
		echo '<select name="formato">
			<option> vinilo</option>
			<option> cd</option>
			<option> dvd</option>
			<option> mp3</option>
			</select>';
		echo '<label>fechaLanzamiento: </label>';
		echo '<input type="date" name="fechaLanzamiento"/>';
		echo '<label>fechaCompra: </label>';
		echo '<input type="date" name="fechaCompra"/>';
		echo '<input type="number" step="  " min=0 value=0 name="precio" placeholder="precio"/>';
		echo '<label>Portada del álbum: </label>';
		echo '<input type="file" name="portada" id="portada" accept="image/jpeg,image/png"/>';
		echo '<input type="hidden" name="MAX_FILE_SIZE" value="2000000"/>';
		echo '<input id="reg-mod" type="submit" value="Registrar"/>';
		echo '</form>';
		
		if(isset($_POST["titulo"])){
			// CAMBIAR LAS CREDENCIALES: Reemplaza 'root','' con tus credenciales reales
			// Ejemplo: Conexion('localhost','root','','discografia')
			$conectar = new Conexion('localhost','root','','discografia');
			$conexion = $conectar->conectionPDO();
			
			$rutaPortada = '';
			
			// Procesar la imagen subida
			if(isset($_FILES['portada']) && $_FILES['portada']['error'] == UPLOAD_ERR_OK){
				// Validar el tipo de archivo
				$finfo = new finfo(FILEINFO_MIME_TYPE);
				$mimeType = $finfo->file($_FILES['portada']['tmp_name']);
				
				$tiposPermitidos = array(
					'jpg' => 'image/jpeg',
					'png' => 'image/png'
				);
				
				$extension = array_search($mimeType, $tiposPermitidos, true);
				
				if($extension !== false){
					// Validar que el archivo es realmente una imagen subida
					if(is_uploaded_file($_FILES['portada']['tmp_name'])){
						// Crear directorio si no existe
						$directorioBase = 'img/portadas';
						if(!is_dir($directorioBase)){
							mkdir($directorioBase, 0777, true);
						}
						
						// Generar nombre único basado en el título del álbum
						$nombreArchivo = preg_replace('/[^A-Za-z0-9_\-]/', '_', $_POST['titulo']);
						$nombreArchivo = $nombreArchivo . '_' . time() . '.' . $extension;
						$rutaDestino = $directorioBase . '/' . $nombreArchivo;
						
						// Mover el archivo subido
						if(move_uploaded_file($_FILES['portada']['tmp_name'], $rutaDestino)){
							$rutaPortada = $rutaDestino;
						}else{
							echo '<h1 id="mal">ERROR AL SUBIR LA PORTADA!</h1>';
						}
					}else{
						echo '<h1 id="mal">ERROR: Posible ataque con archivo subido!</h1>';
					}
				}else{
					echo '<h1 id="mal">ERROR: Tipo de archivo no permitido. Solo JPG y PNG.</h1>';
				}
			}elseif(isset($_FILES['portada']) && $_FILES['portada']['error'] != UPLOAD_ERR_NO_FILE){
				// Manejo de otros errores de subida
				switch($_FILES['portada']['error']){
					case UPLOAD_ERR_INI_SIZE:
					case UPLOAD_ERR_FORM_SIZE:
						echo '<h1 id="mal">ERROR: El archivo excede el tamaño máximo permitido.</h1>';
						break;
					default:
						echo '<h1 id="mal">ERROR: Error desconocido al subir el archivo.</h1>';
				}
			}
			
			$album = new Album('',$_POST['titulo'],$_POST['discografia'],$_POST['formato'],$_POST['fechaLanzamiento'],$_POST['fechaCompra'],$_POST['precio'],$rutaPortada);

			$album->registrarDisco($conexion);
		}
	}

	function formularioCancion($cancion, $albumTitulo = ''){//Esta función imprimirá en la página un formulario y llamará a la función registrar del objeto para registrar una cancion nueva
		echo '<button  onclick=location.href="./index.php">Volver</button>';
		echo '<h1>Crear nueva canción</h1>';
		echo '<form action="cancionnueva.php?cod='.$cancion->getAlbum().'&titulo='.urlencode($albumTitulo).'" method="post">';
		echo '<input type="text" required name="titulo" placeholder="Título" />';
		echo '<label>Album: </label>';
		echo '<input type="text" required name="album" value="'.htmlspecialchars($albumTitulo).'" readonly/>';
		echo '<label>Posición: </label>';
		echo '<input type="number" min=0 name="posicion" value=0 />';
		echo '<label>Duración: </label>';
		echo '<input type="time" name="duracion" step="1"/>';
		echo '<label>Género: </label>';
		echo '<select name="genero">
			<option> Acustica</option>
			<option> BSO</option>
			<option> Blues</option>
			<option> Folk</option>
			<option> Jazz</option>
			<option> New age</option>
			<option> Pop</option>
			<option> Rock</option>
			<option> Electronica</option>
			</select>';
		echo '<input id="reg-mod" type="submit" value="Registrar"/>';
		echo '</form>';
		if(isset($_POST["titulo"])){
			$conectar = new Conexion('localhost','root','','discografia');
			$conexion = $conectar->conectionPDO();
			$cancion = new Cancion($_POST['titulo'],$cancion->getAlbum(),$_POST['posicion'],$_POST['duracion'],$_POST['genero']);
			$cancion->registrarCancion($conexion);
		}
	}

	function formularioBuscarCancion(){//Esta función imprimirá en la página un formulario y llamará a la función datosBuacados para devolver una lista de canciones
		echo '<button  onclick=location.href="./index.php">Volver</button>';
		echo '<h1>Búsqueda de canciones</h1>';
		
		// Mostrar historial de búsquedas desde cookies
		if (isset($_COOKIE['historial_busquedas'])) {
			$historial = json_decode($_COOKIE['historial_busquedas'], true);
			if (!empty($historial)) {
				echo '<div>';
				echo '<h3>Últimas búsquedas:</h3>';
				echo '<ul>';
				foreach ($historial as $busqueda) {
					echo '<li>' . htmlspecialchars($busqueda) . '</li>';
				}
				echo '</ul>';
				echo '</div>';
			}
		}
		echo '<form action="canciones.php" method="post">';
		echo 'Texto a buscar: ';
		echo '<input type="text" required name="textoBuscar"/>';
		echo '<div>';
		echo 'Buscar en: ';
		echo '<input type="radio" id=tc name="select" checked value="cancion.titulo"/>';
		echo '<label for="tc">Títulos de canción </label>';
		echo '<input type="radio" id="na" name="select" value="album.titulo"/>';
		echo '<label for="na">Nombres álbum </label>';
		echo '<input type="radio" id="ca" name="select" value="album.titulo = cancion.titulo and cancion.titulo"/>';
		echo '<label for="ca">Ambos campos </label>';
		echo '</div>';
		echo '<div>';
		echo 'Genero musical: ';
		echo '<select name="genero">
		<option> Acustica</option>
		<option> BSO</option>
		<option> Blues</option>
		<option> Folk</option>
		<option> Jazz</option>
		<option> New age</option>
		<option> Pop</option>
		<option> Rock</option>
		<option> Electronica</option>
		</select>';
		echo '</div>';
		echo '<input id="reg-mod" type="submit" value="Buscar"/>';
		echo '</form>';
		if(isset($_POST["textoBuscar"])){
			// Guardar en historial de búsquedas (cookie)
			$textoBuscar = $_POST['textoBuscar'];
			$historial = isset($_COOKIE['historial_busquedas']) ? json_decode($_COOKIE['historial_busquedas'], true) : [];
			
			// Añadir al inicio del array (más reciente primero)
			array_unshift($historial, $textoBuscar);
			
			// Mantener solo las últimas 5 búsquedas
			$historial = array_slice(array_unique($historial), 0, 5);
			
			// Guardar en cookie (30 días)
			setcookie('historial_busquedas', json_encode($historial), time() + (30 * 24 * 60 * 60), '/');
			
			datosBuscados($_POST['textoBuscar'],$_POST['select'],$_POST['genero']);
			//registrarDisco($_POST['titulo'],$_POST['discografia'],$_POST['formato'],$_POST['fechaLanzamiento'],$_POST['fechaCompra'],$_POST['precio']);
			
		}
	}

	function datosDiscografia(){//devuelve una lista de Albums
		$conectar = new Conexion('localhost','root','','discografia');
		$conexion = $conectar->conectionPDO();
		// Si la tabla usa 'id' en lugar de 'cod', cambia cod por id
		$resultado = $conexion->query('SELECT codigo,titulo,discografica,formato,fechaLanzamiento,fechaCompra,precio,portada FROM discografia.album;');
		echo'<button  onclick=location.href="./disconuevo.php">Nuevo disco</button>';
		echo'<button  onclick=location.href="./canciones.php">Buscar canciones</button>';
		echo'<table>';
		echo'<tr>
			<th>Portada</th>
			<th>título</th>
			<th>Discografía</th>
			<th>formato</th>
			<th>fechaLanzamiento</th>
			<th>fechaCompra</th>
			<th>Precio</th>			
		</tr>';
	while ($registro = $resultado->fetch()) {
			// Usar el título como identificador temporal si no existe 'cod'
			$cod = $registro['codigo'];
			$discografia = $registro['discografica'];
			$portada = isset($registro['portada']) ? $registro['portada'] : '';
			$album = new Album($cod,$registro['titulo'],$discografia,$registro['formato'],$registro['fechaLanzamiento'],$registro['fechaCompra'],$registro['precio'],$portada);
			echo '<tr>';
			// Mostrar portada si existe
			if(!empty($album->getPortada()) && file_exists($album->getPortada())){
				echo '<td><img src="'.$album->getPortada().'" alt="Portada" style="width:80px;height:80px;object-fit:cover;"/></td>';
			}else{
				echo '<td>Sin portada</td>';
			}
			echo '<td><a href="http://localhost/discografia/disco.php?cod='.urlencode($registro['titulo']).'">'.$album->getTitulo().'</a></td>';
			echo '<td>'.$album->getDiscografia().'</td>';
			echo '<td>'.$album->getFormato().'</td>';
			echo '<td>'.$album->getFechaL().'</td>';
			echo '<td>'.$album->getFechaC().'</td>';
			echo '<td>'.$album->getPrecio().'</td>';
			echo '<th id="botonInsertar" ><button  onclick=location.href="./cancionnueva.php?cod='.$cod.'&titulo='.urlencode($registro['titulo']).'">Canción Nueva</button></th>';
			echo '</tr>';
		}
		echo'</table>';
	}

	function datosDisco($album){//Devuelve los datos del album seleccionado
		$conectar = new Conexion('localhost','root','','discografia');
		$conexion = $conectar->conectionPDO();
		$tituloAlbum = $album->getTitulo();
		$resultado = $conexion->query('SELECT count(titulo) as totalCanciones FROM discografia.cancion WHERE cancion.album = \''.$tituloAlbum.'\';');
		while ($registro = $resultado->fetch()) {
			$TC = $registro['totalCanciones'];
		}
		$resultado = $conexion->query('SELECT titulo,formato,fechaLanzamiento,fechaCompra,precio,portada FROM discografia.album WHERE album.titulo = \''.$tituloAlbum.'\';');
		echo '<button  onclick=location.href="./index.php">Volver</button>';
		echo '<h1>DATOS DEL DISCO</h1>';
		
	while ($registro = $resultado->fetch()) {
			$discografia = isset($registro['discografia']) ? $registro['discografia'] : 'N/A';
			$portada = isset($registro['portada']) ? $registro['portada'] : '';
			$listaAlbum = new Album('',$registro['titulo'],$discografia,$registro['formato'],$registro['fechaLanzamiento'],$registro['fechaCompra'],$registro['precio'],$portada);
			
			// Mostrar portada grande si existe
			if(!empty($listaAlbum->getPortada()) && file_exists($listaAlbum->getPortada())){
				echo '<div style="text-align:center;margin:20px;">';
				echo '<img src="'.$listaAlbum->getPortada().'" alt="Portada del álbum" style="max-width:300px;max-height:300px;object-fit:cover;border:2px solid #ccc;"/>';
				echo '</div>';
			}
			
			echo'<table>';
			echo'<tr>
			<th>título</th>
			<th>Discografía</th>
			<th>formato</th>
			<th>fechaLanzamiento</th>
			<th>fechaCompra</th>
			<th>Precio</th>			
		</tr>';
			echo '<tr>';
			echo '<td>'.$listaAlbum->getTitulo().'</td>';
			echo '<td>'.$listaAlbum->getDiscografia().'</td>';
			echo '<td>'.$listaAlbum->getFormato().'</td>';
			echo '<td>'.$listaAlbum->getFechaL().'</td>';
			echo '<td>'.$listaAlbum->getFechaC().'</td>';
			echo '<td>'.$listaAlbum->getPrecio().'</td>';
			echo '<th id="botonBorrar" ><button  onclick=location.href="./borrardisco.php?titulo='.urlencode($listaAlbum->getTitulo()).'&TC='.$TC.'">Borrar disco</button></th>';
			echo '</tr>';
		}
		echo'</table>';

		datosCancion($album->getTitulo());
	}
	function datosCancion($tituloAlbum){//devuelve los datos de todas las canciones del album pasado
		$conectar = new Conexion('localhost','root','','discografia');
		$conexion = $conectar->conectionPDO();
		$resultado = $conexion->query('SELECT * FROM discografia.cancion WHERE album = \''.$tituloAlbum.'\';');
		echo'<h3>CANCIONES DEL DISCO</h3>';
		echo'<table>';
		echo'<tr>
			<th>título</th>
			<th>Album</th>
			<th>posicion</th>
			<th>duracion</th>
			<th>genero</th>			
		</tr>';
		while ($registro = $resultado->fetch()) {
			$listaCanciones = new Cancion($registro['titulo'],$registro['album'],$registro['posicion'],$registro['duracion'],$registro['genero']);
			echo '<tr>';
			echo '<td>'.$listaCanciones->getTitulo().'</td>';
			echo '<td>'.$listaCanciones->getAlbum().'</td>';
			echo '<td>'.$listaCanciones->getPosicion().'</td>';
			echo '<td>'.$listaCanciones->getDuracion().'</td>';
			echo '<td>'.$listaCanciones->getGenero().'</td>';
			echo '</tr>';
		}
		echo'</table>';
	}

	function datosBuscados($textoBuscar, $select, $genero){//Esta función devuelve una lista de canciones dependiendo de los datos que quiera utilizar el usuario para su busqueda
		$conectar = new Conexion('localhost','root','','discografia');
		$conexion = $conectar->conectionPDO();
		$resultado1 = $conexion->query('SELECT count(cancion.titulo) as cont FROM discografia.cancion,discografia.album WHERE album.titulo = cancion.album and cancion.genero = "'.$genero.'" and '.$select.' LIKE "%'.$textoBuscar.'%";');
		
		$contar = $resultado1->fetch();
		if($contar['cont'] > 0) {
			$resultado2 = $conexion->query('SELECT cancion.titulo as titulo ,album.titulo as album, cancion.posicion, cancion.duracion, cancion.genero   FROM discografia.cancion,discografia.album WHERE album.titulo = cancion.album and cancion.genero = "'.$genero.'" and '.$select.' LIKE "%'.$textoBuscar.'%";');
		echo'<table>';
		echo'<tr>
			<th>título</th>
			<th>Album</th>
			<th>posicion</th>
			<th>duracion</th>
			<th>genero</th>			
		</tr>';
		while ($registro = $resultado2->fetch()) {
			$Canciones = new Cancion($registro['titulo'],$registro['album'],$registro['posicion'],$registro['duracion'],$registro['genero']);
			echo '<tr>';
			echo '<td>'.$Canciones->getTitulo().'</td>';
			echo '<td>'.$Canciones->getAlbum().'</td>';
			echo '<td>'.$Canciones->getPosicion().'</td>';
			echo '<td>'.$Canciones->getDuracion().'</td>';
			echo '<td>'.$Canciones->getGenero().'</td>';
			echo '</tr>';
		}
		echo'</table>';
		}else{
			echo'<h1>NO SE ENCONTRARON RESULTADOS!</h1>';
		}
	}
?>
