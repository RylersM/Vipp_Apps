<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\ApplicationUser;
use App\Models\Formation;
use App\Models\FormationUser;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AffectationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function affectation()
    {
        try {
            $formations = Formation::all();
            $utilisateursAvecFormations = User::with('formations')->get();

            return Inertia::render('Affectations/Affectation', [
                'formations' => $formations,
                'utilisateursAvecFormations' => $utilisateursAvecFormations
            ]);
        } catch (\Exception $th) {
            //throw $th;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function affectationFormationUser(Request $request)
    {
        try {
            $formationId = $request->formation_id;
            $userId = $request->user_id;

            // Vérifier si l'affectation existe déjà
            $existingAssignment = FormationUser::where('formation_id', $formationId)
                ->where('user_id', $userId)
                ->first();

            if ($existingAssignment) {
                return response()->json([
                    'successMessage' => '',
                    'errorMessage' => 'L\'affectation existe déjà',
                ]);
            }

            // Si l'affectation n'existe pas, alors la créer
            FormationUser::create([
                'formation_id' => $formationId,
                'user_id' => $userId,
            ]);

            return response()->json([
                'successMessage' => 'Affectation réussie',
                'errorMessage' => '',
            ]);
        } catch (\Exception $th) {
            return response()->json([
                'successMessage' => '',
                'errorMessage' => 'Erreur lors de l\'affectation',
            ]);
        }
    }


    public function desaffectationFormationUser(Request $request)
    {
        try {

            $formationUser = FormationUser::where('formation_id', $request->formation_id,)->where('user_id', $request->user_id,)->first();

            if ($formationUser) {
                $formationUser->delete();
            }

            return response()->json([
                'successMessage' => 'Désaffectation réussie',
                'errorMessage' => '',
            ]);
        } catch (\Exception $th) {
            return response()->json([
                'successMessage' => '',
                'errorMessage' => 'Erreur lors de la désaffectation',
            ]);
        }
    }

    public function affectationApplicationUser(Request $request)
    {
        // Vérifier si une affectation existe déjà pour l'application et l'utilisateur spécifiés
        $existingAssignment = ApplicationUser::where([
            'application_id' => $request->application_id,
            'user_id' => $request->user_id,
        ])->first();

        if ($existingAssignment) {
            // Une affectation existe déjà, renvoyer un message de confirmation
            return response()->json([
                'successMessage' => '',
                'errorMessage' => 'Affectation déjà existante',
            ]);
        }

        // Aucune affectation existante, procéder à l'affectation
        try {
            ApplicationUser::create([
                'application_id' => $request->application_id,
                'user_id' => $request->user_id,
            ]);

            return response()->json([
                'successMessage' => 'Affectation réussie',
                'errorMessage' => '',
            ]);
        } catch (\Exception $th) {
            return response()->json([
                'successMessage' => '',
                'errorMessage' => 'Erreur lors de l\'affectation',
            ]);
        }
    }


    public function desaffectationApplicationUser(Request $request)
    {
        try {

            $applicationUser = ApplicationUser::where('application_id', $request->application_id,)->where('user_id', $request->user_id,)->first();

            if ($applicationUser) {
                $applicationUser->delete();
            }

            return response()->json([
                'successMessage' => 'Désaffectation reussie',
                'errorMessage' => '',
            ]);
        } catch (\Exception $th) {
            return response()->json([
                'successMessage' => '',
                'errorMessage' => 'Erreur lors de la désaffectation',
            ]);
        }
    }


    public function getUserFormationsDatas(Request $request)
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

            return response()->json([
                'formations' => $formations,
                'utilisateurAvecFormations' => $utilisateurAvecFormations
            ]);
        } catch (\Exception $th) {
            //throw $th;
        }
    }

    public function getUserApplicationsDatas(Request $request)
    {
        try {

            //  Récupérer toutes les applications disponibles
            $applications = Application::all();

            // Utiliser Eloquent pour récupérer l'utilisateur avec les applications qui lui ont été attribuées
            $utilisateurAvecApplications = User::with('applications')->find($request->user_id);

            // Étape 3 : Vérifier si l'utilisateur existe
            if (!$utilisateurAvecApplications) {
                // Si l'utilisateur n'existe pas, renvoyer une réponse 404
                return abort(404); // Ou renvoyer une réponse appropriée
            }

            // Rendre la vue en utilisant Inertia.js
            return response()->json([
                'applications' => $applications,
                'utilisateurAvecApplications' => $utilisateurAvecApplications
            ]);
        } catch (\Exception $th) {
            //throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
