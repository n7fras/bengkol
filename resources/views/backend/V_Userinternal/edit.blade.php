
@extends('backend.layout.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form class="form-horizontal" action="{{route('internal_user.update', $edit->id)}}"
                    method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <h4 class="card-title">{{$judul}}</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <!-- Foto Section -->
                                <div class="form-group">
                                    <label>Foto</label>
                                    @if($edit->foto)
                                    <img  src="{{ asset('storage/img-user/' . $edit->foto) }}" class="foto-preview" width="100%">
                                    @else
                                    <img class="foto-preview"src=""{{ asset('storage/img-user/'.$edit->foto) }} >
                                 
                                    @endif
                                    <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" onchange="previewFoto()">
                                    @error('foto')
                                    <div class="invalid-feedback alert-danger"></div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-8">
                                <!-- Form Fields -->
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <input type="email" name="email" value="{{ old('email', $edit->email) }}" class="form-control @error('email') is-invalid @enderror" placeholder="Input email">
                                    @error('email')
                                    <span class="invalid-feedback alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Role</label>
                                    <select class="form-control @error('role') is-invalid @enderror" name="role">
                                        <option value="" {{ old('role', $edit->role) == '' ? 'selected' : '' }}>--Pilih Role--</option>
                                        <option value="Super Admin"{{ old('role', $edit->role) == 'Super Admin' ? 'selected' : '' }}>Super Admin</option>
                                        <option value="Admin Input"{{ old('role', $edit->role) == 'Admin Input' ? 'selected' : '' }}>Admin Input</option>
                                        <option value="Supervisor"{{ old('role', $edit->role) == 'Supervisor' ? 'selected' : '' }}>Supervisor</option>
                                    </select>
                                    @error('role')
                                    <span class="invalid-feedback alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="username" value="{{ old('username', $edit->username) }}" class="form-control @error('username') is-invalid @enderror" placeholder="Input Username">
                                    @error('username')
                                    <span class="invalid-feedback alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" value="{{ old('name', $edit->name) }}" class="form-control @error('name') is-invalid @enderror" placeholder="Input Name">
                                    @error('name')
                                    <span class="invalid-feedback alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input type="text" name="phone" value="{{ old('phone', $edit->phone) }}" class="form-control @error('phone') is-invalid @enderror" placeholder="Input Phone Number">
                                    @error('phone')
                                    <span class="invalid-feedback alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Address</label><br>
                                    <textarea name="address" class="form-control @error('address') is-invalid @enderror">{{ old('address', $edit->address) }}</textarea>
                                    @error('address')
                                    <span class="invalid-feedback alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control @error('status') is-invalid @enderror" name="status">
                                        <option value="" {{ old('status', $edit->status) == '' ? 'selected' : '' }}>--Select Status--</option>
                                        <option value="1"{{ old('status', $edit->status) == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0"{{ old('status', $edit->status) == '0' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                    <span class="invalid-feedback alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" class="btn" style="background-color: #00a373">Save</button>
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