<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class EmployeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pageformation()
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


            return Inertia::render('Employes/PageFormation', [
                'utilisateurAvecFormations' => $utilisateurAvecFormations
            ]);
        } catch (\Exception $th) {
            //throw $th;
        }
    }

    public function showFormation(Request $request)
    {
        try {
            // dd($request->id_formation);

            // Récupérez la formation avec ses modules et vidéos
            $formation = Formation::with('modules.videos')->find($request->id_formation);

            // dd($formation);
            // Retournez la formation et ses données associées à la vue Inertia
            return Inertia::render('Employes/ShowFormation', [
                'formation' => $formation,
            ]);
        } catch (\Exception $th) {
            //throw $th;
        }
    }

    public function affectationEmploye(Request $request)
    {
        try {
            // Récupération de toutes les formations
            $formations = Formation::all();

            // Utiliser Eloquent pour récupérer l'utilisateur avec ses formations
            $utilisateurAvecFormations = User::with('formations')->find($request->user_id);


            // Vérifier si l'utilisateur existe
            if (!$utilisateurAvecFormations) {
                // Gérer le cas où l'utilisateur n'existe pas
                return abort(404); // Ou renvoyer une réponse appropriée
            }

       

            return Inertia::render('Employes/Affectation', [
                'formations' => $formations,
                'utilisateurAvecFormations' => $utilisateurAvecFormations
            ]);
        } catch (\Exception $th) {
            //throw $th;
        }
    }





    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $employes = User::where('role', 'employe')->get();

            return Inertia::render('Employes/Index', [
                'employes' => $employes
            ]);
        } catch (\Exception $th) {
            //throw $th;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createUser()
    {
        return Inertia::render('Utilisateurs/Create');
    }

    public function storeUser(Request $request)
    {

        // Récupérer les données de la requête
        $data = $request->all();

        // Vérifier si l'email est valide
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return response()->json([
                'successMessage' => '',
                'errorMessage' => 'L\'adresse email n\'est pas valide']);
        } else {
            // Vérifier si un utilisateur avec cet email existe déjà
            $existingUser = User::where('email', $data['email'])->first();
            if ($existingUser) {
                return response()->json([
                    'successMessage' => '',
                    'errorMessage' => 'Un utilisateur avec cet email existe déjà']);
            } else {
                // Vérifier si le mot de passe et le mot de passe de confirmation sont identiques
                if ($data['password'] !== $data['password_confirmation']) {
                    return response()->json([
                        'successMessage' => '',
                        'errorMessage' => 'Les mots de passe ne correspondent pas']);
                } else {
                    // Créer un nouvel utilisateur en utilisant la méthode create()
                    $user = User::create([
                        'name' => $data['name'],
                        'email' => $data['email'],
                        'password' => bcrypt($data['password']),
                        'role' => 'employe'
                    ]);

                    if (!$user) {
                        return response()->json([
                            'successMessage' => '',
                            'errorMessage' => 'Erreur lors de la création de l\'utilisateur'
                        ]);
                    }

                    return response()->json([
                        'successMessage' => 'Utilisateur enregistré avec succès',
                        'errorMessage' => ''
                    ], 200);
                }
            }
        }
    }


    // Vous pouvez également ajouter d'autres actions, telles que l'envoi d'un e-mail de bienvenue, la connexion automatique, etc.

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
