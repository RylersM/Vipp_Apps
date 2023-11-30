<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Formation;
use App\Models\VideoFormation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Inertia\Inertia;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::all();

        return Inertia::render('Applications/Index', [
            'applications' => $applications,
        ]);
    }

    public function create()
    {
        return Inertia::render('Applications/Create');
    }

    // Fonction permettant de faire la generation d'un ID unique pour chaque fiche importer
    public function generate_uuid()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $characters_length = strlen($characters);
        $uuid = '';
        for ($i = 0; $i < 8; $i++) {
            $uuid .= $characters[rand(0, $characters_length - 1)];
        }
        return $uuid;
    }

    public function store(Request $request)
    {
        try {
            // Traitez et stockez les fichiers images
            $Image_name = $_FILES['captureEcran']['name'];
            $Image_path = $_FILES['captureEcran']['tmp_name'];
            $Image_size = $_FILES['captureEcran']['size'];
            $Image_error = $_FILES['captureEcran']['error'];

            $ext = ['jpg', 'jpeg', 'png', 'gif'];
            $max_size = 8000000;

            $ext_Img = pathinfo($Image_name, PATHINFO_EXTENSION);

            if (in_array($ext_Img, $ext)) {
                if ($Image_size <= $max_size) {
                    if ($Image_error == 0) {
                        $file = uniqid("image-", true);
                        $name = $file . "." . $ext_Img;
                        $location = base_path() . "/storage/app/public/images/" . $name;
                        if (move_uploaded_file($Image_path, $location)) {
                            $successMessage = "L'image a été téléchargée avec succès.";
                            $data['captureEcran'] = $name;
                        } else {
                            return response()->json([
                                'successMessage' => "",
                                'errorMessage' => "Erreur lors du téléchargement de l'image."
                            ]);
                        }
                    } else {
                        return response()->json([
                            'successMessage' => "",
                            'errorMessage' => "Erreur lors du téléchargement de l'image : code d'erreur {$Image_error}."
                        ]);
                    }
                } else {
                    return response()->json([
                        'successMessage' => "",
                        'errorMessage' => "L'image dépasse la taille maximale autorisée. 8Mo maximum."
                    ]);
                }
            } else {
                return response()->json([
                    'successMessage' => "",
                    'errorMessage' => "Format d'image non autorisé. Formats jpg, pnp, gif uniquement."
                ]);
            }

            // Traitez et stockez les fichiers vidéo
            $Video_name = $_FILES['videoDemo']['name'];
            $Video_path = $_FILES['videoDemo']['tmp_name'];
            $Video_size = $_FILES['videoDemo']['size'];
            $Video_error = $_FILES['videoDemo']['error'];

            $ext = ['mp4'];
            $max_size = 500000000;

            $ext_Vid = pathinfo($Video_name, PATHINFO_EXTENSION);

            if (in_array($ext_Vid, $ext)) {
                if ($Video_size <= $max_size) {
                    if ($Video_error == 0) {
                        $file = uniqid("video-", true);
                        $name = $file . "." . $ext_Vid;
                        $location = base_path() . "/storage/app/public/videos/" . $name;
                        if (move_uploaded_file($Video_path, $location)) {

                            $successMessage = "La vidéo a été téléchargée avec succès.";
                            $data['videoDemo'] = $name;
                        } else {
                            return response()->json([
                                'successMessage' => "",
                                'errorMessage' => "Erreur lors du téléchargement de la vidéo."
                            ]);
                        }
                    } else {
                        return response()->json([
                            'successMessage' => "",
                            'errorMessage' => "Erreur lors du téléchargement de la vidéo : code d'erreur {$Video_error}."
                        ]);
                    }
                } else {
                    return response()->json([
                        'successMessage' => "",
                        'errorMessage' => "La vidéo dépasse la taille maximale autorisée. 500Mo maximum."
                    ]);
                }
            } else {
                return response()->json([
                    'successMessage' => "",
                    'errorMessage' => "Format vidéo non autorisé. Format mp4 uniquement."
                ]);
            }

            // Génération d'un UUID
            $uuid = $this->generate_uuid();

            // Créez une nouvelle instance du modèle Application et stockez les données
            $data = [
                'uuid' => strtolower($_POST["appName"]) . '-' . $uuid,
                'nom' => $_POST["appName"],
                'description' => $_POST["appDescription"],
                'capture_ecran' => isset($data['captureEcran']) ? $data['captureEcran'] : '',
                'video_demo' => isset($data['videoDemo']) ? $data['videoDemo'] : '',
            ];



            Application::create($data);

            return response()->json([
                'successMessage' => 'Application ajouter avec succès',
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

    public function formation(Request $request)
    {
        try {


            $uuid = $request->uuid;
            $formations = [];

            // Recherche de l'application par UUID
            $application = Application::where('uuid', $uuid)->first();

            if ($application) {
                // L'application avec l'UUID donné a été trouvée
                // Maintenant, recherche de la formation associée à cette application
                $formations = Formation::where('id_application', $application->id)->first();

                // Rendu de la vue avec les données de l'application et de la formation
                return Inertia::render('Applications/ShowFormation', [
                    'application' => $application,
                    'formations' => $formations,
                    'backUrl' => $request->backUrl
                ]);
            } else {
                dd('Aucune application avec l\'UUID donné n\'a été trouvée');
                // Aucune application avec l'UUID donné n'a été trouvée
                // Vous devriez gérer ce cas en conséquence
                // Par exemple, renvoyer un message d'erreur ou rediriger l'utilisateur
            }
        } catch (\Exception $th) {
            $message = $th->getMessage();
            $messageTraduit = Lang::get($message);
            return response()->json([
                'successMessage' => '',
                'errorMessage' => $messageTraduit
            ]);
        }
    }


    public function edit(Request $request)
    {
        $application_id = $request->application_id;

        // Utilisez Eloquent pour récupérer l'application par son ID
        $application = Application::find($application_id);

        if (!$application) {
            return response()->json(['errorMessage' => 'Application non trouvé dans la base de donnée']);
        }

        return response()->json($application);
    }

    public function update(Request $request, $id)
    {
        // À compléter
    }

    public function destroy($id)
    {
        // À compléter
    }
}
