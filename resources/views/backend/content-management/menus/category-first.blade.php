@foreach($menuItems as $item)
    @if($item->postWithTrashed)
        <li class="dd-item dd3-item" data-id="{{ $item->id }}">
            <div class="dd-handle dd3-handle"></div>
            <div class="dd3-content">
                <div class="row">
                    <div class="col-md-10">
                        {{$item->display_name?? substr($item->postWithTrashed->post_title,0,60) }} @if(empty($item->post))
                            <span class="text-danger">(Page Deleted)</span>@endif
                    </div>
                    <div class="col-md-2">
                        <div class="d-flex flex-row">
                            @if($item->post)
                                <a class="btn btn-sm btn-warning mr-1 " wire:click="editMenuItem({{$item->id}})"><i
                                        class="fa fa-edit"></i>
                                </a>
                            @endif
                            {!! deleteAction($item->id,'admin.content-management.menu-item')!!}
                        </div>
                    </div>
                </div>
            </div>
            @if($item->children_categories_count>0)
                <ol class="dd-list">
                    @include('backend.content-management.menus.category-second',['secondChild'=>$item->childrenCategories])
                </ol>
            @endif
        </li>
    @endif
@endforeach
