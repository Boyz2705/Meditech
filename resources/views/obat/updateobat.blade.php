@extends('layouts.main')
@section('content')
    <div class="title mb-4">
        <h1 class="text-center" style="font-family:courier new; font-style: initial;">Form Update Data Obat</h1>
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
                    <h4 class="card-title text-center">Update Obat Meditech</h4>
                    <form action="/updateobat" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="slug" value="{{ $obat->slug }}">
                        <input type="hidden" name="oldImage" value="{{ $obat->gambar }}">
                        <div class="form-group">
                            <label for="nama">Nama Obat</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                name="nama" placeholder="Nama Obat" required value="{{ old('nama', $obat->nama) }}">
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="currency-field">Harga Satuan Obat</label>
                            <input type="text" class="form-control @error('harga') is-invalid @enderror"
                                name="harga" id="txtExampleBoxOne" onkeypress="return number(event )"
                                onBlur="formatCurrency(this, 'Rp ', 'blur');" onkeyup="formatCurrency(this, 'Rp ');"
                                data-inputmask="'alias': 'numeric', 'autoGroup' :true, 'digitsOptional':false, 'removeMaskOnSubmit' : true, 'autoUnmask' : true"
                                placeholder="Rp 1.000.000,00" required value="{{ old('harga', $obat->harga) }}">
                            @error('harga')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="expired">Expired Obat</label>
                            <input type="date" class="form-control @error('expired') is-invalid @enderror"
                                name="expired" min="{{ date('Y-m-d') }}" id="inputdate" placeholder="dd/mm/yyyy"
                                required value="{{ old('expired', $obat->expired) }}">
                            @error('expired')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Foto Obat</label>
                            {{-- <input type="file" name="img[]" class="file-upload-default"> --}}
                            <div class="input-group col-xs-12">
                                <input type="file" name="gambar"
                                    class="form-control file-upload-info @error('gambar') is-invalid @enderror"
                                    style="background-color: #2A3038; height: 2.875rem; padding: 0.56rem 0.75rem; font-size: 0.875rem; font-weight: 400; color: #495057; border-radius: 2px"
                                    placeholder="Upload Image" value="{{ old('gambar') }}">
                            </div>
                            <small style="color: rgb(220, 65, 65)">* Abaikan bila tidak ingin menambahkan foto obat</small>
                            @error('gambar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="row mt-5">
                            <div class="col">
                                <button type="submit" class="btn btn-light"
                                    style="margin-right: 5px; border-radius: 5px; background-color: rgb(50, 45, 134); color: white; padding: 12px 27px 12px 27px">Simpan</button>
                                <input type="reset" class="btn btn-light"
                                    style="border-radius: 5px; background-color: rgb(125, 26, 19); color: white; padding: 12px 27px 12px 27px">
                            </div>
                            <div class="col d-flex justify-content-end">
                                <a href="/listobat" class="btn btn-light"
                                    style="margin-right: 5px; border-radius: 5px; background-color: rgb(196, 106, 16); color: white; padding: 12px 27px 12px 27px">Lihat Daftar Obat</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function formatNumber(n) {
            return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function formatCurrency(input, currency, blur) {
            // appends $ to value, validates decimal side
            // and puts cursor back in right position.
            // get input value
            var input_val = input.value;
            // don't validate empty input
            if (input_val === "") {
                return;
            }

            // original length
            var original_len = input_val.length;

            // initial caret position
            var caret_pos = input.selectionStart;

            // check for decimal
            if (input_val.indexOf(",") >= 0) {
                // get position of first decimal
                // this prevents multiple decimals from
                // being entered
                var decimal_pos = input_val.indexOf(",");

                // split number by decimal point
                var left_side = input_val.substring(0, decimal_pos);
                var right_side = input_val.substring(decimal_pos);

                // add commas to left side of number
                left_side = formatNumber(left_side);

                // validate right side
                right_side = formatNumber(right_side);

                // On blur make sure 2 numbers after decimal
                if (blur === "blur") {
                    right_side += "00";
                }

                // Limit decimal to only 2 digits
                right_side = right_side.substring(0, 2);

                // join number by .
                input_val = currency + left_side + "," + right_side;
            } else {
                // no decimal entered
                // add commas to number
                // remove all non-digits
                input_val = formatNumber(input_val);
                input_val = currency + input_val;

                // final formatting
                if (blur === "blur") {
                    input_val += ",00";
                }
            }

            // send updated string to input
            input.value = input_val;

            // put caret back in the right position
            var updated_len = input_val.length;
            caret_pos = updated_len - original_len + caret_pos;
            input.setSelectionRange(caret_pos, caret_pos);

            function number(evt) {
                var charCode = (evt.which) ? evt.which : event.keyCode
                if (charCode > 31 && (charCode < 48 || charCode > 57))
                    return false;
                return true;
            }
        }
    </script>
@endsection
