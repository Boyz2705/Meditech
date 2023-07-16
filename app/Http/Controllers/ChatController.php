<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function index()
    {
        return view('chat.index', [
            "title" => "Meditech | History Chat",
            "member" => Member::where('id_user', auth()->user()->id)->where('name', 'like', '%' . request('search') . '%')
                ->get()
        ]);
    }

    public function detail($id)
    {
        $member = Member::where('id', $id)->first();
        $chat = DB::table('history_chat')
            ->where(function ($query) use ($member)  {
                $query->where('id_pengirim', auth()->user()->id)
                    ->where('id_penerima', $member->id);
            })
            ->orWhere(function ($query) use ($member) {
                $query->where('id_pengirim', $member->id)
                    ->where('id_penerima', auth()->user()->id);
            })
            ->get();
        // dd($member->id);
        return view('chat.detailchat', [
            "title" => "Meditech | History Chat",
            "member" => Member::where('id_user', auth()->user()->id)->where('name', 'like', '%' . request('search') . '%')
                ->get(),
            "uwong" => $member,
            "chat" => $chat
        ]);
    }
}
