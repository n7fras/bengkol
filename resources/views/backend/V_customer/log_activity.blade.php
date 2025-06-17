@extends('backend.layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{$judul}}</h5>
                   
                    <div class="row g-3 align-items-end" style="margin-bottom: 20px;">
                        <div class="col-md-3">
                            <label for="startDate" class="form-label">Start Date</label>
                            <input type="datetime-local" class="form-control" id="startDate">
                        </div>
                        <div class="col-md-3">
                            <label for="endDate" class="form-label">End Date</label>
                            <input type="datetime-local" class="form-control" id="endDate">
                        </div>
                        <div class="col-md-3">
                            <label for="accountNumber" class="form-label">Cust_id / Customer Name</label>
                            <input type="text" class="form-control" id="accountNumber" placeholder="Cust_id / Customer Name">
                        </div>
                        <div class="col-md-3 d-flex gap-2">
                            <button class="btn btn-primary flex-fill">Cari</button>
                            <button class="btn btn-success flex-fill">
                                <i class="fas fa-file-excel"></i> Export Excel
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Cust_id</th>
                                    <th>Customer Name</th>
                                    <th>Action</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    
                                    <th><span class="mdi mdi-dots-vertical"></span></th>
                                </tr>
                            </thead>
                            <tbody>
                             
                             
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
@endsection