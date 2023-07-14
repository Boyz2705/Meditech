<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;
use App\Http\Requests\StoreObatRequest;
use App\Http\Requests\UpdateObatRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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

    public function delete(Request $request){
        $id = $request->id;
        $obat = Obat::where('id', $id)->first();
        $oldImage=request('oldImage');
        if($oldImage){
            Storage::delete($oldImage);
        }
        Obat::destroy($id);
        return back()->with('error', "Obat $obat->nama berhasil dihapus");
    }

    public function edit($slug){
        return view('obat.updateobat', [
            "title" => "Meditech | Edit Obat",
            "obat" => Obat::where('slug', $slug)->first()
        ]);
    }

    public function update(Request $request){
        $rules = [
            "nama" => 'required|max:255',
            "gambar" => 'image|file|max:10240',
            "expired" => 'required'
        ];

        $validatedData = $request->validate($rules);

        $rupiah1 = str_replace('.', '', $request->harga);
        $rupiah2 = str_replace('Rp', '', $rupiah1);
        $rupiah3 = str_replace(',00', '', $rupiah2);
        $validatedData['harga'] = $rupiah3;

        if($request->file('gambar')){
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $validatedData['gambar'] = $request->file('gambar')->store('obat');
        }
        Obat::where('slug', $request->slug)->update($validatedData);
        $obat = Obat::where('slug', $request->slug)->first();
        return redirect('/listobat')->with('success', "Obat $obat->nama berhasil di-update");
    }

}
