<?php
class Model
{
	protected $conexion;

	public function __construct($dbname, $dbuser, $dbpass, $dbhost)
	{
		$opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
		try {
			$this->conexion = new PDO('mysql:host=' . $dbhost . ';dbname=' . $dbname, $dbuser, $dbpass, $opc);
		} catch (PDOException $e) {
			die('No ha sido posible realizar la conexion con la base de datos: ' . $e->getMessage());
		}
	}

	private function dameAlimentosDB($sql, $params = array())
	{
		$stmt = $this->conexion->prepare($sql);
		$stmt->execute($params);

		$alimentos = array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$alimentos[] = $row;
		}

		return $alimentos;
	}

	public function dameAlimentos()
	{
		$sql = 'SELECT * FROM alimentos ORDER BY energia DESC;';
		return $this->dameAlimentosDB($sql);
	}

	public function buscarAlimentosPorNombre($nombre)
	{
		$nombre = htmlspecialchars($nombre);
		$sql = 'SELECT * FROM alimentos WHERE nombre LIKE :nombre ORDER BY energia DESC;';
		return $this->dameAlimentosDB($sql, array(':nombre' => '%' . $nombre . '%'));
	}

	public function dameAlimento($id)
	{
		$id = htmlspecialchars($id);
		$sql = 'SELECT * FROM alimentos WHERE id = :id';
		$result = $this->dameAlimentosDB($sql, array(':id' => $id));
		return $result[0] ?? array();
	}

	public function insertarAlimento($n, $e, $p, $hc, $f, $g)
	{
		$sql = 'INSERT INTO alimentos (nombre, energia, proteina, hidratocarbono, fibra, grasatotal) 
                VALUES (:nombre, :energia, :proteina, :hc, :fibra, :grasa)';

		$stmt = $this->conexion->prepare($sql);
		return $stmt->execute(array(
			':nombre' => htmlspecialchars($n),
			':energia' => htmlspecialchars($e),
			':proteina' => htmlspecialchars($p),
			':hc' => htmlspecialchars($hc),
			':fibra' => htmlspecialchars($f),
			':grasa' => htmlspecialchars($g)
		));
	}

	public function validarDatos($n, $e, $p, $hc, $f, $g)
	{
		return (is_string($n) & is_numeric($e) & is_numeric($p) & is_numeric($hc) & is_numeric($f) & is_numeric($g));
	}

	// NUEVO MÉTODO: Búsqueda por energía
	public function buscarAlimentosPorEnergia($energia)
	{
		$sql = 'SELECT * FROM alimentos WHERE energia = :energia ORDER BY nombre';
		return $this->dameAlimentosDB($sql, array(':energia' => $energia));
	}

	// NUEVO MÉTODO: Búsqueda combinada
	public function buscarAlimentosCombinada($nombre, $energia)
	{
		$sql = 'SELECT * FROM alimentos WHERE 1=1';
		$params = array();

		if (!empty($nombre)) {
			$sql .= ' AND nombre LIKE :nombre';
			$params[':nombre'] = '%' . htmlspecialchars($nombre) . '%';
		}

		if (!empty($energia) && is_numeric($energia)) {
			$sql .= ' AND energia = :energia';
			$params[':energia'] = $energia;
		}

		$sql .= ' ORDER BY nombre';

		return $this->dameAlimentosDB($sql, $params);
	}
}
