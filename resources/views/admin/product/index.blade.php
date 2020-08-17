@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Trang Chủ</a></li>
                            <li class="breadcrumb-item active">Sản phẩm</li>
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
                            <!-- Main content -->
                                <div class="">
                                    <a href="{{ route('admin.product.create') }}" class="btn btn-secondary active mb-4" role="button" aria-pressed="true">Thêm</a>
                                </div>
                                <div class="card">
                                        <!-- /.card-header -->
                                        <div class="card-body p-0">
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th style="width: 100px">STT</th>
                                                    <th>Sản Phẩm</th>
                                                    <th style="width: 250px">Hình Ảnh</th>
                                                    <th style="width: 250px">Thể Loại</th>
                                                    <th style="width: 250px">Giá</th>
                                                    <th style="width: 150px">Trạng Thái</th>
                                                    <th style="width: 150px">Hàng Động</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($datas as $data)
                                                    <tr>
                                                        <td>{{ $loop->index	+ 1 }}</td>
                                                        <td>{{ $data->name	 }}</td>
                                                        <td>
                                                            <img src="{{ $data->image }}" alt="do go">
                                                        </td>
                                                        <td>
                                                            @foreach(\App\Models\Category::getNameCategory() as $key => $role)
                                                                @if($role['id'] == $data->category)
                                                                    <p>{{ $role['alias'] }}</p>
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>{{ $data->price	 }}</td>
                                                        <td>
                                                            {{ \App\Models\Product::$status[$data->status] }}
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('admin.product.edit', $data->id) }}">Edit</a> / <a href="">Delete</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
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
