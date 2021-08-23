@foreach($value->children as $childCategory)
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
    </li>
@endforeach
