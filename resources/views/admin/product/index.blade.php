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
                    <div class="col-12">
                        <div class="">
                            <a href="{{ route('admin.product.create') }}" class="btn btn-secondary active mb-4" role="button" aria-pressed="true">Thêm</a>
                        </div>
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th style="width: 50px">STT</th>
                                        <th style="width: 500px">Sản Phẩm</th>
                                        <th style="width: 200px">Hình Ảnh</th>
                                        <th style="width: 250px">Thể Loại</th>
                                        <th style="width: 250px">Giá</th>
                                        <th style="width: 150px">Trạng Thái</th>
                                        <th style="width: 100px">Hành Động</th>
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
                                            <td>
                                                <p>{{ $data->price }}</p>
                                            </td>
                                            <td>
                                                <p>{{ \App\Models\Product::$status[$data->status] }}</p>
                                            </td>
                                            <td>
                                                <a class="d-inline"  href="{{ route('admin.product.edit', [$data->id]) }}">Edit</a> |
                                                <form class="d-inline" action="{{ route('admin.product.delete', [$data->id]) }}" method="POST" id="form-delete-product">
                                                    @csrf
                                                    <a href="#" class="btn-link"  data-toggle="modal" data-target="#modal-default">DELETE</a>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>

            </div>

        </section>
        <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Thích thì xóa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <p>Ảe you Sủe???</p>
                        <p>Ảe you Sủe???</p>
                        <p>Ảe you Sủe???</p>
                        <p>Ảe you Sủe???</p>
                        <p>Ảe you Sủe???</p>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Retủn</button>
                        <button type="button" class="btn btn-primary" id="btn-delete-product">Sủe</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
                "language": {
                    "lengthMenu": "Hiển thị _MENU_ sản phẩm",
                    "zeroRecords": "Chả tìm thấy gì cả",
                    "info": "Đây là page _PAGE_ trong tất cả _PAGES_ page",
                    "infoEmpty": "Làm gì có gì",
                    "infoFiltered": "(filtered from _MAX_ total records)"}
            });
            $("#btn-delete-product").click(function (){
                $("#form-delete-product").submit();
            }) ;
        });
    </script>
@endpush

