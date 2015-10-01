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


                    <div class="box-body table-responsive no-padding">
                        <div class="treeview-tags" data-role="treeview">
                            @if($tags)
                            <ul>
                                @foreach($tags as $tag)
                                    <li class="contain">
                                        <p>
                                            {{$tag->name}}
                                            <span class="badge bg-gray"><a href="#">{{ $tag->countChild() }} childs</a></span>
                                            <span><a class="btn bg-light-blue-active btn-sm" title="add tag" href="javascript:void(0)" onclick="Kacana.product.tag.showCreateForm({!! $tag->id !!})"><i class="fa fa-plus"></i></a></span>
                                            <span><a class="btn bg-light-blue-active btn-sm" title="main tag"><i class="fa fa-arrow-circle-up"></i></a></span>

                                            <span><a class="btn bg-light-blue-active btn-sm" title="sub tag"><i class="fa fa-map-marker"></i></a></span>

                                            <span><a class="btn bg-light-blue-active btn-sm" title="edit tag" onclick="Kacana.product.tag.showEditForm({!! $tag->id !!})"><i class="fa fa-pencil"></i></a></span>

                                            @if($tag->countChild() == 0)
                                                <span><a class="btn bg-red btn-sm" title="remove tag" onclick="Kacana.product.tag.removeTag({!! $tag->id !!})"><i class="fa fa-remove"></i></a></span>
                                            @endif
                                        </p>
                                        <ul>
                                            <li></li>
                                        </ul>
                                    </li>
                                @endforeach
                            </ul>
                            @else
                                Không có dữ liệu
                            @endif
                        </div>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
    </section>
@stop
@extends('tag.modal')

