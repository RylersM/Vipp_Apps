<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Formation;
use App\Models\Module;
use App\Models\VideoFormation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Inertia\Inertia;

class FormationController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getformation(Request $request)
    {
        $id = $request->idapplication;
        $formations = Formation::where('id_application', $id)->get();

        return response()->json([
            'formations' => $formations,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $uuid = $request->uuid;
        // Recherche de l'application par UUID
        $application = Application::where('uuid', $uuid)->first();

        return Inertia::render('Formations/Create', [
            'application' => $application
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            $data = [
                'id_application' => $request->idapplication,
                'titre_formation' => $request->titre,
                'description_formation' => $request->description,
            ];

            $formation = Formation::create([
                'id_application' => $data['id_application'],
                'titre' => $data['titre_formation'],
                'description' => $data['description_formation'],

            ]);

            return response()->json([
                'successMessage' => 'Formation créer avec succès',
                'errorMessage' => ''
            ]);
        } catch (\Exception $th) {

            $message = $th->getMessage();
            $messageTraduit = Lang::get($message);
            return response()->json([
                'successMessage' => '',
                'errorMessage' => $messageTraduit
            ]);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Formation  $formation
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $application = Application::where('id', $request->application_id)->get();
        $modules = Module::where('id_formation', $request->id)->get();
        $formation = Formation::find($request->id);
        $backUrl = $request->backUrl;


        return Inertia::render('Formations/Show', [

            'application' => $application,
            'formation' => $formation,
            'modules' => $modules,
            'backUrl' => $backUrl
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Formation  $formation
     * @return \Illuminate\Http\Response
     */
    public function edit(Formation $formation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Formation  $formation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Formation $formation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Formation  $formation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Formation $formation)
    {
        //
    }
}
