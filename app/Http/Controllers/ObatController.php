<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;
use App\Http\Requests\StoreObatRequest;
use App\Http\Requests\UpdateObatRequest;
use Illuminate\Support\Str;

class ObatController extends Controller
{
    public function index()
    {
        return view('obat.index', [
            "title" => "Meditech | Daftar Obat",
            "obat" => Obat::paginate(10)
        ]);
    }

    public function create(){
        return view('obat.createobat', [
            "title" => "Meditech | Tambah Obat"
        ]);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            "nama" => 'required|max:255',
            "gambar" => 'image|file|max:10240',
            "expired" => 'required'
        ]);

        if($request->file('gambar')){
            $validatedData['gambar'] = $request->file('gambar')->store('obat');
        }
        $validatedData['slug'] = Str::random(30);
        $rupiah1 = str_replace('.', '', $request->harga);
        $rupiah2 = str_replace('Rp', '', $rupiah1);
        $rupiah3 = str_replace(',00', '', $rupiah2);
        $validatedData['harga'] = $rupiah3;

        $obat = Obat::create($validatedData);
        return back()->with('success', "Obat $obat->nama berhasil ditambahkan");
    }

}
