@extends('layouts.master')

@section('content')
    <section>
        <div class="custom-box">
            <div class="box-header">
                <h3 class="box-title">Sản phẩm</h3>
            </div><!-- /.box-header -->
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header box-search">
                        <div class="box-search-title">
                            <h4>Tìm kiếm sản phẩm</h4>
                            <a class="btn btn-primary btn-sm" href="{{URL::route('createProduct')}}">
                                <i class="fa fa-plus"></i> Thêm mới
                            </a>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-search">
                            {!! Form::open(array('id' => 'search-form')) !!}
                            <div class="col-xs-3">
                                {!! Form::text('name', null, array('class' => 'form-control input-sm', 'placeholder' => 'Tìm kiếm', 'id'=>'search-name')) !!}
                            </div>
                            {!! Form::button('Tìm kiếm', array('type' => 'submit', 'class'=>'btn btn-primary btn-sm')) !!}
                            {!! Form::button('Reset', array('type' => 'reset', 'class' => 'btn btn-default btn-sm')) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>

                <div class="box"> <!-- Search results -->
                    <div class="box-header">
                        <h3 class="box-title">Kết quả tìm kiếm</h3>
                    </div><!-- /.box-header -->

                    <div class="box-body table-responsive no-padding">
                        <table id="table" class="table row-border table-striped dataTable">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Price</th>
                                    <th>Sell Price</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Updated</th>
                                    <th class="nosort"></th>
                                </tr>
                            </thead>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
    </section>

@stop
@section('javascript')
    CKEDITOR.replace('description',{
        filebrowserImageUploadUrl: "/lib/ckeditor/plugins/imgupload/imgupload.php"
    });
    Kacana.product.listProducts();
@stop
@extends('product.form-create')
@extends('product.edit-modal')
@section('javascript')
    Kacana.product.init();
@stop

