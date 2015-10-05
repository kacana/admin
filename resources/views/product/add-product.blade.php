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
                        <h3 class="box-title">Thêm sản phẩm</h3>
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
                        @endif
                    @endif
                    {!! Form::open(array('id' =>'form-edit-product', 'onsubmit'=>true, 'enctype'=>"multipart/form-data")) !!}
                    <div class="modal-body">
                        <!-- name -->
                        <div class="form-group">
                            {!! Form::label('name', 'Tên sản phẩm') !!}
                            {!! Form::text('name', null, array('required', 'class' => 'form-control', 'placeholder' => 'Tên sản phẩm')) !!}
                        </div>

                        <!-- image -->
                        <div class="form-group">
                            {!! Form::label('image', 'Hình ảnh') !!}
                            {!! Form::file('image', '') !!}
                        </div>

                        <!-- price -->
                        <div class="form-group">
                            {!! Form::label('price', 'Giá sản phẩm') !!}
                            {!! Form::text('price', null, array('required', 'class' => 'form-control', 'placeholder' => 'Gía sản phẩm')) !!}
                            <span id="error-price" class="has-error text-red"></span>
                        </div>

                        <!-- sell price -->
                        <div class="form-group">
                            {!! Form::label('sell_price', 'Giá bán sản phẩm') !!}
                            {!! Form::text('sell_price', null, array('required', 'class' => 'form-control', 'placeholder' => 'Giá bán sản phẩm')) !!}
                        </div>

                        <!-- description -->
                        <div class="form-group">
                            {!! Form::label('description', 'Mô tả sản phẩm') !!}
                            {!! Form::textarea('description') !!}
                        </div>

                        <!-- description -->
                        <div class="form-group">

                            <div class="chosentree"></div>

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


    var loadChildren = function(node, level) {
        $.ajax({
            type:'get',
            url: '/tag/getTagById',
            dataType:'json',
            success: function(result){
                return result;
            }
        });
    };

    JSONObject = JSON.parse('{
    "id":"01",
    "title":"Node 01",
    "has_children":true,
    "level":1,
    "children":[
    {"id":"011","title":"Node 011","has_children":true,"level":2,"children":[{"id":"0111","title":"Node 0111","has_children":false,"level":3,"children":[]}]}]}');

    $('div.chosentree').chosentree({
        width: 500,
        deepLoad: true,
        showtree: true,
        load: function(node, callback) {
            callback();
        }
    });

@stop

