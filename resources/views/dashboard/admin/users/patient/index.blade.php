@extends('dashboard/master')
@section('title', 'Pasien')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Pasien</li>
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
                            <div class="card-header">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#modalTambah">
                                    <i class="fas fa-file"></i> Tambah Data
                                </button>
                                {{-- message error validation --}}
                                @if ($errors->any())
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
                                @endif
                                <div class="modal fade" id="modalTambah">
                                    <div class="modal-dialog">
                                        <div class="modal-content" id="modalTambah">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Tambah Data Baru</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST"
                                                action="{{ route('dashboard.admin.users.patient.store') }}"
                                                enctype="multipart/form-data" id="formTambah">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="email">Email <span class="text-danger">*</span></label>
                                                        <input type="email"
                                                            class="form-control rounded-0 @error('email') is-invalid @enderror"
                                                            id="email" name="email" value=""
                                                            placeholder="Email....">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama">Nama <span class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control rounded-0 @error('nama') is-invalid @enderror"
                                                            id="nama" name="nama" value=""
                                                            placeholder="Nama....">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama">No Telp <span class="text-danger">*</span></label>
                                                        <input type="number"
                                                            class="form-control rounded-0 @error('no_telp') is-invalid @enderror"
                                                            id="no_telp" name="no_telp" value=""
                                                            placeholder="No Telp....">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama">KTP <span class="text-danger">*</span></label>
                                                        <input type="number"
                                                            class="form-control rounded-0 @error('ktp') is-invalid @enderror"
                                                            id="ktp" name="ktp" value=""
                                                            placeholder="No KTP....">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama">Alamat <span class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control rounded-0 @error('alamat') is-invalid @enderror"
                                                            id="alamat" name="alamat" value=""
                                                            placeholder="Alamat...">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama">Password <span class="text-danger">*</span></label>
                                                        <input type="password"
                                                            class="form-control rounded-0 @error('password') is-invalid @enderror"
                                                            id="password" name="password" value=""
                                                            placeholder="Password...">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama">Confirm Password <span class="text-danger">*</span></label>
                                                        <input type="password"
                                                            class="form-control rounded-0 @error('password_confirmation') is-invalid @enderror"
                                                            id="password_confirmation" name="password_confirmation"
                                                            value="" placeholder="Confirm Password...">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>User ID</th>
                                            <th>No. RM</th>
                                            <th>No. KTP</th>
                                            <th>Email</th>
                                            <th>Nama</th>
                                            <th>Phone</th>
                                            <th>Alamat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($patients as $item)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $item->user_id }}</td>
                                                <td>{{ $item->rm_number }}</td>
                                                <td>{{ $item->ktp_number }}</td>
                                                <td>{{ $item->user->email }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->phone_number }}</td>
                                                <td>{{ $item->address }}</td>
                                                <td>
                                                    <div class="text-center">
                                                        <button type="button" class="btn btn-warning"
                                                            data-toggle="modal"
                                                            data-target="#modalEdit-{{ $item->user_id }}">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger"
                                                            data-toggle="modal"
                                                            data-target="#modalHapus-{{ $item->user_id }}">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                    <form method="POST"
                                                        action="{{ route('dashboard.admin.users.patient.update', $item->user_id) }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('put')
                                                        <div class="modal fade" id="modalEdit-{{ $item->user_id }}">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Edit Data</h4>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label for="nama">No Telp <span class="text-danger">*</span></label>
                                                                            <input type="text"
                                                                                class="form-control rounded-0 @error('no_telp') is-invalid @enderror"
                                                                                id="no_telp" name="no_telp"
                                                                                value="{{ $item->phone_number }}"
                                                                                placeholder="">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="nama">Nama <span class="text-danger">*</span></label>
                                                                            <input type="text"
                                                                                class="form-control rounded-0 @error('nama') is-invalid @enderror"
                                                                                id="nama" name="nama"
                                                                                value="{{ $item->name }}"
                                                                                placeholder="">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="nama">Alamat <span class="text-danger">*</span></label>
                                                                            <input type="text"
                                                                                class="form-control rounded-0 @error('alamat') is-invalid @enderror"
                                                                                id="alamat" name="alamat"
                                                                                value="{{ $item->address }}"
                                                                                placeholder="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit"
                                                                            class="btn btn-warning">Update</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <form method="POST"
                                                        action="{{ route('dashboard.admin.users.patient.destroy', $item->user_id) }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('delete')
                                                        <div class="modal fade" id="modalHapus-{{ $item->user_id }}">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Hapus Data</h4>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Anda yakin akan menghapus data <span class="text-bold">{{ $item->name }}</span>?</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Hapus</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
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
