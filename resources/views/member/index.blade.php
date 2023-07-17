@extends('layouts.main')
@section('content')
    <div class="title mb-4">
        <h1 class="text-center" style="font-family:courier new; font-style: initial;">Daftar Member Meditech</h1>
    </div>
    <div class="row ">
        <div class="col-12 grid-margin">
            @if (session()->has('success'))
                <div class="row justify-content-end">
                    <div class="alert alert-success col-lg-3" role="alert">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-lg-6" style="padding-left: 30px">
                            @can('admin')
                                <h4 class="card-title">Data member</h4>
                            @else
                                <h4 class="card-title">PPJ : {{ ucwords(auth()->user()->name) }}</h4>
                            @endcan
                        </div>
                        <div class="col-lg-6 d-flex justify-content-end" style="padding-right: 30px">
                            <a class="btn btn-primary"
                                style="margin-right: 5px; border-radius: 5px; background-color: rgb(11, 136, 156); padding: 12px 27px 12px 27px"
                                href="/createmember"><span style="font-size: 20px; color:rgb(245, 230, 17)">+</span>
                                Daftarkan member baru</a>
                        </div>
                    </div>
                    <div class="row justify-content-start">
                        <div class="col-lg-6" style="padding-left: 30px">
                            <strong>Jumlah Member : {{ $member->count() }}</strong>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">

                            <thead>
                                <tr>
                                    <th>
                                        <strong>No</strong>
                                    </th>
                                    <th> Nama member</th>
                                    @can('admin')
                                        <th> PPJ </th>
                                    @endcan
                                    <th> Email </th>
                                    <th> No WhatsApp </th>
                                    <th> Gender </th>
                                    <th> Alamat </th>
                                    <th> Status </th>
                                </tr>
                            </thead>

                            <tbody>
                                @if ($member->count() == 0)
                            </tbody>
                        </table>
                        <div class="text-center mt-3">
                            <strong style="color: #6C7293; font-family:courier new">Belum ada member yang
                                terdaftar!</strong>
                        </div>
                    @else
                        @foreach ($member as $mem)
                            <tr>
                                <td>
                                    <strong>
                                        {{ $member->firstItem() + $loop->index }}
                                    </strong>
                                </td>
                                <td>
                                    <span class="pl-2">{{ $mem->name }}</span>
                                </td>
                                @can('admin')
                                    <td> {{ $mem->user->name }} </td>
                                @endcan
                                <td> {{ $mem->email }} </td>
                                <td> {{ $mem->notelp }}</td>
                                <td>
                                    @if ($mem->gender !== null)
                                        @if ($mem->gender == true)
                                            Pria
                                        @else
                                            Wanita
                                        @endif
                                    @else
                                        -
                                    @endif
                                </td>
                                <td> {{ ucwords($mem->alamat) }}</td>
                                <td>
                                    @if ($mem->status == true)
                                        Aktif
                                    @else
                                        Non Aktif
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        </table>
                        @endif
                        <br>
                        <div class="erga d-flex justify-content-center">
                            {{ $member->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
