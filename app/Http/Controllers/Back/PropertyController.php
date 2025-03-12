<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Repositories\PropertyRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function __construct(public PropertyRepository $repository)
    {
    }

    /**
     * Retourne la vue des produits pour le backoffice
     * @return View
     */
    public function index():View
    {
        $properties = $this->repository->getPaginate();

        return view('admin.properties.index', compact('properties'));
    }
}
