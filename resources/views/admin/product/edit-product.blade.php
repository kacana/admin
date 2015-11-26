@extends('layouts.admin.master')

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

                    {!! Form::open(array('method'=>'put','id' =>'form-edit-product', 'onsubmit'=>true, 'enctype'=>"multipart/form-data")) !!}
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

                        <!-- property -->
                        <div class="form-group">
                            {!! Form::label('property', 'Đặc tính sản phẩm') !!}
                            {!! Form::textarea('property', $property) !!}
                        </div>

                        <!-- property description -->
                        <div class="form-group">
                            {!! Form::label('property_description', 'Miêu tả đặc tính sản phẩm') !!}
                            {!! Form::textarea('property_description', $property_description) !!}
                        </div>

                        <!-- description -->
                        <div class="form-group">
                            {!! Form::label('description', 'Mô tả sản phẩm') !!}
                            {!! Form::textarea('description', $description) !!}
                        </div>

                        <!-- meta -->
                        <div class="form-group">
                            {!! Form::label('meta', 'Meta') !!}<br/>
                            {!! Form::textarea('meta', $meta, array('class'=>'form-control', 'style'=>'height:80px')) !!}
                        </div>

                        <!-- tags -->
                        <div class="form-group">
                            {!! Form::label('tags', 'Tags') !!}
                            <div class="treeview-tags" data-role="treeview" id="tree-tags" data-url="/tag/getTags/{{$id}}/"></div>
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
    CKEDITOR.replace('property');
    CKEDITOR.replace('property_description');

    $("#tree-tags").tree({
        closedIcon: $('<i class="fa fa-plus-square-o"></i>'),
        openedIcon: $('<i class="fa fa-minus-square-o"></i>'),
        onCreateLi: function(node, $li){
            countChild = node.childs;
            nodeid = node.id;
            if(node.checked == true){
                $li.find('.jqtree-title').before(' <input type="checkbox" name="tags[]" value="'+nodeid+'" checked/> ');
            }else{
                $li.find('.jqtree-title').before(' <input type="checkbox" name="tags[]" value="'+nodeid+'" /> ');
            }
        }
    });
@stop

