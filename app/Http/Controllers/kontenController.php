<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konten; 

class KontenController extends Controller
{
public function landing()
{
$konten = konten::all();
return view('landing', compact('konten'));
}

public function detil($id)
{
$datakonten = konten::findOrFail($id);
return view('detil', compact('datakonten'));
}
}
