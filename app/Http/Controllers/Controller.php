<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Formation;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function adminIndex()
    {
        $applications = Application::all();
        $formations = Formation::all();
        $entreprises = User::where('role', 'entreprise')->get();
        $users = User::where('role', 'employe')->get();

        return Inertia::render('Dashboard/AdminDashboard', [
            'applications' => $applications,
            'formations' => $formations,
            'entreprises' => $entreprises,
            'users' => $users,
        ]);
    }

    public function employeIndex()
    {
        try {
            $user = Auth::user();

           // Utiliser Eloquent pour récupérer l'utilisateur avec ses formations
           $utilisateurAvecFormations = User::with('formations')->find($user->id);

           // Vérifier si l'utilisateur existe
           if (!$utilisateurAvecFormations) {
               // Gérer le cas où l'utilisateur n'existe pas
               return abort(404); // Ou renvoyer une réponse appropriée
           }


            return Inertia::render('Dashboard/EmployeDashboard', [
                'utilisateurAvecFormations' => $utilisateurAvecFormations
            ]);
        } catch (\Exception $th) {
            //throw $th;
        }
    }

    public function entrepriseIndex()
    {
        try {

            $applications = Application::all();

            return Inertia::render('Dashboard/EntrepriseDashboard', [
                'applications' => $applications,
            ]);
        } catch (\Exception $th) {
            //throw $th;
        }
    }
}
