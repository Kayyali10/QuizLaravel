<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashoardController extends Controller
{
    public function index(){
        $totalUsers  = User::count();
        return view('dashboard.index' ,compact('totalUsers'));
    }
}
