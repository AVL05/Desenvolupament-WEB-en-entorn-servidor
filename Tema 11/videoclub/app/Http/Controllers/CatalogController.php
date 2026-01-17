<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatalogController extends Controller
{
    private $arrayPeliculas;

    /**
     * Constructor del controlador
     * Carga el array de películas desde el archivo
     */
    public function __construct()
    {
        // Incluir el archivo con el array de películas
        $this->arrayPeliculas = require(__DIR__ . '/array_peliculas.php');
    }

    /**
     * Muestra el listado completo del catálogo de películas
     */
    public function getIndex()
    {
        return view('catalog.index', ['arrayPeliculas' => $this->arrayPeliculas]);
    }

    /**
     * Muestra el detalle de una película
     * @param int $id - Identificador de la película
     */
    public function getShow($id)
    {
        // Verificar que existe la película
        if (!isset($this->arrayPeliculas[$id])) {
            abort(404, 'Película no encontrada');
        }

        $pelicula = $this->arrayPeliculas[$id];
        return view('catalog.show', ['pelicula' => $pelicula, 'id' => $id]);
    }

    /**
     * Muestra el formulario para crear una nueva película
     */
    public function getCreate()
    {
        return view('catalog.create');
    }

    /**
     * Muestra el formulario para editar una película existente
     * @param int $id - Identificador de la película
     */
    public function getEdit($id)
    {
        // Verificar que existe la película
        if (!isset($this->arrayPeliculas[$id])) {
            abort(404, 'Película no encontrada');
        }

        $pelicula = $this->arrayPeliculas[$id];
        return view('catalog.edit', ['pelicula' => $pelicula, 'id' => $id]);
    }
}