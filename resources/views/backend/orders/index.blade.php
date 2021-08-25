@extends('backend.layouts.master')
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
    .sorting{
        width:100px!important
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
            <div>Orders
                <div class="page-title-subheading">Here are all the Orders you have
                </div>
            </div>
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
                        All Orders
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <table class="table table-striped table-bordered" id="orders-table">
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
    $(function() {
        $('#orders-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.api.order') }}',
            columns: [
                { data: 'status', title:'Order Status'},
                { data: 'full_names', title:'Full Names'},
                { data: 'products', title:'Total Products'},
                { data: 'created_at', title:'Date'},
                { data: 'order_assigned_to', title:'Delivery Boy'},
                { data: 'sub_totals', title:'Sub Totals'},
                { data: 'total_discounts', title:'Total Discounts'},
                { data: 'grand_totals', title:'Grand Total'},
                {data: 'action',name:'action',title:'Action',orderable:false, searchable:false},
        ],
        });
    });
</script>
@endpush
