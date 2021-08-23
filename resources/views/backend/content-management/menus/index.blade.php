@extends('backend.layouts.master')
@section ('site_title', 'Menu')
@section('styles')
    <link rel="stylesheet" href="{{ asset('backend/plugins/jquery-nestable/nestable.css') }}">
    <style>
        .dd3-content, .dd-handle{
            min-height: 45px;
        }
    </style>
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="card-title ">
                            Select A Menu To Edit
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.content-management.menus.change-selected')}}" method="post">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-9 form-group">
                                    <div class="form-group">
                                        <select name="menu_id" id="menu_id" class="form-control">
                                            @foreach($menus  as $menu )
                                                <option
                                                    value="{{$menu->id}}">{{$menu->title}} {{$menu->id==$selectedMenu->id?'(Selected)':''}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-success" type="submit">Select</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-header">
                                <div class="card-title">
                                    Pages
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{route('admin.content-management.menu-item.update',$selectedMenu->id)}}"
                                      method="post">
                                    @csrf
                                    @method('put')
                                    <div class="form-group add-page-menu">
                                        @if(count($pages)>0)
                                            @foreach($pages as $page)
                                                <div class="checkbox checkbox-custom">
                                                    <input type="checkbox" value="{{$page->id}}" name="add_page[]">
                                                    <label for="add_page">{{$page->post_title}}</label>
                                                </div>
                                            @endforeach
                                        @else
                                            <p>No pages found. Create Page a new page? <a
                                                    href="{{route('admin.pages.create')}}">Click
                                                    Here</a>
                                            </p>
                                        @endif
                                    </div>
                                    <div class="form-group ">
                                        <button class="btn btn-success">Add to menu</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-header">
                                <div class="card-title">
                                    Custom Link Page
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{route('admin.content-management.menu-item.store')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="menu_id" value="{{$selectedMenu->id}}">
                                    <div class="form-group">
                                        <label for="title">Item Name</label>
                                        <input type="text" name="title" class="form-control" autocomplete="off"
                                               value="{{old('title')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="url">Item url</label>
                                        <input type="text" name="url" class="form-control" autocomplete="off">
                                    </div>
                                    {{--                                    <div class="form-group">--}}
                                    {{--                                        <label for="title">Menu Icon</label>--}}
                                    {{--                                        <input type="text" name="menu_icon" class="form-control" autocomplete="off"--}}
                                    {{--                                               value="{{old('menu_icon')}}">--}}
                                    {{--                                    </div>--}}
                                    <div class="form-group">
                                        <label for="title">Url Target</label>
                                        <select name="url_target" id="" class="form-control">
                                            <option value="0">Same window</option>
                                            <option value="1">New Window</option>
                                        </select>
                                    </div>
                                    <div class="form-group ">
                                        <button class="btn btn-success">Add to menu</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-sm-12 ">
                <div class="row">
                    <div class="col-md-12">

                        <div class="card mb-3">
                            <div class="card-header">
                                <div class="card-title">
                                    <button id="saveMenuOrder" type="button"
                                            class="btn btn-info btn-outline btn-sm pull-right">
                                        Save Order
                                    </button>
                                </div>
                                <div class="btn-actions-pane-right">
                                    <form
                                        action="{{route('admin.content-management.menus.toggle-active',$selectedMenu->id)}}"
                                        method="post">
                                        @csrf
                                        @method('put')
                                        <span>Selected Menu: {{$selectedMenu->title}}</span>
                                        @if($selectedMenu->is_active === 1)
                                            <button class="btn btn-danger">Deactivate Selected?</button>
                                        @else
                                            <button class="btn btn-success">Activate Menu?</button>
                                        @endif
                                    </form>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{route('admin.content-management.menus.update',$selectedMenu->id)}}"
                                      method="post">
                                    @csrf
                                    @method('put')
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="title">Menu title</label>
                                            <input type="text" name="title" value="{{$selectedMenu->title}}"
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <button class="btn btn-success mt-4" type="submit">Update</button>
                                        </div>
                                    </div>
                                </form>
                                Menu STRUCTURE
                                @livewire('backend.content-management.menus.index',['menuItems'=>$menuItems])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{asset('backend/plugins/jquery-nestable/jquery.nestable.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#nestable2').nestable(
                {
                    maxDepth: 3
                });
            $('#saveMenuOrder').on('click', function () {
                $.ajax({
                    type: "POST",
                    url: "{{route('admin.content-management.menu-item.saveOrder')}}",
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {data: $('.dd').nestable('serialize')},
                    success: function (msg) {
                        console.log(msg);
                        // $("#confirmDelete").modal("hide");
                        window.location.reload();
                    }
                });
            });
        });

    </script>
@endpush
