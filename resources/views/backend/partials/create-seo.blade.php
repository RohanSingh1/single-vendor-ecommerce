<div class="card">
    <div class="card-header border-transparent">
        <h3 class="card-title"><span>SEO</span></h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6 form-group">
                <label for="formidSeventeen">Meta title</label>
                <input id="formidSeventeen" name="meta_title" value="{{old('meta_title')??$meta->meta_title??''}}" type="text"
                       class="form-control">
            </div>
            <div class="col-sm-6 form-group">
                <label for="formidEighteen">Meta keywords</label>
                <input id="formidEighteen" name="meta_keyword" value="{{old('meta_keyword')??$meta->meta_keyword??''}}" type="text"
                       class="form-control">
            </div>
            <div class="col-sm-6 form-group">
                <label for="formidNineteen">Meta description</label>
                <textarea name="meta_desc" id="meta_desc" cols="30" rows="10" class="form-control">{!! old('meta_desc')??$meta->meta_desc??''!!}</textarea>
            </div>
        </div>
    </div>
</div>
