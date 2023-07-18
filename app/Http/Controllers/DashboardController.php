<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Member;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('dashboard.index', [
            "title" => "Dashboard Meditech",
            "pegawai" => User::where('roleid', 0)->paginate(10),
            "member" => Member::all(),

        ]);
    }
}
