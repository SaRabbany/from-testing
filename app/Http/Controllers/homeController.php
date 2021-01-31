<?php

namespace App\Http\Controllers;
use App\Test;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function index(){
        $data= Test::paginate(5);
        return \view('welcome', compact('data'));
    }
}
