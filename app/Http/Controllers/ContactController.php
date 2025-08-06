<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function index(Request $request)
    {
        $title = 'Kontak';

        return view('frontend.pages.contact', compact('title'));
    }
}
