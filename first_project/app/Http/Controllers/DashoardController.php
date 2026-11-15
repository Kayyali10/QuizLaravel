<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashoardController extends Controller
{
    public function index(){

        return view('dashboard.index');
    }
}
