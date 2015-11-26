@extends('layouts.admin.master')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Người dùng</h3>
                    </div><!-- /.box-header -->
                </div>
                <div class="col-xs-4">
                    <div class="box box-primary box-body"> <!-- Search results -->
                        <div class="box-header with-border">
                            <h3 class="box-title">Cập Nhật Tag</h3>
                        </div><!-- /.box-header -->
                        {!! Form::open(array('method'=>'put', 'id' =>'form-edit-tag', 'enctype'=>"multipart/form-data")) !!}
                        <div class="modal-body">
                            <!-- name -->
                            <div class="form-group">
                                {!! Form::label('name', 'Tag') !!}
                                {!! Form::text('name', $tag->name, array('required', 'class' => 'form-control', 'placeholder' => 'Tag')) !!}
                            </div>
                            <!--  description -->
                            <div class="form-group">
                                {!! Form::label('description', 'Miêu tả') !!}
                                {!! Form::textarea('description', $tag->description, ['size' => '30x4']) !!}
                            </div>

                            <!-- image -->
                            <div class="form-group">
                                {!! Form::label('image', 'Hình ảnh') !!}
                                {!! Form::file('image') !!}
                                @if(!empty($tag->image))
                                    <br/><img width="50" height="50" src="/{{TAG_IMAGE}}{{$tag->id}}/{{$tag->image}}"/>
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-default" href="/product/tag">Huỷ</a>
                            <button type="submit" id="btn-update" class="btn btn-primary">Cập nhật</button>
                        </div>
                        <input id="tagId" value="{{ $tag->id }}" type="hidden"/>
                        {!! Form::close() !!}
                    </div><!-- /.box -->
                </div>
                <div class="col-xs-8">
                    <div class="box box-primary box-body"> <!-- Search results -->
                        <div class="box-header with-border">
                            <h3 class="box-title">Sản Phẩm</h3>
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
        </div>
    </section>
@stop
@section('javascript')
    Kacana.product.tag.init();
@stop

