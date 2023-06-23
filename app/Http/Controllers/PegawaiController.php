<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index(){
        return view('pegawai.index', [
            "title" => "Meditech | Daftar Pegawai",
            "pegawai" => User::paginate(10)
        ]);
    }

    public function create(){
        return view('pegawai.createpegawai', [
            "title" => "Meditech | Pegawai Baru"
        ]);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            "name" => 'required|max:255',
            "email" => 'required|unique:users',
            "username" => 'required|unique:users',
            "gambar" => 'image|file|max:10240',
            "gender" => 'required',
            "notelp" => 'required'
        ]);
        $validatedData["password"] = bcrypt('123456');

        if($request->file('gambar')){
            $validatedData['gambar'] = $request->file('gambar')->store('profile');
        }

        $user = User::create($validatedData);
        return back()->with('success', "Pegawai $user->name berhasil ditambahkan");
    }
}
