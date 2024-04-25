<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CountriesController extends Controller
{
    public function list()
    {
        return Storage::disk('local')->get('/public/countries.json');
    }
}
