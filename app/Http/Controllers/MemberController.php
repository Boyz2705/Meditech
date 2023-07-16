<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\User;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        return view('member.index', [
            "title" => "Meditech | Daftar Member",
            "member" => Member::paginate(10)
        ]);
    }

    public function create(){
        return view('member.createmember', [
            "title" => "Meditech | Member Baru",
            "pegawai" => User::where('roleid', 0)->get()
        ]);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            "name" => 'required|max:255',
            "email" => 'required|unique:members',
            "gambar" => 'image|file|max:10240',
            "alamat" => 'required|max:255',
            "gender" => 'required',
            "notelp" => 'required|numeric|unique:members|unique:users'
        ]);
        $validatedData["id_user"] = $request->id_user;

        if($request->file('gambar')){
            $validatedData['gambar'] = $request->file('gambar')->store('profile');
        }

        $member = Member::create($validatedData);
        return back()->with('success', "Pasien $member->name berhasil ditambahkan menjadi member");
    }
}
