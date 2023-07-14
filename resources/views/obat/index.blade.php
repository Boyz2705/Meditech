@extends('layouts.main')
@section('content')
    <div class="title mb-4">
        <h1 class="text-center" style="font-family:courier new; font-style: initial;">Daftar Obat Meditech</h1>
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

            @if (session()->has('error'))
                <div class="row justify-content-end">
                    <div class="alert alert-danger col-lg-3" role="alert">
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-lg-6" style="padding-left: 30px">
                            <h4 class="card-title">Data obat</h4>
                        </div>
                        <div class="col-lg-6 d-flex justify-content-end" style="padding-right: 30px">
                            <a class="btn btn-primary"
                                style="margin-right: 5px; border-radius: 5px; background-color: rgb(11, 136, 156); padding: 12px 27px 12px 27px"
                                href="/createobat"><span style="font-size: 20px; color:rgb(245, 230, 17)">+</span>
                                Tambahkan Obat Baru</a>
                        </div>
                    </div>
                    <div class="row justify-content-start">
                        <div class="col-lg-6" style="padding-left: 30px">
                            <strong>Jumlah Obat : {{ $obat->count() }}</strong>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">

                            <thead>
                                <tr>
                                    <th>
                                        <strong>No</strong>
                                    </th>
                                    <th> Nama obat </th>
                                    <th> Harga satuan </th>
                                    <th> Expired </th>
                                    <th> Gambar </th>
                                    <th> Action </th>
                                </tr>
                            </thead>

                            <tbody>
                                @if ($obat->count() == 0)
                            </tbody>
                        </table>
                        <div class="text-center mt-3">
                            <strong style="color: #6C7293; font-family:courier new">Belum ada obat yang
                                terdaftar!</strong>
                        </div>
                    @else
                        @foreach ($obat as $ob)
                            <tr>
                                <td>
                                    <strong>
                                        {{ $obat->firstItem() + $loop->index }}
                                    </strong>
                                </td>
                                <td>
                                    <span class="pl-2">{{ $ob->nama }}</span>
                                </td>
                                <td> Rp {{ number_format($ob->harga, 2, ',','.') }} </td>
                                <td> {{ \Carbon\Carbon::parse($ob->expired)->translatedFormat('l, d F Y') }} </td>
                                <td>
                                    <button class="btn text-white" style="background-color: #6C7293; padding: 10px 15px 10px 15px" data-bs-toggle="modal"
                                    data-bs-target="#{{ $ob->id }}">Lihat Gambar</button>

                                    <div class="modal fade" id="{{ $ob->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content"
                                                style="background-color: #2A3038; color:white; border-radius: 1rem; width: 1150px;">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-1" id="exampleModalLabel">Nama Obat:
                                                        {{ ucwords($ob->nama) }}</h1>
                                                </div>
                                                <div class="modal-body">
                                                    @if ($ob->gambar)
                                                        <img class="img-fluid" src="{{ asset('storage/'.$ob->gambar) }}" style="width: 200px; height: 200px;" alt="{{ $ob->nama }}">
                                                    @else
                                                        <h4>Foto tidak tersedia pada obat ini</h4>
                                                    @endif
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal"
                                                        style="margin-right: 5px; border-radius: 5px; background-color: rgb(13, 105, 30); color: white; padding: 12px 27px 12px 27px">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-4">
                                            <a href="/updateobat/{{ $ob->slug }}" class="btn text-white" style="background-color: #0e5c29; padding: 10px 25px 10px 25px">Edit</a>
                                        </div>
                                        <div class="col-6">
                                            <form action="/deleteobat" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $ob->id }}">
                                                <input type="hidden" name="oldImage" value="{{ $ob->gambar }}">
                                                <button class="btn text-white" style="background-color: #721009; padding: 10px 22px 10px 22px">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        </table>
                    @endif
                        <br>
                        <div class="erga d-flex justify-content-center">
                            {{ $obat->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
