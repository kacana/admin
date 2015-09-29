@extends('layouts.master')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Sản phẩm</h3>
                    </div><!-- /.box-header -->
                </div>

                <div class="box box-primary box-body"> <!-- Search results -->
                    <div class="box-header with-border">
                        <h3 class="box-title">Cập nhật sản phẩm</h3>
                    </div><!-- /.box-header -->
                    @if($_POST)
                        @if (count($errors) > 0)
                            <div class="alert alert-danger alert-dismissible">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @else
                            <div class="alert alert-success alert-dismissible">
                                Cập nhật sản phẩm thành công
                            </div>
                        @endif
                    @endif
                    {!! Form::open(array('id' =>'form-edit-product', 'onsubmit'=>true, 'enctype'=>"multipart/form-data")) !!}
                    <div class="modal-body">
                        <!-- name -->
                        <div class="form-group">
                            {!! Form::label('name', 'Tên sản phẩm') !!}
                            {!! Form::text('name', $name, array('required', 'class' => 'form-control', 'placeholder' => 'Tên sản phẩm')) !!}
                        </div>

                        <!-- image -->
                        <div class="form-group">
                            {!! Form::label('image', 'Hình ảnh') !!}
                            {!! Form::file('image', '') !!}
                            @if(!empty($image))
                                <br/><img width="50" height="50" src="/images/product/{{$id}}/{{$image}}"/>
                            @endif
                        </div>

                        <!-- price -->
                        <div class="form-group">
                            {!! Form::label('price', 'Giá sản phẩm') !!}
                            {!! Form::text('price', $price, array('required', 'class' => 'form-control', 'placeholder' => 'Gía sản phẩm')) !!}
                            <span id="error-price" class="has-error text-red"></span>
                        </div>

                        <!-- sell price -->
                        <div class="form-group">
                            {!! Form::label('sell_price', 'Giá bán sản phẩm') !!}
                            {!! Form::text('sell_price', $sell_price, array('required', 'class' => 'form-control', 'placeholder' => 'Giá bán sản phẩm')) !!}
                        </div>

                        <!-- description -->
                        <div class="form-group">
                            {!! Form::label('description', 'Mô tả sản phẩm') !!}
                            {!! Form::textarea('description', $description) !!}
                        </div>

                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-default" href="/product">Huỷ</a>
                        <button type="submit" id="btn-update"class="btn btn-primary">Cập nhật</button>
                    </div>
                    {!! Form::close() !!}
                </div><!-- /.box -->
            </div>
        </div>
    </section>
@stop
@section('javascript')
    CKEDITOR.replace('description',{
        filebrowserImageUploadUrl: "/lib/ckeditor/plugins/imgupload/imgupload.php"
    });
@stop

