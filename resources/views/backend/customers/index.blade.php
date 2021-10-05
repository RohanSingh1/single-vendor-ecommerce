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
            <div>User
                <div class="page-title-subheading">Here are all the Users you have
                </div>
            </div>
        </div>
        <div class="page-title-actions">
            <button class="btn btn-success" data-toggle="modal" data-target="#addCustomer">Add New</button>

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
                        All User
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <table class="table table-striped table-bordered" id="customers-table">
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
    @include('backend.customers.add-modal')
@endsection
@push('script')
    <script type="text/javascript">
    $(function() {
        $('#customers-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.api.customers') }}',
            columns: [
                { data: 'name', title:'Name'},
                { data: 'email', title:'E-Mail'},
                { data: 'phone_no', title:'Phone'},
                {data: 'image', title: 'Image'},
                {data: 'address_1', title: 'Address'},
                {data:'status',title:'Status', mRender:  function(data, type, full) {
                    return data == 1 ? 'Active' : 'In-Active';
            }},
                {data: 'action',name:'action',title:'Action',orderable:false, searchable:false},
        ],
        });
    });
</script>
@endpush