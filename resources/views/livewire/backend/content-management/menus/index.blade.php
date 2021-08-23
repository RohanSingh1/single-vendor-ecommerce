<div class="dd myadmin-dd-empty" id="nestable2">
    @if($editMode == true)
        <div class="col-md-12">
            <form wire:submit.prevent="updateMenuItem">
                <div class="form-group">
                    <label for="display_name">Display Name</label>
                    <input type="text" wire:model="displayName" class="form-control">
                </div>
                  <div class="form-group">
                    <label for="display_name">Post Url</label>
                    <input type="text" wire:model="url" class="form-control">
                </div>

                {{--                <div class="form-group">--}}
                {{--                    <label for="menu_icon">Menu Icon</label>--}}
                {{--                    <input type="text" wire:model="menuIcon" class="form-control">--}}
                {{--                </div>--}}
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea type="text" wire:model="menuDescription" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="title">Url Target</label>
                    <select id="" class="form-control" wire:model="urlTarget">
                        <option value="0" {{$urlTarget==0?'selected':''}}>Same window</option>
                        <option value="1" {{$urlTarget==1?'selected':''}}>New Window</option>
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    @endif
    <ol class="dd-list">
        @if(count($menuItems)>0)
            @include('backend.content-management.menus.category-first',['menuItems'=>$menuItems])
        @else
            <p>No items found. App pages</p>
        @endif
    </ol>
</div>
