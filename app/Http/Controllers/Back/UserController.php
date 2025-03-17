<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    /**
     * Retourne la liste des utilisateurs
     * @return View
     */
    public function index():View
    {
        $users = $this->userRepository->getAll();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Retourne la vue d'édition d'un utilisateur
     * @param User $user
     * @return View
     */
    public function edit(User $user): View
    {
        return view('admin.users.edit')->with(['user' => $user]);
    }

    /**
     * Gère la mise à jour d'un utilisateur
     * @param string $locale
     * @param Request $request
     * @param User $backuser
     * @return RedirectResponse
     */
    public function update(Request $request, User $user):RedirectResponse
    {
        try{

            $this->userRepository->update($request, $user);

            toast('user updated successfully!', 'success', 'top-right');

            return back();

        }catch (\Exception $exception){

            Log::error('error update user '. $exception->getMessage());

            toast('error update user '. $exception->getMessage(), 'error', 'top-right');

            return back();
        }
    }

    /**
     * Retourne la vue creation d'un nouvel utilisateur
     * @return View
     */
    public function create():View
    {
        return view('admin.users.create');
    }

    /**
     * Gère l'enregistrement d'un nouvel utilisateur
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        try{

            $user = $this->userRepository->store($request);

            return redirect()->route('back.user.edit', [ app()->getLocale(), 'user' => $user ]);

        }catch (\Exception $exception){
            Log::error('error store user '. $exception->getMessage());

            toast('error store user '. $exception->getMessage(), 'error', 'top-right');

            return back();
        }
    }

    /**
     * Gère la suppréssion d'un utilisateur
     * @param string $locale
     * @param User $backuser
     * @return RedirectResponse
     */
    public function destroy(User $backuser): RedirectResponse
    {
        try{
            $backuser->delete();

            toast('user deleted successfully!', 'success', 'top-right');

            return redirect()->route('back.user.index', app()->getLocale());

        }catch (\Exception $exception){
            Log::error('error delete user '. $exception->getMessage());

            toast('error delete user '. $exception->getMessage(), 'error', 'top-right');

            return back();
        }
    }
}
