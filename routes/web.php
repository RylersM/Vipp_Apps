<?php

use App\Http\Controllers\AffectationController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VideoFormationController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Dashboard
Route::get('/admindashboard', [Controller::class, 'adminIndex'])->name('admindashboard')->middleware(['auth', 'verified']);
Route::get('/employedashboard', [Controller::class, 'employeIndex'])->name('employedashboard')->middleware(['auth', 'verified']);
Route::get('/entreprisedashboard', [Controller::class, 'entrepriseIndex'])->name('entreprisedashboard')
    ->middleware(['auth', 'verified']);

// Les routes normales
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/catalogue', [HomeController::class, 'catalogue'])->name('catalogue');

// Applications
Route::get('/application/index', [ApplicationController::class, 'index'])->name('application.index')->middleware(['auth', 'verified']);
Route::get('/application/create', [ApplicationController::class, 'create'])->name('application.create')->middleware(['auth', 'verified']);
Route::post('/application/store', [ApplicationController::class, 'store'])->name('application.store')->middleware(['auth', 'verified']);
Route::post('/application/edit', [ApplicationController::class, 'edit'])->name('application.edit')->middleware(['auth', 'verified']);
Route::post('/application/delete', [ApplicationController::class, 'delete'])->name('application.delete')->middleware(['auth', 'verified']);
Route::get('/application/formation', [ApplicationController::class, 'formation'])->name('formation')->middleware(['auth', 'verified']);

// Formations
Route::post('/getformation', [FormationController::class, 'getformation'])->name('getformation')->middleware(['auth', 'verified']);

Route::post(
    '/formation/create',
    [FormationController::class, 'create']
)->name('formation.create')->middleware(['auth', 'verified']);

Route::get(
    '/formation/show/',
    [FormationController::class, 'show']
)->name('formation.show')->middleware(['auth', 'verified']);

Route::post(
    '/formation/store',
    [FormationController::class, 'store']
)->name('formation.store')->middleware(['auth', 'verified']);

// Modules
Route::post('/getmodules', [ModuleController::class, 'getmodules'])->name('getmodules')->middleware(['auth', 'verified']);
Route::get('/modules/show', [ModuleController::class, 'show'])->name('modules.show')->middleware(['auth', 'verified']);
Route::post('/modules/store', [ModuleController::class, 'store'])->name('modules.store')->middleware(['auth', 'verified']);

// VideosFormation
Route::post('/getvideos', [VideoFormationController::class, 'getvideos'])->name('getvideos')->middleware(['auth', 'verified']);
Route::post('/videos/store', [VideoFormationController::class, 'store'])->name('videos.store')->middleware(['auth', 'verified']);

// Employes
Route::get('/employe/pageformation', [EmployeController::class, 'pageformation'])->name('employe.pageformation')->middleware(['auth', 'verified']);
Route::get('/employe/showformation', [EmployeController::class, 'showFormation'])->name('employe.showformation')->middleware(['auth', 'verified']);
Route::post('/videos/store', [VideoFormationController::class, 'store'])->name('videos.store')->middleware(['auth', 'verified']);
Route::get('/employe/affectation/', [EmployeController::class, 'affectationEmploye'])
    ->name('employe.affectation')
    ->middleware(['auth', 'verified']);


// Entreprises
Route::get('/entreprise/inscription', [EntrepriseController::class, 'inscription'])->name('entreprise.inscription')->middleware(['auth', 'verified']);
Route::get('/entreprise/index', [EntrepriseController::class, 'index'])->name('entreprise.index');
Route::post('/entreprise/store', [EntrepriseController::class, 'store'])->name('entreprise.store')->middleware(['auth', 'verified']);
Route::get('/entreprise/affectation/', [EntrepriseController::class, 'affectationEntreprise'])
    ->name('entreprise.affectation')
    ->middleware(['auth', 'verified']);

// Affectations
Route::get('affectation', [AffectationController::class, 'affectation'])->name('affectation');

Route::post('affectationFormationUser', [AffectationController::class, 'affectationFormationUser'])->name('affectationFormationUser');

Route::post('desaffectationFormationUser', [AffectationController::class, 'desaffectationFormationUser'])->name('desaffectationFormationUser');

Route::post('getUserFormationsDatas', [AffectationController::class, 'getUserFormationsDatas'])->name('getUserFormationsDatas');

Route::post('affectationApplicationUser', [AffectationController::class, 'affectationApplicationUser'])->name('affectationApplicationUser');

Route::post('desaffectationApplicationUser', [AffectationController::class, 'desaffectationApplicationUser'])->name('desaffectationApplicationUser');

Route::post('getUserApplicationsDatas', [AffectationController::class, 'getUserApplicationsDatas'])->name('getUserApplicationsDatas');


// Utilisateurs
Route::get('/utilisateurs/index', [EmployeController::class, 'index'])->name('utilisateurs.index')->middleware(['auth', 'verified']);
Route::get('/utilisateurs/create', [EmployeController::class, 'createUser'])->name('utilisateurs.create')->middleware(['auth', 'verified']);
Route::post('/utilisateurs/store', [EmployeController::class, 'storeUser'])->name('utilisateurs.store')->middleware(['auth', 'verified']);
// Route::post('/utilisateurs/store', [utilisateursController::class, 'store'])->name('utilisateurs.store')->middleware(['auth', 'verified']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
