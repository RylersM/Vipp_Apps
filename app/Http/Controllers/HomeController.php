<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function about(){
        return Inertia::render('About');
    }

    public function catalogue(){
        $applications = Application::all();
        return Inertia::render('Catalogue', [
            'applications' => $applications
        ]);
    }
}
