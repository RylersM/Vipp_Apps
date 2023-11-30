<?php

namespace App\Http\Controllers;

use App\Models\VideoFormation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class VideoFormationController extends Controller
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
    public function getvideos(Request $request)
    {
        $id = $request->id_module;
        $videos = VideoFormation::where('id_module', $id)->get();

        return response()->json([
            'videos' => $videos,
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
            $id_module = $request->module_id;
            $array = $request->newRow;

            // dd($id_module,  $array);

            foreach ($array as $value) {
                VideoFormation::create([
                    'id_module' => $request->module_id,
                    'titre' => $value["titre"],
                    'url' => $value["url"],
                    'duree' => $value["duree"],
                    'ordre' => $value["ordre"],

                ]);
            }

            return response()->json([
                'successMessage' => 'Vidéos ajouter avec succès',
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
     * @param  \App\Models\VideoFormation  $videoFormation
     * @return \Illuminate\Http\Response
     */
    public function show(VideoFormation $videoFormation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VideoFormation  $videoFormation
     * @return \Illuminate\Http\Response
     */
    public function edit(VideoFormation $videoFormation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VideoFormation  $videoFormation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VideoFormation $videoFormation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VideoFormation  $videoFormation
     * @return \Illuminate\Http\Response
     */
    public function destroy(VideoFormation $videoFormation)
    {
        //
    }
}
