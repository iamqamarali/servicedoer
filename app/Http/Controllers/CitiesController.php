<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    public function __construct()
    {
        
    }

    public function index(){
        return City::all();
    }

}
