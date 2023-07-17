@extends('layouts.main')
@section('content')
<div class="title mb-4">
    <h1 class="text-center" style="font-family:courier new; font-style: initial;">Dashboard Meditech</h1>
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
                        <h4 class="card-title">Respon pegawai</h4>
                    </div>
                    <div id="result">
                        <!-- Hasil akan ditampilkan di sini -->
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
                                {{-- <th> Waktu respon </th> --}}
                                <th> Presentase respon </th>
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
                    @php
                        $response_times = [];
                        $max_response_time = 0;
                        $one_day_in_seconds = 86400;
                    @endphp

                    @foreach ($pegawai as $peg)
                        <tr>
                            <td><strong>{{ $pegawai->firstItem() + $loop->index }}</strong></td>
                            <td><span class="pl-2">{{ $peg->name }}</span></td>
                            <td>{{ $peg->email }}</td>
                            <td>{{ $peg->username }}</td>

                            @php
                                $chats = DB::table('history_chat')
                                    ->where('id_pengirim', $peg->id)
                                    ->orWhere('id_penerima', $peg->id)
                                    ->orderBy('created_at', 'asc')->get();
                                $response_time = 0;
                            @endphp

                            {{-- <td> --}}
                                @foreach($chats as $index => $chat)
                                @php
                                    if ($chat->id_penerima === $peg->id && $index > 0) {
                                        $previous_chat = $chats[$index - 1];
                                        $response_time += strtotime($chat->created_at) - strtotime($previous_chat->created_at);
                                    }
                                @endphp
                                @endforeach

                                @php
                                    $response_times[$peg->id] = $response_time;
                                    // Cari selisih waktu tertinggi (dalam detik)
                                    $max_response_time = max($max_response_time, $response_time);
                                @endphp

                                {{-- {{ gmdate('H:i:s', $response_time) }} --}}
                            {{-- </td> --}}

                            <td>
                                @php
                                    $percentage = ($max_response_time > 0) ? (1 - ($response_time / $one_day_in_seconds)) * 100 : 100;
                                @endphp
                                @if ($chats->count() !== 0)
                                    {{ round($percentage) }}%
                                @else
                                    0%
                                @endif
                            </td>

                            <td>
                                @if ($peg->status == true)
                                    <div class="badge badge-outline-success" style="padding-left: 18px; padding-right: 18px">Aktif</div>
                                @else
                                    <div class="badge badge-outline-danger" style="padding-left: 23px; padding-right: 23px">Non Aktif</div>
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

<div class="row">
    <div class="content-wrapper" style="padding:12px">
      {{-- <div class="page-header">
      </div> --}}
      <div class="row">
        <div class="col-lg-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">ResponTime Pegawai</h4>
              <canvas id="lineChart" style="height:250px"></canvas>
            </div>
          </div>
        </div>
        <div class="col-lg-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Keaktifan Pegawai</h4>
              <canvas id="barChart" style="height:230px"></canvas>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="../../assets/vendors/chart.js/Chart.min.js"></script>
    <script src="../../assets/js/chart.js"></script>
@endsection

