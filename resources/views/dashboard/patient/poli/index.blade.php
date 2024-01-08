@extends('dashboard/master')
@section('title', 'Pasien | Daftar Poli')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Daftar Poli</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            @if ($errors->any())
                                <div class="card-header">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Whoops!</strong> Terjadi kesalahan input data yang anda
                                        masukan.<br><br>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }} </li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="close" data-dismiss="alert"
                                                aria-label="close">
                                            <span aria-hidden="true"> &times; </span>
                                        </button>
                                    </div>
                                </div>
                            @endif
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8 mx-auto">
                                        <form method="POST" action="{{ route('dashboard.patient.poli.store') }}"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="rm_number">Nomor Rekam Medis</label>
                                                    <input type="rm_number"
                                                           class="form-control rounded-0 @error('jam_mulai') is-invalid @enderror"
                                                           value="{{ Auth::user()->patient->rm_number }}" readonly>
                                                </div>
                                                <label for="nama">Pilih Poli <span class="text-danger">*</span></label>
                                                <select name="poli_id" id="poli_id" class="form-control">
                                                    <option value="">-- Pilih Poli --</option>
                                                    @foreach ($polis as $poli)
                                                        <option value="{{ $poli->id }}">
                                                            {{ $poli->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama">Pilih Jadwal <span class="text-danger">*</span></label>
                                                <select name="schedule_id" id="schedule_id" class="form-control">
                                                    <option value="">-- Pilih Jadwal --</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama">Keluhan <span class="text-danger">*</span></label>
                                                <textarea id="" cols="30" rows="3" class="form-control" name="complaint" placeholder="Keluhan">{{ old('complaint') }}</textarea>
                                            </div>
                                            <div>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 mx-auto">
                                        <table id="example1" class="table table-bordered table-striped table-hover">
                                            <thead>
                                            <tr class="text-center">
                                                <th>No Antrian</th>
                                                <th>Poli</th>
                                                <th>Dokter</th>
                                                <th>Keluhan</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($registerPoli as $item)
                                                <tr>
                                                    <td>{{ $item->queue_number }}</td>
                                                    <td>
                                                        {{ $item->schedule->doctor->poli->name }}
                                                        <br>
                                                        {{ $item->schedule->day == 1 ? 'Senin' : '' }}
                                                        {{ $item->schedule->day == 2 ? 'Selasa' : '' }}
                                                        {{ $item->schedule->day == 3 ? 'Rabu' : '' }}
                                                        {{ $item->schedule->day == 4 ? 'Kamis' : '' }}
                                                        {{ $item->schedule->day == 5 ? 'Jumat' : '' }}
                                                        {{ $item->schedule->day == 6 ? 'Sabtu' : '' }}
                                                        {{ $item->schedule->day == 7 ? 'Minggu' : '' }}
                                                        <br> Jam {{ $item->schedule->start_time }} s/d
                                                        {{ $item->schedule->end_time }}
                                                        <br>
                                                        Tanggal {{ Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}
                                                    </td>
                                                    <td>
                                                        {{ $item->schedule->doctor->name }}
                                                    </td>
                                                    <td>{{ $item->complaint }}</td>
                                                    <td>
                                                        @php
                                                            // ambil hari ini apakah senin, selasa, rabu, dst
                                                            $day = \Carbon\Carbon::now()->format('N');
                                                            $timeNow = \Carbon\Carbon::now()->format('H:i:s');
                                                            $today = \Carbon\Carbon::now()->format('Y-m-d');
                                                        @endphp
                                                        @if ($item->status == 'waiting')
                                                            <span class="badge badge-warning">Menunggu</span>
                                                        @elseif($item->created_at->format('Y-m-d') != $today && $item->status == 'waiting')
                                                            <span class="badge badge-danger">Telat</span>
                                                        @elseif($item->status == 'done')
                                                            <span class="badge badge-success">Selesai</span>
                                                        @endif

                                                        @if ($item->status == 'waiting')
                                                            @if ($item->schedule->day == $day)
                                                                @if ($timeNow >= $item->schedule->start_time && $timeNow <= $item->schedule->end_time)
                                                                    <span class="badge badge-primary">
                                                                        Saatnya Periksa
                                                                    </span>
                                                                @endif
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('dashboard.patient.poli.show', $item->id) }}"
                                                           class="btn btn-sm btn-info">
                                                            Detail Periksa
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('js')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('poli_id').addEventListener('change', function () {
                var selectedPoli = this.value;

                var scheduleDropdown = document.getElementById('schedule_id');

                scheduleDropdown.innerHTML = '<option value="">-- Pilih Jadwal --</option>';

                @foreach ($schedules as $item)
                if ("{{ $item->doctor->poli->id }}" === selectedPoli) {
                    var option = document.createElement('option');
                    option.value = "{{ $item->id }}";
                    const doctorName = "{{ $item->doctor->name }}"
                    const name = doctorName.split(' ');

                    option.text = `dr. ${name[0]} - ` +
                        '{{ $item->day == 1 ? 'Senin' : '' }}' +
                        '{{ $item->day == 2 ? 'Selasa' : '' }}' +
                        '{{ $item->day == 3 ? 'Rabu' : '' }}' +
                        '{{ $item->day == 4 ? 'Kamis' : '' }}' +
                        '{{ $item->day == 5 ? 'Jumat' : '' }}' +
                        '{{ $item->day == 6 ? 'Sabtu' : '' }}' +
                        '{{ $item->day == 7 ? 'Minggu' : '' }}' +
                        ' - {{ date('H:i', strtotime($item->start_time)) }} s/d {{ date('H:i', strtotime($item->end_time)) }}';
                    scheduleDropdown.appendChild(option);
                }
                @endforeach

                    scheduleDropdown.style.display = 'block';
            });
        });
    </script>
@endsection
