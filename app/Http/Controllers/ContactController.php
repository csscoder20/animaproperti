<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use App\Models\Setting;
use App\Models\Location;
use App\Models\Property;
use App\Models\PropertyType;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function index(Request $request)
    {
        $title = 'Kontak';
        $kontak = Kontak::first();

        return view('frontend.pages.contact', compact('title', 'kontak'));
    }
}
