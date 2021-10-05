@extends('front.layouts.layout')

@push('css')
<link href="{{ asset('front/css/step-wizard.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.css">
<style>

    #test{
        margin-top: 35px;
    }
</style>
@endpush
@section('content')
    <div class="container" id="test">
        <div class="row">
            <div class="col-sm-12">

                <form action="{{ route('track_order_id_show') }}" class="form-inline">
                    <div class="form-group">
                        <label for="" class="control-label">Track Order Id</label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="order_track_id">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label"></label>
                        <button class="btn btn-success" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
