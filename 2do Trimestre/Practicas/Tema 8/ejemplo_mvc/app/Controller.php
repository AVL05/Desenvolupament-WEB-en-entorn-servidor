<?php
// app/Controller.php
class Controller
{
	public function inicio()
	{
		$params = array(
			'mensaje' => 'Bienvenido a la aplicación de alimentos',
			'fecha' => date('d-m-y')
		);
		require __DIR__ . '/templates/inicio.php';
	}


	public function listar()
	{
		$m = new Model(
			Config::$mvc_bd_nombre,
			Config::$mvc_bd_usuario,
			Config::$mvc_bd_clave,
			Config::$mvc_bd_hostname
		);
		$params = array('alimentos' => $m->dameAlimentos());
		require __DIR__ . '/templates/mostrarAlimentos.php';
	}


	public function insertar()
	{
		$params = array(
			'nombre' => '',
			'energia' => '',
			'proteina' => '',
			'hc' => '',
			'fibra' => '',
			'grasa' => ''
		);
		$m = new Model(
			Config::$mvc_bd_nombre,
			Config::$mvc_bd_usuario,
			Config::$mvc_bd_clave,
			Config::$mvc_bd_hostname
		);
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			// comprobar campos formulario
			if ($m->validarDatos($_POST['nombre'], $_POST['energia'], $_POST['proteina'], $_POST['hc'], $_POST['fibra'], $_POST['grasa'])) {
				$m->insertarAlimento($_POST['nombre'], $_POST['energia'], $_POST['proteina'], $_POST['hc'], $_POST['fibra'], $_POST['grasa']);
				header('Location: index.php?ctl=listar');
			} else {
				$params = array(
					'nombre' => $_POST['nombre'],
					'energia' => $_POST['energia'],
					'proteina' => $_POST['proteina'],
					'hc' => $_POST['hc'],
					'fibra' => $_POST['fibra'],
					'grasa' => $_POST['grasa']
				);
				$params['mensaje'] = 'No se ha podido insertar el alimento. Revisa el formulario';
			}
		}
		require __DIR__ . '/templates/formInsertar.php';
	}


	public function buscarPorNombre()
	{
		$params = array(
			'nombre' => '',
			'resultado' => array()
		);
		$m = new Model(
			Config::$mvc_bd_nombre,
			Config::$mvc_bd_usuario,
			Config::$mvc_bd_clave,
			Config::$mvc_bd_hostname
		);
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$params['nombre'] = $_POST['nombre'];
			$params['resultado'] = $m->buscarAlimentosPorNombre($_POST['nombre']);
		}
		require __DIR__ . '/templates/buscarPorNombre.php';
	}


	public function ver()
	{
		if (!isset($_GET['id'])) {
			throw new Exception('Pagina no encontrada');
		}
		$id = $_GET['id'];
		$m = new Model(
			Config::$mvc_bd_nombre,
			Config::$mvc_bd_usuario,
			Config::$mvc_bd_clave,
			Config::$mvc_bd_hostname
		);
		$params = $m->dameAlimento($id);
		require __DIR__ . '/templates/verAlimento.php';
	}

	// NUEVO MÉTODO: Búsqueda por energía
	public function buscarPorEnergia()
	{
		$params = array(
			'titulo' => 'Buscar alimentos por energía',
			'resultado' => array(),
			'energia' => ''
		);

		$m = new Model(
			Config::$mvc_bd_nombre,
			Config::$mvc_bd_usuario,
			Config::$mvc_bd_clave,
			Config::$mvc_bd_hostname
		);

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$energia = $_POST['energia'] ?? '';
			$params['energia'] = $energia;

			if (!empty($energia) && is_numeric($energia)) {
				$params['resultado'] = $m->buscarAlimentosPorEnergia($energia);
			}
		}

		require __DIR__ . '/templates/buscarPorEnergia.php';
	}

	// NUEVO MÉTODO: Búsqueda combinada
	public function buscarCombinada()
	{
		$params = array(
			'titulo' => 'Búsqueda combinada (nombre y energía)',
			'resultado' => array(),
			'nombre' => '',
			'energia' => ''
		);

		$m = new Model(
			Config::$mvc_bd_nombre,
			Config::$mvc_bd_usuario,
			Config::$mvc_bd_clave,
			Config::$mvc_bd_hostname
		);

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$nombre = $_POST['nombre'] ?? '';
			$energia = $_POST['energia'] ?? '';

			$params['nombre'] = $nombre;
			$params['energia'] = $energia;

			if (!empty($nombre) || !empty($energia)) {
				$params['resultado'] = $m->buscarAlimentosCombinada($nombre, $energia);
			}
		}

		require __DIR__ . '/templates/buscarCombinada.php';
	}
}
