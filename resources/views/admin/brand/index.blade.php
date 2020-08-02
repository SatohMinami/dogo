@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Brand</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Brand</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="">
                            <!-- /.card-header -->
                            <!-- Main content -->
                                <div class="card">
                                        <div class="card-header">
                                            <a href="{{ route('admin.brand.create') }}" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Create</a>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body p-0">
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th style="width: 100px">#</th>
                                                    <th>Name</th>
                                                    <th style="width: 250px">Image</th>
                                                    <th style="width: 150px">Status</th>
                                                    <th style="width: 150px">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Update software</td>
                                                    <td>OFF</td>
                                                    <td>ON</td>
                                                    <td>
                                                        <a href="{{ route('admin.brand.edit') }}">Edit</a> / <a href="">Delete</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Update software</td>
                                                    <td>OFF</td>
                                                    <td>ON</td>
                                                    <td>
                                                        <a href="{{ route('admin.brand.edit') }}">Edit</a> / <a href="">Delete</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Update software</td>
                                                    <td>OFF</td>
                                                    <td>ON</td>
                                                    <td>
                                                        <a href="{{ route('admin.brand.edit') }}">Edit</a> / <a href="">Delete</a>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                            <!-- /.content -->
                        </div>
                    </div>
                    <div class="col-md-2">
                    </div>
                </div>
            </div>

        </section>
    </div>
@endsection
