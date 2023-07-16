@extends('layouts.main')
@section('content')
    <div class="title mb-4">
        <h1 class="text-center" style="font-family:courier new; font-style: initial;">Form Pendaftaran Pegawai Baru</h1>
    </div>
    @if (session()->has('success'))
        <div class="row justify-content-center">
            <div class="alert alert-success col-lg-5" role="alert">
                {{ session('success') }}
            </div>
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">Pegawai Baru Meditech</h4>
                    <form action="/createpegawaibaru" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" placeholder="Nama Pegawai" required value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nama">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" placeholder="Email Pegawai" required value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nama">Username</label>
                            <input type="username" class="form-control @error('username') is-invalid @enderror" id="username"
                                name="username" placeholder="Username Pegawai" required value="{{ old('username') }}">
                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nama">No Whatsapp</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text text-white">+62</span>
                                </div>
                                <input type="notelp" class="form-control @error('notelp') is-invalid @enderror" id="notelp"
                                name="notelp" placeholder="Whatsapp Member" required value="{{ old('notelp') }}">
                            </div>
                            @error('notelp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="gender">Jenis Kelamin</label>
                            <select class="form-control" style="width:100%" id="gender" name="gender">
                                <option selected="selected" disabled="disabled">Pilih Jenis Kelamin</option>
                                <option value="1">Pria</option>
                                <option value="0">Wanita</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Foto Profil</label>
                            {{-- <input type="file" name="img[]" class="file-upload-default"> --}}
                            <div class="input-group col-xs-12">
                                <input type="file" name="gambar"
                                    class="form-control file-upload-info @error('gambar') is-invalid @enderror"
                                    style="background-color: #2A3038; height: 2.875rem; padding: 0.56rem 0.75rem; font-size: 0.875rem; font-weight: 400; color: #495057; border-radius: 2px"
                                    placeholder="Upload Image" value="{{ old('gambar') }}">
                            </div>
                            <small style="color: rgb(220, 65, 65)">* Abaikan bila tidak ingin menambahkan foto profil</small>
                            @error('gambar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="row mt-5">
                            <div class="col">
                                <button type="submit" class="btn btn-light"
                                    style="margin-right: 5px; border-radius: 5px; background-color: rgb(50, 45, 134); color: white; padding: 12px 27px 12px 27px">Tambah</button>
                                <input type="reset" class="btn btn-light"
                                    style="border-radius: 5px; background-color: rgb(125, 26, 19); color: white; padding: 12px 27px 12px 27px">
                            </div>
                            <div class="col d-flex justify-content-end">
                                <a href="/listpegawai" class="btn btn-light"
                                    style="margin-right: 5px; border-radius: 5px; background-color: rgb(196, 106, 16); color: white; padding: 12px 27px 12px 27px">Lihat Daftar Pegawai</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
