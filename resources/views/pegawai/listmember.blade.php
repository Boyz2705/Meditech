@extends('layouts.main')
@section('content')
    <div class="title mb-4">
        <h1 class="text-center" style="font-family:courier new; font-style: initial;">Daftar Member {{ ucwords($user->name) }}</h1>
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
                    <div class="row justify-content-start">
                        <div class="col-lg-6" style="padding-left: 30px">
                            <h4 class="card-title">Data member</h4>
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
                                    <th> PPJ </th>
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
                                <td> {{ $mem->user->name }} </td>
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
                                <td> {{ $mem->alamat }}</td>
                                <td>
                                    @if ($mem->status == true)
                                        Member
                                    @else
                                        Non Member
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
