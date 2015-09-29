
@extends('layouts.master')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Thương hiệu sản phẩm</h3>
                    </div><!-- /.box-header -->
                </div>

                <div class="box box-primary">
                    <div class="box-header box-search">
                        <div class="box-search-title">
                            <h4>Tìm kiếm thương hiệu sản phẩm</h4>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Thêm mới
                            </button>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-search">
                            {!! Form::open(array('id' => 'search-form')) !!}
                            <div class="col-xs-3">
                                {!! Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Tìm kiếm', 'id'=>'search-name')) !!}
                            </div>
                            {!! Form::button('Tìm kiếm', array('type' => 'submit', 'class'=>'btn btn-primary')) !!}
                            {!! Form::button('Reset', array('type' => 'reset', 'class' => 'btn btn-default')) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>

                <div class="box"> <!-- Search results -->
                    <div class="box-header">
                        <h3 class="box-title">Kết quả tìm kiếm</h3>
                    </div><!-- /.box-header -->

                    <div class="box-body table-responsive no-padding">
                        <table id="table" class="table table-bordered table-striped dataTable">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Updated</th>
                                    <th></th>
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
    Kacana.product.branch.listBranch();

@stop
@extends('branch.form-create')
@extends('branch.edit-modal')

