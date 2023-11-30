<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Formation;
use App\Models\Module;
use App\Models\VideoFormation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Inertia\Inertia;

class ModuleController extends Controller
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
    public function getmodules(Request $request)
    {

        $id = $request->idformation;
        $modules = Module::where('id_formation', $id)->get();

        return response()->json([
            'modules' => $modules,
        ]);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            $module = Module::create([
                'id_formation' => $request->idformation,
                'titre' => $request->titre,
            ]);

            return response()->json([
                'successMessage' => 'Module créer avec succès',
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
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        try {
            $application = Application::find($request->application_id);
            $formation = Formation::find($request->formation_id);
            $module = Module::find($request->id);
            $videos = VideoFormation::where('id_module', $request->id)->get();


            return Inertia::render('VideosFormation/Show', [
                'application' => $application,
                'formation' => $formation,
                'module' => $module,
                'videos' => $videos,
                'backUrl' => $request->backUrl
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function edit(Module $module)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Module $module)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function destroy(Module $module)
    {
        //
    }
}
