@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">Sản Phẩm</a></li>
                            <li class="breadcrumb-item active">Thêm</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Thêm Sản Phẩm</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="{{ route('admin.product.create') }}" class="form-horizontal"  enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Tên Sản Phẩm</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="name" class="form-control @error('name') border border-danger @enderror" placeholder="Tên Sản Phẩm" value="{{ old('name') }}">
                                            @error('name')
                                                <div class="text-danger mt-2 mb-0">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Hình Ảnh</label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control  @error('image') border border-danger @enderror" name="image" multiple>
                                            @error('image')
                                                <div class="text-danger mt-2 mb-0">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Thể Loại</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="category">
                                                @foreach($data as $item)
                                                    <optgroup label="{{ $item['alias'] }}">
                                                        @if(isset($item['children']))
                                                            @foreach($item['children'] as $v)
                                                                <option value="{{ $v['id'] }}">{{ $v['alias'] }}</option>
                                                            @endforeach
                                                        @endif
                                                    </optgroup>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Giá</label>
                                        <div class="col-sm-10">
                                            <input type="number" name="price" class="form-control  @error('price') border border-danger @enderror" placeholder="Giá Sản Phẩm VNĐ" value="{{ old('price') }}">
                                            @error('price')
                                            <div class="text-danger mt-2 mb-0">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Trạng Thái</label>
                                        <div class="col-sm-10 mt-2">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="0" checked="">
                                                    ON
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="1">
                                                    OFF
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Nội Dung</label>
                                        <div class="col-sm-10">
                                            <div class="mb-3">
                                                <textarea class="textarea" placeholder="Place some text here" name="content">
                                                        {{ old('content') }}
                                                </textarea>
                                            </div>
                                            @error('content')
                                                <div class="text-danger mt-2 mb-0">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer text-center">
                                    <button type="submit" class="btn btn-info">Lưu</button>
                                </div>
                                <!-- /.card-footer -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
@push('scripts')
    <script  type="text/javascript">
        $(function () {
            $("input[data-bootstrap-switch]").each(function(){
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            });
        })
    </script>
@endpush
@endsection
