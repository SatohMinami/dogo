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
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                        @endforeach
                        <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="{{ route('admin.product.update') }}" class="form-horizontal"  enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Tên Sản Phẩm</label>
                                        <div class="col-sm-10">
                                            <input type="hidden" name="id" value="{{ $data->id }}">
                                            <input type="text" name="name" value="{{ !empty(old('name')) ? old('name') : $data->name }}" class="form-control @error('name') border border-danger @enderror" placeholder="Tên Sản Phẩm">
                                            @error('name')
                                            <div class="text-danger mt-2 mb-0">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Hình Ảnh</label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control  src="{{ $data->image }}"  @error('image') border border-danger @enderror" name="image" multiple>
                                            @error('image')
                                            <div class="text-danger mt-2 mb-0">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Thể Loại</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="category">
                                                @foreach($category as $item)
                                                    <optgroup label="{{ $item['alias'] }}">
                                                        @if(isset($item['children']))
                                                            @foreach($item['children'] as $v)
                                                                    <option value="{{ $v['id'] }}" {{ $v['id'] == $data->category ? 'selected' : '' }}>{{ $v['alias'] }}</option>
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
                                            <input type="number" name="price" value="{{ $data->price }}" class="form-control  @error('price') border border-danger @enderror" placeholder="Giá Sản Phẩm VNĐ" value="{{ old('price') }}">
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
                                                    <input type="radio" name="status" id="optionsRadios1" value="1" checked="">
                                                    ON
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="status" id="optionsRadios2" value="0">
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
                                                        {{ $data->content }}
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
@endsection
