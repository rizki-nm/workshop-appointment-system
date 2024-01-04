@extends('dashboard/master')
@section('title', 'Dokter | Schedule')
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
                            <li class="breadcrumb-item active">Schedule</li>
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
                                    <div class="col-md-6">
                                        <form method="POST" action="{{ route('dashboard.doctor.schedule.store') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="nama">Hari <span class="text-danger">*</span></label>
                                                <select name="hari" id="hari" class="form-control @error('hari') is-invalid @enderror">
                                                    <option value="">-- Pilih Hari --</option>
                                                    <option value="1">Senin</option>
                                                    <option value="2">Selasa</option>
                                                    <option value="3">Rabu</option>
                                                    <option value="4">Kamis</option>
                                                    <option value="5">Jumat</option>
                                                    <option value="6">Sabtu</option>
                                                    <option value="7">Minggu</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama">Jam Mulai <span class="text-danger">*</span></label>
                                                <input type="time"
                                                    class="form-control rounded-0 @error('jam_mulai') is-invalid @enderror"
                                                    id="jam_mulai" name="jam_mulai" value=""
                                                    placeholder="Jam Mulai....">
                                            </div>
                                            <div class="form-group">
                                                <label for="nama">Jam Selesai <span class="text-danger">*</span></label>
                                                <input type="time"
                                                    class="form-control rounded-0 @error('jam_selesai') is-invalid @enderror"
                                                    id="jam_selesai" name="jam_selesai" value=""
                                                    placeholder="Jam Selesai....">
                                            </div>
                                            <div>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card mt-5">
                                            <div class="card-body">
                                                <h5 class="text-center">Jadwal Praktek Sekarang</h5>
                                                @if ($schedule)
                                                    <table class="table table-bordered mt-4">
                                                        <thead>
                                                            <tr>
                                                                <th>Hari</th>
                                                                <th>Jam Mulai</th>
                                                                <th>Jam Selesai</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    @if ($schedule->day == 1)
                                                                        Senin
                                                                    @elseif($schedule->day == 2)
                                                                        Selasa
                                                                    @elseif($schedule->day == 3)
                                                                        Rabu
                                                                    @elseif($schedule->day == 4)
                                                                        Kamis
                                                                    @elseif($schedule->day == 5)
                                                                        Jumat
                                                                    @elseif($schedule->day == 6)
                                                                        Sabtu
                                                                    @elseif($schedule->day == 7)
                                                                        Minggu
                                                                    @endif
                                                                </td>
                                                                <td>{{ date('H:i', strtotime($schedule->start_time)) }}</td>
                                                                <td>{{ date('H:i', strtotime($schedule->end_time)) }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <p class="text-center mt-5">Anda belum memiliki jadwal praktek <br> Atur jadwal praktik di form pada sisi kiri</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
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
@endsection
