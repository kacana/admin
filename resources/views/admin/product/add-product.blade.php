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

                        @if ($errors->count()> 0)
                            <div class="alert alert-danger alert-dismissible">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                    {!! Form::open(array('method'=>'post', 'id' =>'form-edit-product', 'onsubmit'=>true, 'enctype'=>"multipart/form-data")) !!}
                    <div class="modal-body">
                        <!-- name -->
                        <div class="form-group">
                            {!! Form::label('name', 'Tên sản phẩm') !!}
                            {!! Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Tên sản phẩm')) !!}
                        </div>

                        <!-- image -->
                        <div class="form-group">
                            {!! Form::label('image', 'Hình ảnh') !!}
                            {!! Form::file('image', '') !!}
                        </div>

                        <!-- price -->
                        <div class="form-group">
                            {!! Form::label('price', 'Giá sản phẩm') !!}
                            {!! Form::text('price', null, array('class' => 'form-control', 'placeholder' => 'Gía sản phẩm')) !!}
                            <span id="error-price" class="has-error text-red"></span>
                        </div>

                        <!-- sell price -->
                        <div class="form-group">
                            {!! Form::label('sell_price', 'Giá bán sản phẩm') !!}
                            {!! Form::text('sell_price', null, array('class' => 'form-control', 'placeholder' => 'Giá bán sản phẩm')) !!}
                        </div>

                        <!-- description -->
                        <div class="form-group">
                            {!! Form::label('description', 'Mô tả sản phẩm') !!}
                            {!! Form::textarea('description') !!}
                        </div>

                        <!-- tags -->
                        <div class="form-group">
                            {!! Form::label('tags', 'Tags') !!}
                            <div class="treeview-tags" data-role="treeview" id="tree-tags" data-url="/tag/getTags/0"></div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-default" href="/product">Huỷ</a>
                        <button type="submit" id="btn-update"class="btn btn-primary">Tạo mới</button>
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
    $("#tree-tags").tree({
        closedIcon: $('<i class="fa fa-plus-square-o"></i>'),
        openedIcon: $('<i class="fa fa-minus-square-o"></i>'),
        onCreateLi: function(node, $li){
            countChild = node.childs;
            nodeid = node.id;
            $li.find('.jqtree-title').before(' <input type="checkbox" name="tags[]" value="'+nodeid+'"/> ');
        }
    });
@stop

