<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class EntrepriseController extends Controller
{
    /**
     * Display a register page.
     *
     * @return \Illuminate\Http\Response
     */
    public function inscription()
    {
        return Inertia::render('Entreprises/Inscription');
    }

    /**
     * Display a login page.
     *
     * @return \Illuminate\Http\Response
     */
    public function connexion()
    {
        return Inertia::render('Entreprises/Connexion');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $entreprises = User::where('role', 'entreprise')->get();

            return Inertia::render('Entreprises/Index', [
                'entreprises' => $entreprises
            ]);
        } catch (\Exception $th) {
            //throw $th;
        }
    }


    public function affectationEntreprise(Request $request)
    {
        try {

            // Étape 1 : Récupérer toutes les applications disponibles
            $applications = Application::all();

            // Étape 2 : Utiliser Eloquent pour récupérer l'utilisateur avec les applications qui lui ont été attribuées
            $utilisateurAvecApplications = User::with('applications')->find($request->user_id);

            // Étape 3 : Vérifier si l'utilisateur existe
            if (!$utilisateurAvecApplications) {
                // Si l'utilisateur n'existe pas, renvoyer une réponse 404
                return abort(404); // Ou renvoyer une réponse appropriée
            }
            // dd( $applications, $utilisateurAvecApplications );
            // Étape 4 : Rendre la vue en utilisant Inertia.js
            return Inertia::render('Entreprises/Affectation', [
                'applications' => $applications,
                'utilisateurAvecApplications' => $utilisateurAvecApplications
            ]);
        } catch (\Exception $th) {
            // Gérer les exceptions ici (par exemple, en les journalisant)
            // Vous pouvez décommenter throw $th; si vous souhaitez propager l'exception
        }
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

            // dd($request);
            if ($request->nom == !null && $request->prenom == !null && $request->enseigne == !null && $request->email == !null && $request->username == !null && $request->pays == !null && $request->prefixe == !null && $request->telephone == !null && $request->nombre_utilisateurs_requis == !null) {

                if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                    # code...

                    // Vérifiez si une entreprise avec la même adresse e-mail existe déjà
                    $existingUser = User::where('email', $request->email)->first();
                    // dd($existingUser);
                    if ($existingUser) {
                        // Redirigez vers la page de connexion avec un message d'erreur
                        return response()->json([
                            'successMessage' => '',
                            'errorMessage' => 'Vous avez déjà un compte entreprise existant avec le même email.'
                        ]);
                    } else {



                        // Validez les données du formulaire
                        $validatedData = $request->validate([
                            'nom' => 'required',
                            'prenom' => 'required',
                            'enseigne' => 'required',
                            'email' => 'required|email|unique:users,email',
                            'username' => 'required|unique:users',
                            'pays' => 'required',
                            'prefixe' => 'required',
                            'telephone' => 'required',
                            'nombre_utilisateurs_requis' => 'required',
                        ]);

                        $password = Str::random(12); // Génère une chaîne aléatoire de 12 caractères

                        // Ajoutez des lettres majuscules, minuscules et chiffres à la chaîne générée aléatoirement
                        $password = Str::random(4) . strtoupper(Str::random(4)) . strtolower(Str::random(4));

                        // Crypte le mot de passe avec bcrypt
                        $hashedPassword = bcrypt($password);

                        $datas = [
                            'name' => $validatedData['nom'] . ' ' . $validatedData['prenom'],
                            'email' => $validatedData['email'],
                            'username' => $validatedData['username'],
                            'password' => $hashedPassword, // Hasher le mot de passe
                            'enseigne' => $validatedData['enseigne'],
                            'pays' => $validatedData['pays'],
                            'prefixe' => $validatedData['prefixe'],
                            'telephone' => $validatedData['telephone'],
                            'role' => 'entreprise',
                            'nombre_utilisateurs_requis' => $validatedData['nombre_utilisateurs_requis'],
                        ];
                        // Créez une nouvelle instance d'entreprise et enregistrez-la en base de données
                        User::create($datas);


                        // Envoi d'un e-mail avec le mot de passe à l'utilisateur
                        Mail::send('emails.welcome', $datas, function ($message) use ($datas) {
                            $message->to($datas['email'], $datas['name'])
                                ->subject("Cher". $datas['name'] . "Votre compte a été créé avec succès. Voici votre mot de passe : Mot de passe :". $datas['password']. " Vous pouvez maintenant vous connecter à votre compte avec votre adresse e-mail (". $datas['email'].") et le mot de passe ci-dessus.  Merci de nous avoir rejoint !");
                        });

                        // Réponse réussie
                        return response()->json([
                            'successMessage' => 'Entreprise ajoutée avec succès',
                            'errorMessage' => ''
                        ]);
                    }
                } else {
                    return response()->json([
                        'successMessage' => '',
                        'errorMessage' => 'Adresse email non valide'
                    ]);
                }
            } else {
                return response()->json([
                    'successMessage' => '',
                    'errorMessage' => 'Veuillez renseigner tous les champs'
                ]);
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


    // Méthode pour gérer le processus de connexion
    public function loginEntreprise(Request $request)
    {
        try {
            // dd($request);
            // Validez les données du formulaire
            $request->validate([
                'email' => 'required|email',
                'username' => 'required',
            ]);

            // Vérifiez si une entreprise avec l'email donné existe dans la base de données
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                // Si l'entreprise n'existe pas, redirigez avec un message d'erreur
                return back()->withErrors(['email' => 'Aucune entreprise correspondante trouvée.'])->withInput();
            }

            // Si l'entreprise existe, vérifiez le mot de passe
            if (password_verify($request->username, $user->username)) {
                // La connexion a réussi, connectez l'utilisateur
                Auth::login($user);

                // Redirigez l'utilisateur où vous le souhaitez
                return redirect()->route('entreprisedashboard'); // Remplacez 'tableau-de-bord' par le nom de votre route de tableau de bord.
            }

            // Si le mot de passe est incorrect, redirigez avec un message d'erreur
            return back()->withErrors(['username' => 'Mot de passe incorrect.'])->withInput();
        } catch (\Exception $th) {
            //throw $th;
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Entreprise  $user
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
