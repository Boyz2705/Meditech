@extends('layouts.main')
@section('content')
    <div class="title mb-4">
        <h1 class="text-center" style="font-family:courier new; font-style: initial;">Daftar Pegawai Meditech</h1>
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
                            <h4 class="card-title">Data pegawai</h4>
                        </div>
                        @can('admin')
                            <div class="col-lg-6 d-flex justify-content-end" style="padding-right: 30px">
                                <a class="btn btn-primary"
                                    style="margin-right: 5px; border-radius: 5px; background-color: rgb(11, 136, 156); padding: 12px 27px 12px 27px"
                                    href="/createpegawaibaru"><span style="font-size: 20px; color:rgb(245, 230, 17)">+</span>
                                    Daftarkan pegawai baru</a>
                            </div>
                        @endcan
                    </div>
                    <div class="row justify-content-start">
                        <div class="col-lg-6" style="padding-left: 30px">
                            <strong>Jumlah Pegawai : {{ $pegawai->count() }}</strong>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">

                            <thead>
                                <tr>
                                    <th>
                                        <strong>No</strong>
                                    </th>
                                    <th> Nama pegawai</th>
                                    <th> Email </th>
                                    <th> Username </th>
                                    <th> Gender </th>
                                    <th> List Member </th>
                                    <th> Status kepegawaian </th>
                                </tr>
                            </thead>

                            <tbody>
                                @if ($pegawai->count() == 0)
                            </tbody>
                        </table>
                        <div class="text-center mt-3">
                            <strong style="color: #6C7293; font-family:courier new">Belum ada pegawai yang
                                terdaftar!</strong>
                        </div>
                    @else
                        @foreach ($pegawai as $peg)
                            <tr>
                                <td>
                                    <strong>
                                        {{ $pegawai->firstItem() + $loop->index }}
                                    </strong>
                                </td>
                                <td>
                                    <span class="pl-2">{{ $peg->name }}</span>
                                </td>
                                <td> {{ $peg->email }} </td>
                                <td> {{ $peg->username }} </td>
                                <td>
                                    @if ($peg->gender !== null)
                                        @if ($peg->gender == true)
                                            Pria
                                        @else
                                            Wanita
                                        @endif
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <a class="btn px-4 py-2" style="background-color: #0a1f9a; color: white" href="/mymember/{{ $peg->username }}">test</a>
                                </td>
                                <td>
                                    @if ($peg->status == true)
                                        <div class="badge badge-outline-success"
                                            style="padding-left: 18px; padding-right: 18px">Aktif</div>
                                    @else
                                        <div class="badge badge-outline-danger"
                                            style="padding-left: 23px; padding-right: 23px">Non Aktif</div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        </table>
                        @endif
                        <br>
                        <div class="erga d-flex justify-content-center">
                            {{ $pegawai->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
