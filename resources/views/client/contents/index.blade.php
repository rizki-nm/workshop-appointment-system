@extends('client.layouts.index')

<section class="hero-area circle-wrap">
    <div class="container">
        <div class="row full-height align-items-center">
            <div class="col p-100px-t p-50px-b md-p-10px-b">
                <div class="login-box">
                    <!-- /.login-logo -->
                    <div class="">
                        <div class=" text-center">
                            <h4>Daftar Pasien Baru</h4>
                        </div>
                        <div class="card-body">
                            {{-- message valdation error --}}
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Whoops!</strong> Terjadi kesalahan input data yang anda masukan.<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }} </li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                        <span aria-hidden="true"> &times; </span>
                                    </button>
                                </div>
                            @endif
                            <form action="" method="post">
                                @csrf
                                <div class="input-group mb-3">
                                    <input type="email" class="form-control @error('email') is-invalid  @enderror" name="email"
                                           value="{{ old('email') }}" placeholder="Email">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control @error('name') is-invalid  @enderror" name="name"
                                           value="{{ old('name') }}" placeholder="Nama">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control @error('address') is-invalid  @enderror"
                                           name="address" value="{{ old('address') }}" placeholder="Alamat">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control @error('ktp_number') is-invalid  @enderror"
                                           name="ktp_number" value="{{ old('ktp_number') }}" placeholder="Nomor KTP">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control @error('phone_number') is-invalid  @enderror"
                                           name="phone_number" value="{{ old('phone_number') }}" placeholder="Nomor Telepon">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                           value="" name="password" placeholder="Password">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- /.col -->
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                                    </div>
                                    <!-- /.col -->
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.login-box -->
            </div>
        </div>
    </div>
</section>
