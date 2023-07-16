@extends('layouts.main')
@section('css')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
    <style>
        .form-control:focus {
            color: black;
        }
        .form-control{
            color: black
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card chat-app" style="height: 600px">
                    <div id="plist" class="people-list">
                        <div class="input-group">
                            <form action="/historychat">
                                <input type="text" class="form-control" name="search" value="{{ request('search') }}" style="background-color: white;"
                                    placeholder="Search...">
                            </form>
                        </div>
                        <ul class="list-unstyled chat-list mt-2 mb-0">
                            <li class="clearfix active">
                                <img src="{{ asset('img/history.png') }}" alt="icon">
                                <div class="about">
                                    <div class="name text-dark">History Chat</div>
                                    {{-- <div class="status"> <i class="fa fa-circle offline"></i> left 10 hours ago </div> --}}
                                </div>
                            </li>
                            <hr style="border: 1px solid black;">
                            @if ($member->count())
                                @foreach ($member as $mem)
                                    <a href="/historychat/{{ $mem->id }}">
                                        <li class="clearfix">
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
                        <div class="chat-header2 clearfix">
                            <div class="row">
                                <div class="col-lg-6">
                                    <img src="{{ asset('img/meditech.png') }}" alt="avatar">
                                    <div class="chat-about text-dark">
                                        <h6 class="m-b-0">MEDITECH</h6>
                                        {{-- <small>Last seen: 2 hours ago</small> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chat-history">
                            <ul class="m-b-0" style="margin-top: 25%">
                                <div class="home text-dark row d-flex justify-content-center">
                                    <div class="col-9">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur nisi mi, eleifend
                                        tempus mauris vitae, luctus maximus tellus. Nullam volutpat.
                                    </div>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
