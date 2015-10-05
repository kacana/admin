@extends('layouts.master')

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
                        <div class="treeview-tags" data-role="treeview" id="tree-tags" data-url="/tag/getTags/"></div>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
    </section>
@stop
@extends('tag.modal')
@section('javascript')
    $("#tree-tags").tree({
    closedIcon: $('<i class="fa fa-plus-square-o"></i>'),
    openedIcon: $('<i class="fa fa-minus-square-o"></i>'),
        onCreateLi: function(node, $li){
            countChild = node.childs;
            nodeid = node.id;
            str = '<span class="badge bg-gray childleft"><a href="javascript:void(0)"> '+countChild+' childs </a></span>';
            str += ' <span><a class="btn bg-light-blue-active btn-sm" title="add tag" href="javascript:void(0)" onclick="Kacana.product.tag.showCreateForm('+nodeid+')"><i class="fa fa-plus"></i></a></span>';
            str += ' <span><a class="btn bg-light-blue-active btn-sm" title="main tag"><i class="fa fa-arrow-circle-up"></i></a></span>';
            str += ' <span><a class="btn bg-light-blue-active btn-sm" title="sub tag"><i class="fa fa-map-marker"></i></a></span>';
            str += ' <span><a class="btn bg-light-blue-active btn-sm" title="edit tag" onclick="Kacana.product.tag.showEditForm('+nodeid+')"><i class="fa fa-pencil"></i></a></span>';
            str += ' <span><a class="btn bg-red btn-sm" title="remove tag" onclick="Kacana.product.tag.removeTag('+nodeid+')"><i class="fa fa-remove"></i></a></span>';
            $li.find('.jqtree-title').after(str);
        }
    });
@stop

