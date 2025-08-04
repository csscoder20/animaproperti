<?php

namespace App\Http\Controllers;

use App\Models\TentangKami;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Tentang Kami';
        $data = TentangKami::getAllAsArray();

        return view('frontend.pages.about-us', compact('title', 'data'));
    }
}
