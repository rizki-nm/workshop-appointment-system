@extends('dashboard/master')
@section('title', 'Dokter | Detail Riwayat Pasien')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.doctor.history.index') }}">Riwayat Pasien</a></li>
                            <li class="breadcrumb-item active">Detail Riwayat Pasien</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            {{-- message error validation --}}
                            @if ($errors->any())
                            <div class="card-header">
                                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            </div>
                            @endif
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Tanggal Periksa</th>
                                            <th>Nama Pasien</th>
                                            <th>Keluhan</th>
                                            <th>Catatan</th>
                                            <th>Obat</th>
                                            <th>Biaya</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($checkup as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->checkup?->date_checkup }}</td>
                                                <td>{{ $item->patient->name }}</td>
                                                <td>{{ $item->complaint }}</td>
                                                <td>{{ $item->checkup->note }}</td>
                                                <td>
                                                    @foreach ($item->checkup->drugDetail as $item)
                                                        <span class="badge badge-info">{{ $item->drug->name }}</span>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    Biaya Poli : Rp. 150.000
                                                    <br>
                                                    Biaya Obat : Rp. {{ number_format($item->checkup->total_payment - 150000, 0, ',', '.') }}
                                                    <br>
                                                    <b>
                                                        Total Biaya : Rp.
                                                        {{ number_format($item->checkup->total_payment, 0, ',', '.') }}
                                                    </b>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
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
