@extends('layouts.admin.master')

@section('content')
    <section>
        <div class="custom-box">
            <div class="box-header">
                <h3 class="box-title">Tag</h3>
            </div><!-- /.box-header -->
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box"> <!-- Search results -->
                    <div class="box-header">
                        <h3 class="box-title">Danh sách Tags</h3>
                        <button type="button" class="btn btn-primary btn-sm" onclick="Kacana.product.tag.showCreateForm(0)">
                            <i class="fa fa-plus"></i> Thêm mới
                        </button>
                    </div><!-- /.box-header -->


                    <div class="box-body">
                        <div class="treeview-tags" data-role="treeview" id="tree-tags" data-url="/tag/getTags/0"></div>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
    </section>
@stop
@extends('admin.tag.modal')
@section('javascript')
    Kacana.product.tag.init();
@stop

