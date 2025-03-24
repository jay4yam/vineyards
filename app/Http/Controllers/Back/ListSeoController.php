<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\ListeSeo;
use App\Repositories\ListeSeoRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ListSeoController extends Controller
{
    public function __construct(protected readonly ListeSeoRepository $listeSeoRepository)
    {
    }

    /**
     * Retourne la liste
     * @return View
     */
    public function index():View
    {
        $allListes = $this->listeSeoRepository->getPaginate();

        return view('admin.listeSeo.index', compact('allListes'));
    }

    /**
     * Retourne la vue de création d'une liste seo
     * @return View
     */
    public function create():View
    {
        return view('admin.listeSeo.create');
    }

    /**
     * Gère l'enregistrement d'une nouvelle liste seo
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request):RedirectResponse
    {
        try{

            $listeseo = $this->listeSeoRepository->store($request);

            toast('listeSeo created successfully!', 'success', 'top-right');

            return redirect()->route('back.listeseo.edit', ['listeseo' => $listeseo]);

        }catch (\Exception $exception){

            Log::error('error on listeseo creation : '.$exception->getMessage());

            toast('error on listeseo creation', 'error', 'top-right');

            return back()->withInput();
        }
    }

    /**
     * Gère l'édition d'une liste seo
     * @param ListeSeo $listeseo
     * @return View
     */
    public function edit(ListeSeo $listeseo):View
    {
        return view('admin.listeSeo.edit', compact('listeseo'));
    }

    /**
     * Gère la mise à jour d'une liste seo
     * @param Request $request
     * @param ListeSeo $listeseo
     * @return RedirectResponse
     */
    public function update(Request $request, ListeSeo $listeseo):RedirectResponse
    {
        try{
            $this->listeSeoRepository->update($request, $listeseo);

            toast('listeSeo updated successfully!', 'success', 'top-right');

            return redirect()->route('back.listeseo.edit', ['listeseo' => $listeseo]);

        }catch (\Exception $exception){

            Log::error('error on listeseo update '.$exception->getMessage());

            toast('error on listeseo update', 'error', 'top-right');

            return back()->withInput();
        }
    }

    public function destroy(ListeSeo $listeseo):RedirectResponse
    {
        try{
            $listeseo->delete();

            toast('listeSeo deleted successfully!', 'success', 'top-right');

            return redirect()->route('back.listeseo.index');

        }catch (\Exception $exception){
            Log::error('error on listeseo delete '.$exception->getMessage());

            toast('error on listeseo delete', 'error', 'top-right');

            return back()->withInput();
        }
    }
}
