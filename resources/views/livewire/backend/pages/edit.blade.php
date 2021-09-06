<div class="col-md-12">
    <div class="form-group">
        <label for="formidOne">Post Title
            <sup class="text-danger">*</sup>
        </label>
        <input id="formidOne" type="text" class="form-control" name="title" wire:model.debounce.500ms="postTitle"
               value="{{old('title')}}" required>
    </div>
    <div class="row">
        <div class="col-sm-6 form-group">
            <label>Post Slug</label>
            <input type="text" class="form-control" name="slug" wire:model.debounce.500ms="postSlug"
                   value="{{old('slug') ??''}}" autocomplete="off">
        </div>
        <div class="col-sm-6 form-group">
            <label>Post Url</label>
            <input type="text" class="form-control" name="url" wire:model="postUrl"
                   value="{{old('url') ??''}}" autocomplete="off" readonly>
        </div>
    </div>
</div>
