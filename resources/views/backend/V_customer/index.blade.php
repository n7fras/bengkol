@extends('backend.layout.app')
@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Customer ID </th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th><span class="mdi mdi-dots-vertical"></span></th>
                                </tr>
                            </thead>
                            <tbody>
                             
                                @foreach ($cust as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->username }}</td>
                                    <td>{{ $row->cust_id }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>{{ $row->phone }}</td>
                                    <td>{{$row->address}}</td>
                                    
                                    <td>@if( $row->status==1)
                                        <span class="badge badge-success">Active</span>
                                        @elseif($row->status==0)
                                        <span class="badge badge-danger">Notactive</span>
                                        @endif
                                    </td>
                                    <td>
                                      
                                            <a class="nav-link  waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" > <i class="mdi mdi-dots-vertical"></i>
                                            </a>
                                             <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item" href="{{ route('internal_user.edit', $row->id) }}">Edit</a>
                                                
                                                <form action="{{ route('internal_user.delete', $row->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirmDelete();">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger" style="border: none; background: transparent;">Delete</button>
                                                </form> <br>
           
                                              
                                               
                                                @if ($row->status == 1)
                                                <form action="{{ route('internal_user.deactivate', $row->id) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item">Deactivate User</button>
                                                </form> <br>
                                            @else
                                                <!-- Reactivate -->
                                                <form action="{{ route('internal_user.reactivate', $row->id) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item">Reactivate User</button>
                                                </form>
                                            @endif
                                                
                                            
                                            </div>
                                       
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        {{-- {{ $users->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this user?');
    }
</script>
@endsection




