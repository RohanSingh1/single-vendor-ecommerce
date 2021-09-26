@extends('backend.layouts.master')
@section('styles')
<style>
    .help-block{
        color:rebeccapurple;
    }
    .custab {
        border: 1px solid #ccc;
        padding: 5px;
        margin: 5% 0;
        box-shadow: 3px 3px 2px #ccc;
        transition: 0.5s;
    }

    .custab:hover {
        box-shadow: 3px 3px 0px transparent;
        transition: 0.5s;
    }

    .liststyle {
        list-style: none;
    }

    .liststyle li {
        float: left;
        padding-left: 12px;
    }
    .display-inline{
        display: inline-block;
    }
    .select2{
        width:100%!important;
    }
</style>
@endsection
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-car icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Locations Name
                <div class="page-title-subheading">Here are all the locations you have
                </div>
            </div>
        </div>
        <div class="page-title-actions">
            <button class="btn btn-success" data-toggle="modal" data-target="#addlocations">Add New</button>

        </div>
    </div>
</div>
@include('inc.messages')
<div class="row">
    <div class="col-md-12 col-xl-12">
        <div class="mb-3 card">
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                    <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>
                        All Locations Name
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <table class="table table-striped table-bordered" id="locations-table">
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
    @include('backend.locations.add-modal')
@endsection
@push('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
    $(function() {
        $('#locations-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.api.locations') }}',
            columns: [
                { data: 'from_location', title:'From Location'},
                { data: 'to_location', title:'To Location'},
                { data: 'price', title:'Price'},
                {data:'status',title:'Status', mRender:  function(data, type, full) {
                    return data == 1 ? 'Active' : 'In-Active';
            }},
                {data: 'action',name:'action',title:'Action',orderable:false, searchable:false},
        ],
        });
    });
</script>
@endpush
