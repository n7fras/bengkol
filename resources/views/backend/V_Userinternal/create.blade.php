@extends('backend.layout.app')

@section('content')
<!-- contentAwal -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form class="form-horizontal" action="{{route('internal_user.store')}}"
                    method="post" enctype="multipart/form-data">
                    @csrf
        
                    <div class="card-body">
                        <h4>{{$judul}}</h4>
                        <h4 class="card-title"></h4>
                        <div class="row">
                            <div class="col-md-4">
                                <!-- Foto Section -->
                                <div class="form-group">
                                    <label>Photo</label>
                                    <img class="foto-preview">
                                    <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror"
                                        onchange="previewFoto()">
                                    @error('foto')
                                    <div class="invalid-feedback alert-danger"></div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-8">
                                <!-- Form Fields -->
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Input email">
                                    @error('email')
                                    <span class="invalid-feedback alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Role</label>
                                    <select class="form-control @error('role') is-invalid @enderror" name="role">
                                        <option value="" selected>--Pilih Role--</option>
                                        <option value="Super Admin">Super Admin</option>
                                        <option value="Admin Input">Admin Input</option>
                                        <option value="Supervisor">Supervisor</option>
                                    </select>
                                    @error('role')
                                    <span class="invalid-feedback alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="username" value="{{ old('username') }}" class="form-control @error('username') is-invalid @enderror" placeholder="Input Username">
                                    @error('username')
                                    <span class="invalid-feedback alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Input Name">
                                    @error('name')
                                    <span class="invalid-feedback alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input type="text" name="phone" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror" placeholder="Input Phone Number">
                                    @error('phone')
                                    <span class="invalid-feedback alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Address</label><br>
                                    <textarea name="address" class="form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
                                    @error('address')
                                    <span class="invalid-feedback alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control @error('status') is-invalid @enderror" name="status">
                                        <option value="" selected>--Select Status--</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                    @error('status')
                                    <span class="invalid-feedback alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- Password Section -->
                                <div class="form-group">
                                    <label>Password </label>
                                    <input type="text" name="password" class="form-control @error('password') is-invalid @enderror"readonly  >
                                    @error('password')
                                    <span class="invalid-feedback alert-danger">{{ $message }}</span>
                                    @enderror
                                    <button type="button" class="btn btn-info mt-2"style="background-color: #00a373" onclick="setGeneratedPassword()">Generate Password</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" class="btn " style="background-color: #00a373">Save</button>
                            <a href="#">
                                <button type="button" class="btn btn-secondary">Back</button>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- contentAkhir -->

@endsection


