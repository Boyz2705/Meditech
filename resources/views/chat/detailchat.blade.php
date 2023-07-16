@extends('layouts.main')
@section('css')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
    <style>
        .form-control:focus {
            color: black;
        }

        .form-control {
            color: black
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row clearfix">
            <div class="col-lg-12">
                @if ($chat->count() > 3)
                    <div class="card chat-app" style="height: max-content">
                        <div id="plist" class="people-list" style="height: 100%; background-color: #81A3BC;">
                @else
                    <div class="card chat-app" style="height: 600px">
                        <div id="plist" class="people-list" style="height: 600px; background-color: #81A3BC;">
                @endif
                        <form action="/historychat/{{ $uwong->id }}">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" value="{{ request('search') }}"
                                    style="background-color: white;" placeholder="Search...">
                                <div class="input-group-prepend" style="background-color: grey">
                                    <button class="input-group-text"><i class="fa fa-search text-dark"></i></button>
                                </div>
                            </div>
                        </form>
                        <ul class="list-unstyled chat-list mt-2 mb-0">
                            <a href="/historychat">
                                <li class="clearfix">
                                    <img src="{{ asset('img/history.png') }}" alt="icon">
                                    <div class="about">
                                        <div class="name text-dark">History Chat</div>
                                        {{-- <div class="status"> <i class="fa fa-circle offline"></i> left 10 hours ago </div> --}}
                                    </div>
                                </li>
                            </a>
                            <hr style="border: 1px solid black;">
                            @if ($member->count())
                                @foreach ($member as $mem)
                                    <a href="/historychat/{{ $mem->id }}">
                                        @if ($mem->id == $uwong->id)
                                            <li class="clearfix active">
                                        @else
                                            <li class="clearfix">
                                        @endif
                                            @if ($mem->gambar)
                                                <img src="{{ asset('storage/' . $mem->gambar) }}" alt="{{ $mem->name }}">
                                            @else
                                                <img src="https://cdn-icons-png.flaticon.com/512/21/21104.png"
                                                    alt="{{ $mem->name }}">
                                            @endif
                                            <div class="about">
                                                <div class="name text-dark">{{ ucwords($mem->name) }}</div>
                                                {{-- <div class="status"> <i class="fa fa-circle offline"></i> left 10 hours ago </div> --}}
                                            </div>
                                        </li>
                                    </a>
                                    <hr style="border: 1px solid black;">
                                @endforeach
                            @else
                                <li class="clearfix">
                                    <div class="about">
                                        <div class="name text-dark">Member tidak ditemukan</div>
                                    </div>
                                </li>
                                <hr style="border: 1px solid black;">
                            @endif
                        </ul>
                    </div>
                    <div class="chat">
                        <div class="chat-header clearfix" style="background-color: #81A3BC;">
                            <div class="row">
                                <div class="col-lg-6">
                                    @if ($uwong->gambar)
                                        <img src="{{ asset('storage/' . $uwong->gambar) }}" alt="{{ $uwong->name }}">
                                    @else
                                        <img src="https://cdn-icons-png.flaticon.com/512/21/21104.png"
                                            alt="{{ $uwong->name }}">
                                    @endif
                                    <div class="chat-about text-dark">
                                        <h6 class="m-b-0">{{ ucwords($uwong->name) }}</h6>
                                        {{-- <small>Last seen: 2 hours ago</small> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chat-history">
                            <ul class="m-b-0">
                                @if ($chat->count())
                                    @foreach ($chat as $ch)
                                        @if ($ch->id_pengirim == auth()->user()->id)
                                            <li class="clearfix">
                                                <div class="message-data text-right">
                                                    <span class="message-data-time">{{ \Carbon\Carbon::parse($ch->created_at)->translatedFormat('H:i, l') }}</span>
                                                    @if (auth()->user()->gender === 1)
                                                        <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar">
                                                    @else
                                                        <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="avatar">
                                                    @endif
                                                </div>
                                                <div class="message other-message float-right"> {{ $ch->pesan }} </div>
                                            </li>
                                        @else
                                            <li class="clearfix">
                                                <div class="message-data">
                                                    <span class="message-data-time">{{ \Carbon\Carbon::parse($ch->created_at)->translatedFormat('H:i, l') }}</span>
                                                    @if ($uwong->gambar)
                                                        <img src="{{ asset('storage/' . $uwong->gambar) }}"
                                                            alt="{{ $uwong->name }}">
                                                    @else
                                                        <img src="https://cdn-icons-png.flaticon.com/512/21/21104.png"
                                                            alt="{{ $uwong->name }}">
                                                    @endif
                                                </div>
                                                <div class="message my-message">{{ $ch->pesan }}?</div>
                                            </li>
                                        @endif
                                    @endforeach
                                @else
                                    <div class="home text-dark row d-flex justify-content-center">
                                        <div class="col-9">
                                            Belum ada pesan
                                        </div>
                                    </div>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
