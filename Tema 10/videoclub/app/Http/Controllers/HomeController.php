<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Redirige al catálogo de películas
     */
    public function getHome()
    {

        return redirect()->route('catalog');
    }
}