@foreach($value->childrenCategories as $childCategory)
    <li class="dd-item dd3-item" data-id="{{ $childCategory->id }}">
        <div class="dd-handle dd3-handle"></div>
        <div class="dd3-content">
            <div class="row">
                <div class="col-md-10">
                    {{ substr($childCategory->name,0,60) }}
                </div>
                <div class="col-md-2">
                    {!! editDeleteAction($childCategory->id,'admin.category') !!}
                </div>
            </div>
        </div>
        @if($childCategory->children->count()>0)
            <ol class="dd-list">
                @include('backend.category.category-children',['value'=>$childCategory])
            </ol>
        @endif
    </li>
@endforeach
